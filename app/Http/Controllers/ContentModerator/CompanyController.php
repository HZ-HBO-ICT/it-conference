<?php

namespace App\Http\Controllers\ContentModerator;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        // Sort them so the companies that await approval appear on top
        $companies = Team::orderBy('is_approved')->paginate(15);

        return view('moderator.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('moderator.companies.create');
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
     * @param Team $company
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Team $company): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('moderator.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
