@component('mail::message')
# Congratulations, {{$team->name}} is in for the conference!
We are excited that you want to join us and take a part in the conference.
We look forward to seeing you on the 17th of November!

In the meanwhile you can add other employees from {{$team->name}} that will be joining during the conference, request a booth or become a sponsor.
@component('mail::button', ['url' => route('teams.show', $team)])
    Manage your team
@endcomponent

If you have any additional questions do not hesitate to contact us!

@endcomponent
