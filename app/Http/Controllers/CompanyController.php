<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Edition;

class CompanyController extends Controller
{
    /**
     * Returns the public facing company index page
     */
    public function index(): View
    {
        $goldSponsors = Company::whereHas('sponsorship', function($query) {
            $query->where('id', 1)->where('is_sponsorship_approved', true);
        })->get();
        
        $silverSponsors = Company::whereHas('sponsorship', function($query) {
            $query->where('id', 2)->where('is_sponsorship_approved', true);
        })->get();
        
        $bronzeSponsors = Company::whereHas('sponsorship', function($query) {
            $query->where('id', 3)->where('is_sponsorship_approved', true);
        })->get();
        
        $allCompanies = Company::where('is_approved', true)->get();

        return view('companies.index', compact('goldSponsors', 'silverSponsors', 'bronzeSponsors', 'allCompanies'));
    }

    /**
     * Returns the public facing company show page
     * @param Company $company
     * @return View | RedirectResponse
     */
    public function show(Company $company): View | RedirectResponse
    {
        $edition = Edition::current();
        if (!$edition) {
            return redirect(route('companies.index'));
        }

        $styles = [
            1 => [
                'borderColor' => 'bg-gradient-to-r from-yellow-300 to-yellow-600', // Gold
                'linkColor' => 'text-yellow-400 hover:text-yellow-500',
                'textColor' => 'text-yellow-400',
                'iconColor' => 'stroke-yellow-400 hover:stroke-yellow-500',
            ],
            2 => [
                'borderColor' => 'bg-gradient-to-r from-gray-300 to-gray-600', // Silver
                'linkColor' => 'text-gray-600 hover:text-gray-700',
                'textColor' => 'text-gray-600',
                'iconColor' => 'stroke-gray-600 hover:stroke-gray-700',
            ],
            3 => [
                'borderColor' => 'bg-gradient-to-r from-orange-300 to-orange-600', // Bronze
                'linkColor' => 'text-orange-400 hover:text-orange-500',
                'textColor' => 'text-orange-400',
                'iconColor' => 'stroke-orange-400 hover:stroke-orange-500',
            ],
        ];

        if ($company->is_sponsorship_approved && isset($styles[$company->sponsorship_id])) {
            $borderColor = $styles[$company->sponsorship_id]['borderColor'];
            $linkColor = $styles[$company->sponsorship_id]['linkColor'];
            $iconColor = $styles[$company->sponsorship_id]['iconColor'];
            $textColor = $styles[$company->sponsorship_id]['textColor'];
        } else {
            $borderColor = 'bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500'; // Default
            $linkColor = 'text-blue-400 hover:text-blue-600';
            $textColor = 'text-blue-400';
            $iconColor = 'stroke-blue-400 dark:stroke-blue-400';
        }

        return view(
            'teams.public.show',
            compact('company', 'borderColor', 'textColor', 'linkColor', 'iconColor')
        );
    }
}
