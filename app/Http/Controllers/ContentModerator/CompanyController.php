<?php

namespace App\Http\Controllers\ContentModerator;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        // Sort them so the companies that await approval appear on top
        $companies = Team::orderBy('is_approved')->paginate(15);

        return view('moderator.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('moderator.companies.create');
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
            'postcode' => 'required',
            'house_number' => 'required',
            'street' => 'required',
            'city' => 'required',
            'rep_email' => 'required'
        ]);

        $user = User::where('email', '=', $input['rep_email'])->firstOrFail();

        // Create the team
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => $input['name'],
            'postcode' => $input['postcode'],
            'house_number' => $input['house_number'],
            'street' => $input['street'],
            'city' => $input['city'],
            'website' => $input['website'],
            'description' => $input['description'],
            'personal_team' => false,
            'is_approved' => true,
        ]);

        // Assign the company rep role. Important for????
        $user->assignRole('company representative');
        // Switch the user context to the created team. Important to show the correct sidemenu
        $user->switchTeam($team);
        // FIXME somehow a different user is assigned this role but the correct user is added as the owner.

        // Send user an email
        // TODO send the mail

        $template = 'You created the :company company and added :user as its owner';
        return redirect(route('moderator.companies.index'))
            ->banner(__($template, [
                'company' => $team->name, 'user' => $user->name]));
    }

    /**
     * Display the specified resource.
     * @param Team $company
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Team $company): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('moderator.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Approve or reject the specified resource in storage.
     */
    public function approve(Request $request, Team $team)
    {
        $validated = $request->validate([
            'approved' => 'required|boolean'
        ]);

        $isApproved = $validated['approved'];
        $team->handleTeamApproval($isApproved);

        $template = $isApproved ? 'You approved :company to join the IT Conference!!'
            : 'You refused the request of :company to join the IT conference';
        return redirect(route('moderator.companies.index'))
            ->banner(__($template, ['company' => $team->name]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
