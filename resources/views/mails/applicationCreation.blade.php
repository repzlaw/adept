@component('mail::message')
# Adept Lessor

Hi {{$name}}, <br> You just created a loan application, Thank You.

@component('mail::button', ['url' => route('login')])
Login
@endcomponent

Thanks,<br>
Adept
@endcomponent
