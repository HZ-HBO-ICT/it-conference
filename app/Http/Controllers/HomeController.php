<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Company;
use App\Models\Sponsorship;
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
        $goldSponsor   = Company::approvedSponsor()->where('sponsorship_id', 1)->first();
        $silverSponsors = Company::approvedSponsor()->where('sponsorship_id', 2)->get();
        $bronzeSponsors = Company::approvedSponsor()->where('sponsorship_id', 3)->get();

        return view('welcome', compact(['edition', 'goldSponsor', 'anySponsorships', 'silverSponsors', 'bronzeSponsors']));
    }
}
