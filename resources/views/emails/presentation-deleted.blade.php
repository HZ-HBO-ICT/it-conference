@component('mail::message')
Dear {{ $user->name }}

Your presentation '{{ $presentation->name }}' was deleted by our crew. If you think this is a mistake, please contact us at: info@weareinittogether.com

Kind regards,

We are in IT together conference team
@endcomponent
