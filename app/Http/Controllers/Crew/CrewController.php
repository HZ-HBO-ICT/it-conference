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
            return view('moderator.requests.teams', compact('type', 'companies'));
        } else if ($type == 'booths') {
            $booths = Booth::where('is_approved', false)->paginate(5);
            return view('moderator.requests.booths', compact('type', 'booths'));
        } else if ($type == 'sponsorships') {
            $companies = Company::where('is_sponsorship_approved', false)->whereNotNull('sponsor_tier_id')->paginate(5);
            return view('moderator.requests.sponsorships', compact('type', 'companies'));
        } else if ($type == 'presentations') {
            $presentations = Presentation::where('is_approved', 1)->paginate(5);
            return view('moderator.requests.presentations', compact('type', 'presentations'));
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
            return view('moderator.details.team', compact('company'));
        } else if ($type == 'booths') {
            $booth = Booth::find($id);
            return view('moderator.details.booth', compact('booth'));
        } else if ($type == 'sponsorships') {
            $company = Company::find($id);
            return view('moderator.details.sponsorship', compact('company'));
        } else if ($type == 'presentations') {
            $presentation = Presentation::find($id);
            return view('moderator.details.presentation', compact('presentation'));
        }

        abort(404);
    }
}
