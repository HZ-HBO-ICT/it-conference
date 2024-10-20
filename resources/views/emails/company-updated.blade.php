@component('mail::message')
Dear {{ $user->name }}

Your company '{{ $company->name }}' details were updated by
@if($user->isMemberOf($company))
our crew.

@component('mail::button', ['url' => route('company.details', $company)])
    Log in to see details
@endcomponent
@elseif($user->is_crew)
the company representative.

@component('mail::button', ['url' => route('moderator.companies.show', $company)])
    Log in to see details
@endcomponent
@endif

Kind regards,

We are in IT together conference team
@endcomponent
