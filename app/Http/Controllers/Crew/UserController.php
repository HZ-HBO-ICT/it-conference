<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Returns the page with a list of users
     *
     * @param string|null $role
     * @return View
     */
    public function index(?string $role = null): View
    {
        if (Auth::user()->cannot('viewAny', User::class)) {
            abort(403);
        }

        return view('crew.users.index', compact('role'));
    }
}
