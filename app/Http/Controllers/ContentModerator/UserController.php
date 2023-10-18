<?php

namespace App\Http\Controllers\ContentModerator;

use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Http\Controllers\Controller;
use App\Mail\InviteCompany;
use App\Mail\InviteUser;
use App\Models\User;
use App\Models\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('moderator.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('moderator.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invitation = UserInvitation::create(
            $request->validate(UserInvitation::rules())
        );

        Mail::to($invitation->email)->send(new InviteUser($invitation));

        return redirect(route('moderator.users.index'))
            ->banner("You successfully sent out an invitation to {$invitation->name}");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('moderator.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, DeleteUser $deleteUser)
    {
        $this->authorize('delete', $user);

        // Delete the user
        $deleteUser->delete($user);

        return redirect(route('moderator.users.index'));
    }
}
