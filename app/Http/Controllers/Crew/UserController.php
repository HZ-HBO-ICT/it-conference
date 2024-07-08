<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Returns the page with a list of users
     *
     * @return View
     */
    public function index() : View
    {
        return view('crew.users.index');
    }
}
