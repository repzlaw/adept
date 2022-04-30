@component('mail::message')
# Adept Lessor

Hi {{$name}}, <br> Your lease Application for {{$goods}} on ₦{{$amount}} has been approved for disbursement by the credit committee. <br>
Kindly contact your Account Officer for further proceedings.

{{-- @component('mail::button', ['url' => route('login')]) --}}
{{-- Login --}}
{{-- @endcomponent --}}

Thank you for choosing Adept Lessor. <br>
Adept
@endcomponent
