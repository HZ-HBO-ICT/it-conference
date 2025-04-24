@component('mail::message')
    # New Contact Form Submission

    You have received a new message from the contact form.

    *Name:* {{ $data['name'] }}
    *Email:* {{ $data['email'] }}
    *Subject:* {{ $data['subject'] }}

    *Message:*
    {{ $data['message'] }}

    @component('mail::button', ['url' => config('app.url')])
        View Website
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
