<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function validateRequest(Request $contactRequest)
    {
        return $contactRequest->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string'
        ]);
    }

    public function store(Request $contactRequest)
    {
        ContactRequest::create($this->validateRequest($contactRequest));

        return redirect(route('contact'))->with('status', 'Thank you for your message! We will get in touch with you soon.');
    }
}
