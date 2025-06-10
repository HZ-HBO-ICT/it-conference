<?php

namespace App\Http\Controllers;

use App\Models\FrequentQuestion;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrequentQuestionController extends Controller
{
    /**
     * Returns the main public view for the FAQs
     *
     * @return View
     */
    public function index() : View
    {
        $faqs = FrequentQuestion::all();
        return view('faq', compact('faqs'));
    }
}
