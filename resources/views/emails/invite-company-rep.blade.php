@component('mail::message')
# You have been invited to join the IT Conference!

Hello {{$invitation->team->owner->name}}!

You have been invited to join the IT Conference as a company representative of {{$invitation->team->name}}.

As a company representative you will be able to add and remove employees that will be joining you during the conference,
send enquires about sponsorship, booth.

To gain access to the system as a company representative you just need to follow the link and change your password.

@component('mail::button', ['url' => $acceptUrl])
Join the IT Conference
@endcomponent

If you did not expect to receive an invitation to this team, you may discard this email.
@endcomponent
