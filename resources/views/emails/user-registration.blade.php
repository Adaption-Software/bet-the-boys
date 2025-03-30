@component('mail::message')
# Register Account

Welcome, you have been invited to Bet the Boys! To register your account click on the "Register" button below.

@component('mail::button', ['url' => route('register', ['email' => $email])])
Register
@endcomponent

If you did not request to register your email, ignore this email.

<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
