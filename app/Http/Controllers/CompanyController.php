<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Returns the public facing company index page
     * @return View
     */
    public function index() : View
    {
        $companies = Company::all()->sortBy(function ($company) {
            if ($company->is_approved && $company->is_sponsorship_approved) {
                return $company->sponsorship_id;
            }
            return 999; // Assign a high value to non-sponsored speakers
        });

        return view('teams.public.index', compact('companies'));
    }

    /**
     * Returns the public facing company show page
     * @param Company $company
     * @return View
     */
    public function show(Company $company) : View
    {
        return view('teams.public.show', compact('company'));
    }
}
