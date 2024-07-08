<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Livewire\Component;

class UserFilteringList extends Component
{
    public $users;
    public $role;
    public $email;
    public $institution;

    /**
     * Initializes the component
     *
     * @return void
     */
    public function mount()
    {
        $this->users = User::all()->sortBy('name');
    }

    /**
     * Triggers the filtering function if the role has been changed
     *
     * @return void
     */
    public function roleChanged() : void
    {
        $this->filter();
    }

    /**
     * Triggers the filtering function if the institution/company is being changed
     *
     * @return void
     */
    public function updatedInstitution() : void
    {
        $this->filter();
    }

    /**
     * Triggers the filtering function if the email/name is being changed
     *
     * @return void
     */
    public function updatedEmail()
    {
        $this->filter();
    }

    /**
     * Function that filters the users based on the filters provided by the users
     *
     * @return void
     */
    public function filter()
    {
        $this->users = User::all()->sortBy('name');

        if ($this->role) {
            $this->users = User::role($this->role)->get()->sortBy('name');
        }

        if ($this->institution) {
            $this->users = $this->users->filter(function ($user) {
                if ($user->company) {
                    return stripos(optional($user->company)->name, $this->institution) !== false;
                }
                return stripos($user->institution, $this->institution) !== false;
            });
        }

        if ($this->email) {
            $this->users = $this->users->filter(function ($user) {
                $nameMatch = stripos($user->name, $this->email) !== false;
                $emailMatch = stripos($user->email, $this->email) !== false;

                return $nameMatch || $emailMatch;
            });
        }
    }

    /**
     * Removes all the filters that the user has made
     *
     * @return void
     */
    public function clearFilters()
    {
        $this->email = '';
        $this->institution = '';
        $this->role = '';

        $this->users = User::all()->sortBy('name');
    }

    /**
     * Exports the current (filtered) users collection to csv
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        $filename = 'it-conference-users.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'Name',
                'Email',
                'Phone Number',
                'Institution/Company',
                'Roles',
            ]);

            // Fetch and process data in chunks
            foreach ($this->users as $user) {
                // Extract data from each user.
                $data = [
                    $user->name ?? '',
                    $user->email ?? '',
                    $user->company && $user->company->phone_number ? $user->company->phone_number : '',
                    $user->company ? $user->company->name : $user->institution,
                    isset($user->all_roles) ? implode(", ", json_decode($user->all_roles)) : '',
                ];

                // Write data to a CSV file.
                fputcsv($handle, $data);
            }

            // Close CSV file handle
            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.users.user-filtering-list');
    }
}
