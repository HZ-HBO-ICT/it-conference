@component('mail::message')
# Feedback Received

You have received new feedback related to team {{$feedback->type}}.

The title given is {{$feedback->title}}.

@if($feedback->reportedBy)
It has been reported by: {{$feedback->reportedBy->name}}
@endif

@component('mail::button', ['url' => route('moderator.feedback.show', $feedback)])
View Feedback
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
