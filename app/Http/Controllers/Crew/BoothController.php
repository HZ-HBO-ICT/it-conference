<?php

namespace App\Http\Controllers\Crew;

use App\Enums\ApprovalStatus;
use App\Http\Controllers\Controller;
use App\Mail\BoothApprovedMailable;
use App\Mail\BoothDisapprovedMailable;
use App\Models\Booth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BoothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->cannot('viewAny', Booth::class)) {
            abort(403);
        }

        $booths = Booth::orderByPriorityStatus(ApprovalStatus::AWAITING_APPROVAL)->paginate(15);

        return view('crew.booths.index', compact('booths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->cannot('create', Booth::class)) {
            abort(403);
        }

        return view('crew.booths.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // CURRENTLY NOT IN USE
        abort(404);

        if ($request->user()->cannot('create', Booth::class)) {
            abort(403);
        }

        $input = $request->validate([
            'company_id' => ['required', 'numeric', 'exists:companies,id'],
            'width' => ['required', 'numeric', 'min:1', 'max:10'],
            'length' => ['required', 'numeric', 'min:1', 'max:10'],
            'additional_information' => ['nullable', 'max:255']
        ]);

        $booth = Booth::create(array_merge($input, ['approval_status' => ApprovalStatus::APPROVED->value]));

        $template = 'You created a booth for the :company';
        return redirect(route('moderator.booths.index'))
            ->banner(__($template, [
                'company' => $booth->company->name]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Booth $booth)
    {
        if (Auth::user()->cannot('view', $booth)) {
            abort(403);
        }

        return view('crew.booths.show', compact('booth'));
    }

    /**
     * Approve or reject the specified resource in storage.
     */
    public function approve(Booth $booth, bool $isApproved)
    {
        if (Auth::user()->cannot('approveRequest', $booth)) {
            abort(403);
        }

        $isApproved = filter_var($isApproved, FILTER_VALIDATE_BOOLEAN);
        $booth->handleApproval($isApproved);

        $template = $isApproved ? 'You approved the booth of :company!'
            : 'You denied the request of :company to have a booth';

        if ($isApproved) {
            if ($booth->company->representative->receive_emails) {
                Mail::to($booth->company->representative->email)->send(new BoothApprovedMailable($booth->company));
            }

            return redirect(route('moderator.booths.show', $booth))
                ->banner(__($template, ['company' => $booth->company->name]));
        } else {
            if ($booth->company->representative->receive_emails) {
                Mail::to($booth->company->representative->email)->send(new BoothDisapprovedMailable($booth->company));
            }

            return redirect(route('moderator.booths.index'))
                ->banner(__($template, ['company' => $booth->company->name]));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booth $booth)
    {
        if (Auth::user()->cannot('delete', $booth)) {
            abort(403);
        }

        $booth->delete();

        $template = 'You removed the booth of :company!';
        return redirect(route('moderator.booths.index'))
            ->banner(__($template, ['company' => $booth->company->name]));
    }
}
