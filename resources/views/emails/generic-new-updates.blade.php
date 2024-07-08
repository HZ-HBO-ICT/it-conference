@component('mail::message')
# You have new notifications in your We are in IT together conference hub!

We are writing to remind you that you have {{ $unreadNotifications }} unread notifications in
the conference personal hub!

@component('mail::button', ['url' => route('announcements')])
    Log in to see them
@endcomponent

Kind regards,

We are in IT together conference team

If you did not expect to receive this, you may discard this email.
@endcomponent
