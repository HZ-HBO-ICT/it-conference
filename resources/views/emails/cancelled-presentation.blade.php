@component('mail::message')
# The presentation you were enrolled for was cancelled!

Dear {{ $user->name }}

Unfortunately, due to some circumstances, a {{ $presentation->type }} "{{ $presentation->name }}"
that you were part of was cancelled. We are sorry for the inconvenience.
You can still enroll for the other lectures and workshops.

@component('mail::button', ['url' => route('programme')])
    Log in to see them
@endcomponent

Kind regards,

We are in IT together conference team
@endcomponent
