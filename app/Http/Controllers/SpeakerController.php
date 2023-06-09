<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speakers = Speaker::all();

        return view('speakers.index', compact('speakers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Speaker $speaker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Speaker $speaker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speaker $speaker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speaker $speaker)
    {
        //
    }
}
