@component('mail::message')
    # Hello {{ $restaurant->owner->name }}

    Your restaurant **{{ $restaurant->name_restaurant }}** has been approved ✅

    You can now access your dashboard here:

    @component('mail::button', ['url' => $url])
        Go to Dashboard
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
