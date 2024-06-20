<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HubController extends Controller
{
    /**
     * Returns the landing page of the conference hub
     */
    public function dashboard()
    {
        return view('myhub.home');
    }
}
