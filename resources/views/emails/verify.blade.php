@component('mail::message')

Welcome to El-Listaa.
Thank you for registering.
your request in the process after verifying Email, wait for Approved in 48 hours

@component('mail::button', ['url' => {{route('website.home')}}])
Verify Email
@endcomponent


Regards,<br>
{{ config('app.name') }}

@endcomponent
