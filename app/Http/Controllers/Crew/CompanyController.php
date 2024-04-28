<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $companies = Company::orderBy('is_approved')->paginate(15);

        return view('crew.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crew.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and fetch the user
        $input = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'website' => 'required',
            'postcode' => ['required',
                'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
            'house_number' => ['required',
                'regex:/(\w?[0-9]+[a-zA-Z0-9\- ]*)$/i'],
            'phone_number' => ['required', 'phone:INTERNATIONAL,NL'],
            'street' => 'required',
            'city' => 'required',
            'rep_email' => 'required'
        ]);

        $user = User::where('email', '=', $input['rep_email'])->firstOrFail();

        $company = Company::create([
            'name' => $input['name'],
            'postcode' => $input['postcode'],
            'house_number' => $input['house_number'],
            'street' => $input['street'],
            'city' => $input['city'],
            'website' => $input['website'],
            'description' => $input['description'],
            'phone_number' => $input['phone_number'],
            'is_approved' => true,
        ]);
        $user->company_id = $company->id;

        $user->assignRole('company representative');
        $user->save();

        // TODO send the mail

        $template = 'You created the :company company and added :user as its owner';
        return redirect(route('moderator.companies.index'))
            ->banner(__($template, [
                'company' => $company->name, 'user' => $user->name]));
    }

    /**
     * Display the specified resource.
     * @param Company $company
     * @return View
     */
    public function show(Company $company): View
    {
        return view('crew.companies.show', compact('company'));
    }

    /**
     * Approve or reject the specified resource in storage.
     */
    public function approve(Request $request, Company $company)
    {
        $validated = $request->validate([
            'approved' => 'required|boolean'
        ]);

        $isApproved = $validated['approved'];
        $company->handleTeamApproval($isApproved);

        $template = $isApproved ? 'You approved :company to join the IT Conference!!'
            : 'You refused the request of :company to join the IT conference';
        return redirect(route('moderator.companies.show', $company))
            ->banner(__($template, ['company' => $company->name]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        foreach ($company->users as $user) {
            $user->syncRoles(Role::findByName('participant'));
        }
        $company->delete();

        return redirect(route('moderator.companies.index'))
            ->banner('You successfully removed the company');
    }
}
