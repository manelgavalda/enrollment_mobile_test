<?php

namespace Manelgavalda\EnrollmentMobileTest\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Manelgavalda\EnrollmentMobileTest\Events\SomeEvent' => [
            'Manelgavalda\EnrollmentMobileTest\Listeners\EventListener',
        ],
        'Manelgavalda\EnrollmentMobileTest\Events\NewRegisteredUserEvent' => [
            'Manelgavalda\EnrollmentMobileTest\Listeners\GrantPermissionsListener',
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
