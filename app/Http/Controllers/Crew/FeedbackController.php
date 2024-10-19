<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        if (Auth::user()->cannot('viewAny', Feedback::class)) {
            abort(403);
        }

        $feedbackReports =  Feedback::all();

        return view('crew.feedback.index', compact('feedbackReports'));
    }

    public function show(Feedback $feedback)
    {
        if (Auth::user()->cannot('view', $feedback)) {
            abort(403);
        }

        return view('crew.feedback.show', compact('feedback'));
    }
}
