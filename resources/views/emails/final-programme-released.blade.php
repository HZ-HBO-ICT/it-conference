@component('mail::message')
# The programme of We are in IT together conference was released!

Dear {{ $user->name }}

We are excited to inform you that the official programme of the conference is already on the website.
You can now enroll yourself for different lectures and workshops.

@component('mail::button', ['url' => route('programme')])
    Log in to see them
@endcomponent

Furthermore, below you can find your ticket for the event. Show this QR code at the entrance to our representatives at the day of the conference.

You can also find it in your profile settings:

@component('mail::button', ['url' => route('profile.show')])
    See the ticket
@endcomponent

Kind regards,

We are in IT together conference team

<img src="data:image/png;base64,{{ base64_encode($user->generateTicket()) }}" alt="QR Code">
@endcomponent
