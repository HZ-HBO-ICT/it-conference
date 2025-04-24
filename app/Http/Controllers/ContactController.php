<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;
use Exception;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Handle the contact form submission.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function submit(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|in:general,registration,sponsorship,speaking,other',
                'message' => 'required|string|min:10',
            ]);

            // Send email notification
            Mail::to('info@weareinittogether.nl')->send(new ContactFormSubmission($validated));

            return back()->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Sorry, there was an error sending your message. Please try again later.']);
        }
    }
}
