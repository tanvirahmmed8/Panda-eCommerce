@component('mail::message')
# Hello {{ $admin_name }}, Congratulations!

Your account opened by {{ $creator_name }}! please use below information to login.

@component('mail::panel')
# Email Address: {{ $admin_email }}
# Password: {{ $admin_password }}
@endcomponent

@component('mail::button', ['url' => route('login'), 'color' => 'success'])
Login here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
