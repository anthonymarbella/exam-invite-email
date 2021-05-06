@component('mail::message')
# Hello!

You are invited to register to "Anthony Marbella test system"

<?php
    $code = $offer['code'];
?>


@component('mail::button', ['url' => route('register')."/".$code])
Click here to register
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
