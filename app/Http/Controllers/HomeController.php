<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Company;
use App\Models\Sponsorship;
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
        $anySponsorships = Sponsorship::doesntHave('companies')->count() === Sponsorship::count();
        $goldSponsorCompany = Company::where('is_approved', 1)
            ->where('sponsorship_id', 1)
            ->where('is_sponsorship_approved', 1)
            ->first();

        return view('welcome', compact(['edition', 'goldSponsorCompany', 'anySponsorships']));
    }
}
