<?php

namespace Manelgavalda\EnrollmentMobileTest\Listeners;

use Manelgavalda\EnrollmentMobileTest\Events\NewRegisteredUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GrantPermissionsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewRegisteredUserEvent  $event
     * @return void
     */
    public function handle(NewRegisteredUserEvent $event)
    {
        $event->user->assignRole("manage enrollments");
    }
}
