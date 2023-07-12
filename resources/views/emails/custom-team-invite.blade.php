@component('mail::message')
# You have been invited to join {{$invitation->team->name}} for the IT Conference!
Create an account and accept the invitation following the link bellow

@component('mail::button', ['url' => $acceptUrl])
Join the IT Conference
@endcomponent

If you did not expect to receive an invitation to this team, you may discard this email.
@endcomponent
