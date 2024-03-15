@component('mail::message')
We regret to inform you that after careful consideration we have decided to decline your offer
to present {{$team->name}} during this year's edition of the "We are in IT together" conference.

Even though you will not be presenting your company you are still welcome to join us as a participant to
join lectures and workshops.

Your personal account is still available for use, and you can sign up for lectures and workshop
@component('mail::button', ['url' => route('welcome')])
Take a look
@endcomponent

If you did not expect to receive this, you may discard this email.
@endcomponent
