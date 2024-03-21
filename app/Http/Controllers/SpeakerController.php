<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SpeakerController extends Controller
{
    /**
     * Returns the public facing speakers index page
     * @return View
     */
    public function index() : View
    {
        return view('speakers.index', ['speakers' => collect()]);
    }
}
