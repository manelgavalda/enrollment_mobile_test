@component('mail::message')

    # Hello!

    Reset Password for Enrollment Mobile Application. Restore Password Application:

    @component('mail::button', ['url' => $url])
        Reset Password
    @endcomponent

    Thanks, Manel Gavaldà Andreu
@endcomponent