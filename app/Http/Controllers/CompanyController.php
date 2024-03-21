<?php

namespace App\Http\Controllers;

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
        return view('teams.public.index', ['teams' => collect()]);
    }
}
