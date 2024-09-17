@component('mail::message')
# Congratulations, {{ $company->name }} was approved for We are in IT together conference!
We are excited that you want to join us and take a part in the conference.
We look forward to seeing you on the {{ $date }}!

Meanwhile, you can add other employees from {{ $company->name }} that will be joining during the conference, request a booth or become a sponsor.
@component('mail::button', ['url' => route('company.details', $company)])
    Manage your company
@endcomponent

If you have any additional questions do not hesitate to contact us!

Kind regards,

We are in IT together conference team
@endcomponent
