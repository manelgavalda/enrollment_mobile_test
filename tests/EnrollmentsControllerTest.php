<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Scool\EnrollmentMobile\Models\Enrollment;
use Scool\EnrollmentMobile\Repositories\EnrollmentRepository;

/**
 * Class EnrollmentsControllerTest
 */
class EnrollmentsControllerTest extends TestCase
{

    use DatabaseMigrations;

    //S'executa al començar els testos.
    protected $repository;


    public function construct()
    {

        $this->repository= Mockery::mock(EnrollmentRepository::class);
        //$this->response= Mockery::mock(EnrollmentRepository::class);
        //$this->login();
    }

    //S'executa al finalitzar els testos
    public function tearDown()
    {
        Mockery::close();
    }

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

    private function createDummyEnrollments()
    {

        $enrollment1 = new Enrollment();
        $enrollment2 = new Enrollment();
        $enrollment3 = new Enrollment();
        $enrollments = [
            $enrollment1,
            $enrollment2,
            $enrollment3,
        ];
        return collect($enrollments);
    }

    public function testIndex()
    {
        //Fase 1 : preparació -> isolation/mocking
        $this->login();

        //$this->repository->shouldReceive('pushCriteria')->once();

//        $this->repository->shouldReceive('all')->once()->andReturn(
//            $this->createDummyEnrollments()
//        );


        $this->app->instance(EnrollmentRepository::class, $this->repository);
//        dd(route('enrollments.index'));
        $this->call('GET', 'enrollments');
        //$this->get('enrollments');
        $this->assertResponseOk();

        $this->assertViewHas('enrollments');

        $enrollments = $this->response->getOriginalContent()->getData()['enrollments'];

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $enrollments);
        $this->assertEquals(count($enrollments),2);
    }

    public function testStore()
    {
        $this->login();
        //$this->assertRedirectedToRoute(route('enrollments.index'));
        //$this->post('enrollments')->dump();
        //assertSessionHas de message, al store,update
    }
     //amb name buit per que peti.
    //validacio de testStore validation fails this->assertSessionHasErrors(['name']);
    // TOTS els testos mockejats.
}
