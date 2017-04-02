@component('mail::message')

# Hello!

Reset Password for Enrollment Mobile Application

@component('mail::table')
|               |               |
| ------------- |:-------------:|
|               |  From: enrollmentmobile@info.com |
@endcomponent

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

Thanks, Manel Gavaldà Andreu
@endcomponent
