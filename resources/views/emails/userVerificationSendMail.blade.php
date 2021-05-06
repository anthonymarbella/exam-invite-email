@component('mail::message')
# Hello!

Please click the button below to verify your email address.

<?php
    $userId = $content['userId'];
    $code = $content['code'];
?>


@component('mail::button', ['url' => route('verification.verify', ['id' => $userId, 'code'=>$code])   ])
Verify Email Address
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent


If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:<br/>
{{ route('verification.verify', ['id' => $userId, 'code'=>$code]) }}
