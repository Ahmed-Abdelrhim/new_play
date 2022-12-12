@component('mail::message')
    {{$msg}}.
    Here is Your Code
    {{$code}}
    @component('mail::button',['url' => 'http://127.0.0.1:8000/check-verified-code'])
        reset password
    @endcomponent

    Thanks
    Laravel Team
@endcomponent
