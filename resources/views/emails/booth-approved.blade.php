@component('mail::message')
# You have secured your booth for the We are in IT together conference!

We hereby confirm you have successfully secured your booth for the conference, and we look forward to seeing you on the {{ $date->format('jS \\o\\f F') }}!

Please note:
You can build up your booth from 15:00 on {{ $date->subDay()->format('jS \\o\\f F') }} till 18:00 or on the day of the conference from 8:00

You can dismantle your booth from 16:00 on the {{ $date->addDay()->format('jS \\o\\f F') }}

A week before the start of the conference we will inform you about your booth location and present you with a floor-plan

A representative will show you your booth location upon arrival of our premises

If you have any question please do not hesitate to contact us.

Kind regards,

We are in IT together conference team
@endcomponent
