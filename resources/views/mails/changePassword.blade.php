@component('mail::message')
# Adept Lessor

Hi {{$name}}, <br> You just changed your password on adeptlessor, Thank You.

@component('mail::button', ['url' => route('login')])
Login
@endcomponent

Thanks,<br>
Adept
@endcomponent
