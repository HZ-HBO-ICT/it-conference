@component('mail::message')
Dear {{ $user->name }}

'{{ $presentation->name }}' details were updated by
@if($user->isPresenterOf($presentation))
our crew.

@component('mail::button', ['url' => route('presentations.show', $presentation)])
    Log in to see details
@endcomponent
@elseif($user->is_crew)
the speaker.

@component('mail::button', ['url' => route('moderator.presentations.show', $presentation)])
    Log in to see details
@endcomponent
@endif

Kind regards,

We are in IT together conference team
@endcomponent
