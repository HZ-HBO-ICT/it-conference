<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\Company;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CrewController extends Controller
{
    /**
     * Gets all requests of a specific type
     * @param string $type The type of requests ('teams', 'booths', or 'sponsorships').
     * @return View
     */
    public function requests(string $type): View
    {
        if ($type == 'company') {
            $companies = Company::where('is_approved', false)->paginate(5);
            return view('crew.requests.teams', compact('type', 'companies'));
        } elseif ($type == 'booths') {
            $booths = Booth::where('is_approved', false)->paginate(5);
            return view('crew.requests.booths', compact('type', 'booths'));
        } elseif ($type == 'sponsorships') {
            $companies = Company::where('is_sponsorship_approved', false)->whereNotNull('sponsor_tier_id')->paginate(5);
            return view('crew.requests.sponsorships', compact('type', 'companies'));
        } elseif ($type == 'presentations') {
            $presentations = Presentation::where('is_approved', 1)->paginate(5);
            return view('crew.requests.presentations', compact('type', 'presentations'));
        }

        abort(404);
    }

    /**
     * Gets the details for a specific request
     * @param string $type The type of requests ('teams', 'booths', or 'sponsorships').
     * @param int $id
     * @return View
     */
    public function details(string $type, int $id): View
    {
        if ($type == 'teams') {
            $company = Company::find($id);
            return view('crew.details.team', compact('company'));
        } elseif ($type == 'booths') {
            $booth = Booth::find($id);
            return view('crew.details.booth', compact('booth'));
        } elseif ($type == 'sponsorships') {
            $company = Company::find($id);
            return view('crew.details.sponsorship', compact('company'));
        } elseif ($type == 'presentations') {
            $presentation = Presentation::find($id);
            return view('crew.details.presentation', compact('presentation'));
        }

        abort(404);
    }
}
