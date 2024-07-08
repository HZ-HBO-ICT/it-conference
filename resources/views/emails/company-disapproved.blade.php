@component('mail::message')
We regret to inform you that after careful consideration we have decided to decline your offer
to represent {{ $company->name }} during this year's edition of the We are in IT together conference.

Even though you will not be representing your company you are still welcome to join us as a participant.

Your personal account is still available for use, and you can sign up for lectures and workshops.
@component('mail::button', ['url' => route('welcome')])
Take a look
@endcomponent

Kind regards,

We are in IT together conference team
@endcomponent
