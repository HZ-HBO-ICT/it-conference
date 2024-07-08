@component('mail::message')
# You have been invited to join We are in IT together conference as a company representative of {{ $invitation->company->name }}!

As a company representative you are the main contact person for the conference.
You will be able to add and remove employees that will be joining as speakers/workshop hosts. You can
send inquiries about becoming a sponsor as well as setting up a company booth in our market space.

To gain access to the system as a company representative you just need to follow the link and register on the website.

@component('mail::button', ['url' => $acceptUrl])
Finish your registration
@endcomponent

Kind regards,

We are in IT together conference team
@endcomponent
