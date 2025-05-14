<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Display the contact page
     */
    public function index(): View
    {
        return view('contact');
    }

    /**
     * validates and send the message to info@weareinittogether.nl
     */
    public function send (Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' =>[
                'required',
                'email',
                'max:255',
                'min:3',
                Rule::email()
                    ->rfcCompliant()
                    ->validateMxRecord()
                    ->preventSpoofing()
            ],
            'subject' => 'required|string',
            'message' => 'required|string|min:8',
        ]);

        // makes the Email dynamic with the .env
        $recipientEmail = trim((string)config('email'));
        Mail::to($recipientEmail)->send(new ContactUs($data));


        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon.');
    }
}
