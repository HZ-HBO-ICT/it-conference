<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Returns the landing page
     * @return View
     */
    public function index() : View
    {
        $edition = Edition::current();

        return view('welcome', compact('edition'));
    }
}
