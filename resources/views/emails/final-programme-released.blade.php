@component('mail::message')
# The programme for the We are in IT Together Conference was released!

Dear {{ $user->name }}

We are excited to inform you that the official programme of the conference is already on the website.
You can now enroll yourself for different lectures and workshops.

@component('mail::button', ['url' => route('programme')])
    Log in to see them
@endcomponent

Kind regards,

We are in IT Together Conference team

@endcomponent
