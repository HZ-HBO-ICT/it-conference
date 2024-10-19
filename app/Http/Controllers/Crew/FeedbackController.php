<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        if (Auth::user()->cannot('viewAny', Feedback::class)) {
            abort(403);
        }

        $feedbackReports =  Feedback::all();

        return view('crew.feedback.index', compact('feedbackReports'));
    }

    /**
     * Display the specified resource.
     * @param Feedback $feedback
     * @return View
     */
    public function show(Feedback $feedback) : View
    {
        if (Auth::user()->cannot('view', $feedback)) {
            abort(403);
        }

        return view('crew.feedback.show', compact('feedback'));
    }
}
