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

    /**
     * Returns the inner details of the company
     * @return View
     */
    public function companyDetails()
    {
        $company = Auth::user()->company;
        if (!$company) {
            abort(403);
        }

        return view('myhub.company.details', compact('company'));
    }

    /**
     * Returns the requests that the company has made - booth and sponsorship
     * @return View
     */
    public function companyRequests(): View
    {
        $company = Auth::user()->company;
        if (!$company || Auth::user()->cannot('viewRequests', $company)) {
            abort(403);
        }

        return view('myhub.company.requests', compact('company'));
    }
}
