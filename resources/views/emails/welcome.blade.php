@component('mail::message')
# Welcome {{ $user->name }}

Your account is fully activated and ready to use!

@component('mail::button', ['url' => config('app.url')])
    View Account
@endcomponent

{{ empty($info) ? '' : $info }}

Thanks,
{{ config('app.name') }}
@endcomponent
