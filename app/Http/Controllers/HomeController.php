<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{

    /**
     * Returns the landing page of the application
     * @return View
     */
    public function index() : View
    {
        return view('welcome');
    }
}
