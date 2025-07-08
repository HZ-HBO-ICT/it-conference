<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class CompanyMembers extends Component
{
    use WithPagination, WithoutUrlPagination;

    public Company $company;

    public function totalMembers() {
        return $this->company->users->count() + $this->company->invitations->count();
    }

    public function getUser($id) {
        return $this->company->users->find($id);
    }

    public function getInvitation($id) {
        return $this->company->invitations->find($id);
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        $users = User::select('id', 'name', 'created_at')->where('company_id', $this->company->id);
        $invitations = Invitation::select('id', 'email', 'created_at')->where('company_id', $this->company->id);

        $members = $users->unionAll($invitations)->orderBy('created_at')->paginate(3);

        return view('livewire.dashboards.widgets.company-members', [
            'members' => $members
        ]);
    }

    #[On('updated-dashboard')]
    public function refreshDashboard() : void
    {
        $this->company->refresh();
    }

    public function paginationView()
    {
        return 'components.pagination.waitt';
    }
}
