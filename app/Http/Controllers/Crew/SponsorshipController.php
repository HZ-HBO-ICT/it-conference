<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Mail\SponsorshipApprovedMailable;
use App\Mail\SponsorshipDisapprovedMailable;
use App\Models\Company;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        if (Auth::user()->cannot('viewAny', Sponsorship::class)) {
            abort(403);
        }

        $companies = Company::whereNotNull('sponsorship_id')
            ->orderBy('is_sponsorship_approved')->paginate(15);

        return view('crew.sponsorships.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if (Auth::user()->cannot('create', Sponsorship::class)) {
            abort(403);
        }

        $companies = Company::whereNull('sponsorship_id')->where('is_approved', 1)->get();
        $tiers = Sponsorship::all()->filter(function ($tier) {
            return $tier->areMoreSponsorsAllowed();
        });

        return view('crew.sponsorships.create', compact(['companies', 'tiers']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->cannot('create', Sponsorship::class)) {
            abort(403);
        }

        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'sponsorship_id' => 'required|exists:sponsorships,id'
        ]);

        $company = Company::find($validated['company_id']);
        $company->update([
            'sponsorship_id' => $validated['sponsorship_id'],
            'is_sponsorship_approved' => 1
        ]);
        $company->fresh();

        $template = 'You added :company as sponsors for the conference!';
        return redirect(route('moderator.sponsorships.show', $company))
            ->banner(__($template, ['company' => $company->name]));
    }

    /**
     * Display the specified resource.
     * @param Company $company
     * @return View
     */
    public function show(Company $company): View
    {
        if (Auth::user()->cannot('view', Sponsorship::class)) {
            abort(403);
        }

        if (!$company->sponsorship_id) {
            abort(404);
        }

        return view('crew.sponsorships.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param Company $company
     * @return mixed
     */
    public function approve(Company $company, bool $isApproved)
    {
        if (Auth::user()->cannot('approve', Sponsorship::class)) {
            abort(403);
        }

        $isApproved = filter_var($isApproved, FILTER_VALIDATE_BOOLEAN);
        $company->handleSponsorshipApproval($isApproved);

        $template = $isApproved ? 'You approved the sponsorship of :company!'
            : 'You denied the sponsorship of :company';

        if ($isApproved) {
            if ($company->representative->receive_emails) {
                Mail::to($company->representative->email)->send(new SponsorshipApprovedMailable($company));
            }

            return redirect(route('moderator.sponsorships.show', $company))
                ->banner(__($template, ['company' => $company->name]));
        } else {
            if ($company->representative->receive_emails) {
                Mail::to($company->representative->email)->send(new SponsorshipDisapprovedMailable($company));
            }

            return redirect(route('moderator.sponsorships.index'))
                ->banner(__($template, ['company' => $company->name]));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if (Auth::user()->cannot('delete', Sponsorship::class)) {
            abort(403);
        }

        $company->handleSponsorshipApproval(false);
        $company->refresh();

        $template = 'You removed the sponsorship from :company!';
        return redirect(route('moderator.sponsorships.index'))
            ->banner(__($template, ['company' => $company->name]));
    }
}
