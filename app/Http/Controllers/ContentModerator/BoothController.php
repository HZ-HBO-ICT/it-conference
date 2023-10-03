<?php

namespace App\Http\Controllers\ContentModerator;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use Illuminate\Http\Request;

class BoothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sort them so the companies that await approval appear on top
        $booths = Booth::orderBy('is_approved')->paginate(15);

        return view('moderator.booths.index', compact('booths'));
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
    public function show(Booth $booth)
    {
        return view('moderator.booths.show', compact('booth'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booth $booth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booth $booth)
    {
        //
    }

    /**
     * Approve or reject the specified resource in storage.
     */
    public function approve(Request $request, Booth $booth)
    {
        $validated = $request->validate([
            'approved' => 'required|boolean'
        ]);

        $isApproved = $validated['approved'];
        $booth->handleApproval($isApproved);

        $template = $isApproved ? 'You approved the booth of :company!'
            : 'You denied the request of :company to have a booth';
        return redirect(route('moderator.requests', 'booths'))
            ->banner(__($template, ['company' => $booth->team->name]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booth $booth)
    {
        //
    }
}
