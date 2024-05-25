<x-mail::message>
# Reset your password

To reset your password, please click on the button below

<x-mail::button :url="$mailData['url']">
Reset my password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
