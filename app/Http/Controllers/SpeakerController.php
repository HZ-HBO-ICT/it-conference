<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index() {
        return view('speakers.index', ['speakers' => collect()]);
    }
}
