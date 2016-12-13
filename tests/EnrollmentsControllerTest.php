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

    protected function login()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
    }

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Http\Kernel::class);

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }


    public function testIndexNotLogged()
    {
        $this->get('enrollments');
        $this->assertRedirectedTo('login');

    }
    public function testIndex()
    {

//        dd(route('enrollments.index'));
        $this->get('enrollments');
        $this->assertResponseOk();

        $this->assertViewHas('enrollments');

        $enrollments= $this->response->getOriginalContent()->getData()['enrollments'];

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $enrollments);
    }

    public function testStore()
    {
        $this->login();
        $this->assertRedirectedToRoute(route('enrollments.create'));
        $this->post('enrollments')->dump();
    }
}
