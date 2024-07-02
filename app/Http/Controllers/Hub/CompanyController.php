<?php

namespace App\Http\Controllers\Hub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CompanyController extends Controller
{

    /**
     * Returns the inner details of the company
     *
     * @return View
     */
    public function details()
    {
        $company = Auth::user()->company;
        if (!$company) {
            abort(403);
        }

        return view('myhub.company.details', compact('company'));
    }

    /**
     * Returns the requests that the company has made - booth and sponsorship
     *
     * @return View
     */
    public function requests(): View
    {
        $company = Auth::user()->company;
        if (!$company || Auth::user()->cannot('viewRequests', $company)) {
            abort(403);
        }

        return view('myhub.company.requests', compact('company'));
    }
}
