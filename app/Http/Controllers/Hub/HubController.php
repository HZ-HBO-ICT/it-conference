<?php

namespace App\Http\Controllers\Hub;

use App\Http\Controllers\Controller;

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
