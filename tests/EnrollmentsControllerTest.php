<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class EnrollmentsControllerTest
 */
class EnrollmentsControllerTest extends TestCase
{

    use DatabaseMigrations;
    /**
     *
     */

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Http\Kernel::class);

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function testsIndex()
    {

//        dd(route('enrollments.index'));
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        $this->get('enrollments')->dump();
        $this->assertResponseOk();
    }
}
