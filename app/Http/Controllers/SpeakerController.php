<?php

namespace App\Http\Controllers;

use App\Models\UserPresentation;
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
        $speakers = UserPresentation::all()->where('role', 'speaker');
        return view('speakers.index', compact('speakers'));
    }
}
