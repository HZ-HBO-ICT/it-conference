<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\FrequentQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FrequentQuestionController extends Controller
{
    /**
     * Display a listing of the frequent questions
     *
     * @return View
     */
    public function index()
    {
        if (Auth::user()->cannot('viewAny', FrequentQuestion::class)) {
            abort(403);
        }

        $faqs = FrequentQuestion::all();
        return view('crew.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->cannot('create', FrequentQuestion::class)) {
            abort(403);
        }

        return view('crew.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->cannot('create', FrequentQuestion::class)) {
            abort(403);
        }

        $faq = FrequentQuestion::create($request->validate([
            'question' => 'required|min:5|max:255|string|unique:frequent_questions,question',
            'answer' => 'required|min:5|max:800|string'
        ]));

        return redirect(route('moderator.faqs.show', $faq));
    }

    /**
     * Display the specified resource.
     */
    public function show(FrequentQuestion $faq)
    {
        if (Auth::user()->cannot('view', $faq)) {
            abort(403);
        }

        return view('crew.faqs.show', compact('faq'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FrequentQuestion $faq)
    {
        if (Auth::user()->cannot('delete', $faq)) {
            abort(403);
        }

        $faq->delete();

        return redirect(route('moderator.faqs.index'))
            ->banner('You deleted the FAQ successfully');
    }
}
