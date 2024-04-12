<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
