<?php

namespace App\Http\Controllers;

use App\Models\Edition;

class CompanyController extends Controller
{
    /**
     * Returns the public facing company index page
     */
    public function index()
    {
        $edition = Edition::current();

        if (!$edition) {
            return redirect(route('welcome'))
                ->dangerBanner("Companies are not available yet.");
        }

        return view('teams.public.index', ['teams' => collect()]);
    }
}
