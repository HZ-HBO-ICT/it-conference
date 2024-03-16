@component('mail::message')
# You have been invited to join {{$invitation->team->name}} for the IT Conference!
Create an account and accept the invitation following the link bellow

@component('mail::button', ['url' => $acceptUrl])
Accept your invitation
@endcomponent

When your account is created you can enter information in regard to your Talk/Workshop.
You can enter a summery on the presentation topic which will also be shown on the website,
the level you believe it is applicable for:

Beginner = No specific knowledge/skill necessary

Intermediate = Basic level of knowledge/skill

Advanced = Experienced level of knowledge/skill

You could also enter as a participant, as soon as the programme is released you can then make your own.

Kind regards,

We are in IT together conference team
@endcomponent
