@component('mail::message')
# You have been invited to join us at the IT Conference!
Create an account and accept the invitation following the link below

@component('mail::button', ['url' => $acceptUrl])
Accept your invitation
@endcomponent

You will be registered as a participant by default, as soon as the programme is released
you can enrol for presentations.

When your account is created if you decide, you can request to host a presentation. Enter information in regard
to your Presentation/Workshop. You can enter a summery on the presentation topic which will also be shown on the website,
the level you believe it is applicable for:

Beginner = No specific knowledge/skill necessary

Intermediate = Basic level of knowledge/skill

Advanced = Experienced level of knowledge/skill

Kind regards,

We are in IT together conference team
@endcomponent
