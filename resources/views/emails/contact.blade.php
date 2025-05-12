<x-mail::message>
    # You've received a contact request!

    ## Name: {{ $data['name'] }}
    ## Email: {{ $data['email'] }}

    ## Message:
    {{ $data['message'] }}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>

