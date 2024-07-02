<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Mail\CustomTeamInvitation;
use App\Models\Booth;
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

        $companies = Company::orderBy('is_approved')->paginate(15);

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
            'postcode' => ['required',
                'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
            'house_number' => ['required',
                'regex:/(\w?[0-9]+[a-zA-Z0-9\- ]*)$/i'],
            'phone_number' => ['nullable', 'phone:INTERNATIONAL,NL'],
            'street' => 'required',
            'city' => 'required',
            'rep_email' => empty($input['rep_new_email']) ? 'required' : '',
            'rep_new_email' => !empty($input['rep_new_email']) ? 'required|email' : '',
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
    public function approve(Request $request, Company $company)
    {
        if (Auth::user()->cannot('approveRequest', $company)) {
            abort(403);
        }

        $validated = $request->validate([
            'approved' => 'required|boolean'
        ]);

        $isApproved = $validated['approved'];
        $company->handleCompanyApproval($isApproved);

        $template = $isApproved ? 'You approved :company to join the IT Conference!!'
            : 'You refused the request of :company to join the IT conference';

        if ($isApproved) {
            return redirect(route('moderator.companies.show', $company))
                ->banner(__($template, ['company' => $company->name]));
        }

        return redirect(route('moderator.companies.index'))
            ->banner(__($template, ['company' => $company->name]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if (Auth::user()->cannot('delete', $company)) {
            abort(403);
        }

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
            'website' => $input['website'],
            'description' => $input['description'],
            'phone_number' => $input['phone_number'],
            'is_approved' => 1,
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
            'website' => $input['website'],
            'description' => $input['description'],
            'phone_number' => $input['phone_number'],
            'is_approved' => 1,
        ]);

        $invitation = $company->invitations()->create([
            'email' => $input['rep_new_email'],
            'role' => 'company representative',
        ]);

        Mail::to($input['rep_new_email'])->send(new CustomTeamInvitation($invitation));

        return $company;
    }
}
