<x-mail::message>
# Activate your account

To activate your account, please click on the button below

<x-mail::button :url="$mailData['url']">
Activate
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
