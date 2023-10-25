<?php

namespace App\Http\Controllers;

use App\Mail\ContactRequestMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        Mail::to('info@weareinittogether.nl')->send(new ContactRequestMailable($this->validateRequest($contactRequest)));

        return redirect(route('contact'))->with('success', 'Thank you for your message! We will get in touch with you soon.');
    }
}
