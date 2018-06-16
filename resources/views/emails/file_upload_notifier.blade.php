@component('mail::message')
# Hello admin,

Family file upload was successful. Below is the result

Success Count: {{$success_count}}
<br>
Error Count:{{$error_count}}

@if($error_count > 0)
    Error Result

    @component('mail::table')
        | Family Reg. Number              | Error Message  |
        | ------------- |:-------------:| --------:|
        @foreach($result['errors'] AS $error)
        | {{ $error['family_registration_number']}}             | {{$error['error_message']}} |
        @endforeach
    @endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
