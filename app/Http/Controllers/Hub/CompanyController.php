<?php

namespace App\Http\Controllers\Hub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Stats\SpeakersStats;
use App\Stats\BoothsStats;
use App\Stats\PresentationsStats;
use App\Stats\CompaniesStats;

class CompanyController extends Controller
{
    /**
     * Returns the landing page of the conference hub
     * And passes the information needed for the statistic graphs
     */
    public function dashboard()
    {
        $startDate = now()->subMonths(1);
        $endDate = now();

        $speakersStats = SpeakersStats::query()->start($startDate)->end($endDate)->groupByDay()->get();
        $boothsStats = BoothsStats::query()->start($startDate)->end($endDate)->groupByDay()->get();
        $presentationsStats = PresentationsStats::query()->start($startDate)->end($endDate)->groupByDay()->get();
        $companiesStats = CompaniesStats::query()->start($startDate)->end($endDate)->groupByDay()->get();

        return view('myhub.home', [
            'speakersStats' => $speakersStats,
            'boothsStats' => $boothsStats,
            'presentationsStats' => $presentationsStats,
            'companiesStats' => $companiesStats
        ]);
    }

    /**
     * Returns the inner details of the company
     * @return View
     */
    public function details()
    {
        $company = Auth::user()->company;
        if (!$company) {
            abort(403);
        }

        return view('myhub.company.details', compact('company'));
    }

    /**
     * Returns the requests that the company has made - booth and sponsorship
     * @return View
     */
    public function requests(): View
    {
        $company = Auth::user()->company;
        if (!$company || Auth::user()->cannot('viewRequests', $company)) {
            abort(403);
        }

        return view('myhub.company.requests', compact('company'));
    }
}
