@component('mail::message')
# You have been invited to join us at the IT Conference!
Create an account and accept the invitation following the link bellow

@component('mail::button', ['url' => $acceptUrl])
Accept your invitation
@endcomponent

You will be registered as a participant by default. When the final program is released you can enrol in any of the presentations using your account.

As soon as your account has been created, you can request to host a presentation. When requesting a presentation make sure to enter the necessary information such as: a summary of the topic which will be shown on the website and the level of difficulty intended for the participants. There are three difficulty levels:

Beginner: No specific knowledge/skill necessary.

Intermediate: Basic level of knowledge/skill.

Advanced: Experienced level of knowledge/skill.

Kind regards,

We are in IT together conference team
@endcomponent
