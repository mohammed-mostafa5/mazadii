use App\Mail\RegistrationMail;
@component('mail::message')
{{$data['email']}} has been registered at our newsletter .
@endcomponent