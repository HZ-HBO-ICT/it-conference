@component('mail::message')
# You have been invited to join {{ $invitation->company->name }} for We are in IT together conference!
Create an account and accept the invitation following the link bellow

@component('mail::button', ['url' => $acceptUrl])
Accept your invitation
@endcomponent

When your account is created you can enter information in regards to your Lecture/Workshop.
You can enter a description of your topic which will also be shown on the website,
as well as the level you believe it is applicable for:

Beginner = No specific knowledge/skill necessary

Intermediate = Basic level of knowledge/skill

Advanced = Experienced level of knowledge/skill

You could also become a participant of other lectures/workshops as soon as the programme gets released!

Kind regards,

We are in IT together conference team
@endcomponent
