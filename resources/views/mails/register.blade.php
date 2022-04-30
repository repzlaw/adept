@component('mail::message')
# Adept Lessor

Hi {{$name}}, <br>   you just created an account on adept Lessor, Thank You.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
Login
@endcomponent

Thanks,<br>
Adept
@endcomponent
