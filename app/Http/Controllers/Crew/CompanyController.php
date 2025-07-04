<?php

namespace App\Http\Controllers\Crew;

use App\Enums\ApprovalStatus;
use App\Events\CompanyRolesNotified;
use App\Http\Controllers\Controller;
use App\Jobs\NotifyCompanyRoles;
use App\Mail\CompanyApprovedMailable;
use App\Mail\CompanyDeletedMailable;
use App\Mail\CompanyDisapprovedMailable;
use App\Mail\CompanyRepInvitation;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (Auth::user()->cannot('viewAny', Company::class)) {
            abort(403);
        }

        $companies = Company::orderByPriorityStatus(ApprovalStatus::AWAITING_APPROVAL)->paginate(15);

        return view('crew.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->cannot('create', Company::class)) {
            abort(403);
        }

        return view('crew.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->cannot('create', Company::class)) {
            abort(403);
        }

        $input = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'website' => 'required|regex:/^www\.[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}$/',
            'postcode' => ['required'],
            'house_number' => ['required',
                'regex:/(\w?[0-9]+[a-zA-Z0-9\- ]*)$/i'],
            'phone_number' => ['nullable', 'phone:INTERNATIONAL,NL'],
            'street' => 'required',
            'city' => 'required',
            'rep_email' => empty($request->input('rep_new_email')) ? 'required' : '',
            'rep_new_email' => !empty($request->input('rep_new_email')) ? 'required|email' : '',
        ]);

        $company = $input['rep_new_email'] ?
            $this->createCompanyWithNewUser($input) :
            $this->createCompanyWithExistingUser($input);

        $template = 'You created the :company company';
        return redirect(route('moderator.companies.index'))
            ->banner(__($template, [
                'company' => $company->name]));
    }

    /**
     * Display the specified resource.
     * @param Company $company
     * @return View
     */
    public function show(Company $company): View
    {
        if (Auth::user()->cannot('view', $company)) {
            abort(403);
        }

        return view('crew.companies.show', compact('company'));
    }

    /**
     * Approve or reject the specified resource in storage.
     */
    public function approve(Company $company, bool $isApproved)
    {
        if (Auth::user()->cannot('approveRequest', $company)) {
            abort(403);
        }


        $isApproved = filter_var($isApproved, FILTER_VALIDATE_BOOLEAN);
        if (!$isApproved) {
            if ($company->representative->receive_emails) {
                Mail::to($company->representative->email)->send(new CompanyDisapprovedMailable($company));
            }
        }

        $company->handleCompanyApproval($isApproved);

        $template = $isApproved ? 'You approved :company to join the IT Conference!!'
            : 'You refused the request of :company to join the IT conference';

        if ($isApproved) {
            if ($company->representative->receive_emails) {
                Mail::to($company->representative->email)->send(new CompanyApprovedMailable($company));
            }

            return redirect(route('moderator.companies.show', $company))
                ->banner(__($template, ['company' => $company->name]));
        } else {
            return redirect(route('moderator.companies.index'))
                ->banner(__($template, ['company' => $company->name]));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if (Auth::user()->cannot('delete', $company)) {
            abort(403);
        }

        NotifyCompanyRoles::dispatchSync('company representative', $company, CompanyDeletedMailable::class);

        foreach ($company->users as $user) {
            $user->syncRoles(Role::findByName('participant', 'web'));
        }
        $company->delete();

        return redirect(route('moderator.companies.index'))
            ->banner('You successfully removed the company');
    }

    /**
     * Creates a company with already existing user
     *
     * @param $input
     * @return Company
     */
    private function createCompanyWithExistingUser($input)
    {
        $user = User::where('email', '=', $input['rep_email'])->first();
        if (is_null($user)) {
            $company = $this->createCompanyWithNewUser($input);
            return $company;
        }

        $company = Company::create([
            'name' => $input['name'],
            'postcode' => $input['postcode'],
            'house_number' => $input['house_number'],
            'street' => $input['street'],
            'city' => $input['city'],
            'website' => 'https://' . $input['website'],
            'description' => $input['description'],
            'phone_number' => $input['phone_number'],
            'approval_status' => ApprovalStatus::APPROVED->value,
        ]);
        $user->company_id = $company->id;

        $user->assignRole('company representative');
        $user->save();

        return $company;
    }

    /**
     * Creates a company while inviting a company representative
     * to register via an email
     *
     * @param $input
     * @return Company
     */
    private function createCompanyWithNewUser($input)
    {
        $company = Company::create([
            'name' => $input['name'],
            'postcode' => $input['postcode'],
            'house_number' => $input['house_number'],
            'street' => $input['street'],
            'city' => $input['city'],
            'website' => 'https://' . $input['website'],
            'description' => $input['description'],
            'phone_number' => $input['phone_number'],
            'approval_status' => ApprovalStatus::APPROVED->value,
        ]);

        $invitation = $company->invitations()->create([
            'email' => $input['rep_new_email'],
            'role' => 'company representative',
        ]);

        Mail::to($input['rep_new_email'])->send(new CompanyRepInvitation($invitation));

        return $company;
    }
}
