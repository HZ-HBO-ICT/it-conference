@component('mail::message')
# You have new notifications in your IT Conference hub!

We are writing to remind you that you have {{$unreadNotifications}} unread notifications in
the IT Conference hub!

@component('mail::button', ['url' => route('announcements')])
    Log in to see them
@endcomponent

If you did not expect to receive this, you may discard this email.
@endcomponent
