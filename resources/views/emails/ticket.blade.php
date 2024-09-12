@component('mail::message')
Thank you for verifying your email. Below you can find your ticket for the event.

Show this QR code at the entrance to our representatives.

Kind regards,

We are in IT together conference team

<img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
@endcomponent
