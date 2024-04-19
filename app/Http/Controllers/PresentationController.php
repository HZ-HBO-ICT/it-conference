<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentationController extends Controller
{
    public function create()
    {
        Auth::user()->can('request', Presentation::class);

        return view('presentations.create');
    }

    public function store(Request $request)
    {
        Auth::user()->can('request', Presentation::class);

        $presentation =
            Presentation::create($request->validate(Presentation::rules()));

        Auth::user()->joinPresentation($presentation, 'speaker');
        Auth::user()->refresh();

        return redirect(route('presentations.show', $presentation))->banner("We successfully received your request to host a {$presentation->type}");
    }

    public function show(Presentation $presentation)
    {
        if (Auth::user()->can('view', $presentation))
            return view('presentations.show', compact('presentation'));

        abort(403);
    }
}
