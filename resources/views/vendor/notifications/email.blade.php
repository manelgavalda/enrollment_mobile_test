@component('mail::header')

Reset Password for Enrollment Mobile Application

@component('mail::message')

# Hello!

Restore Password Application:

@component('mail::table')
|               |               |
| ------------- |:-------------:|
|               |  From: enrollmentmobile@info.com |
@endcomponent

@component('mail::button', ['url' => $actionUrl])
Reset Password
@endcomponent

Thanks, Manel Gavaldà Andreu
@endcomponent
