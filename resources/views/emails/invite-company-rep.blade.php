@component('mail::message')
# You have been invited to join the IT Conference!

Hello {{$invitation->team->owner->name}}!

You have been invited to join the IT Conference as a company representative of {{$invitation->team->name}}.

As a company representative you are the main contactperson for our conference.
You will be able to add and remove employees that will be joining as speakers/workshop hosts. You can
send enquiries about sponsorship as well as setting up a company booth in our marketspace.

To gain access to the system as a company representative you just need to follow the link and change your password.

@component('mail::button', ['url' => $acceptUrl])
Finish your registration
@endcomponent

Kind regards,

We are in IT together conference team
@endcomponent
