<?php

namespace Tests;

use Manelgavalda\EnrollmentMobileTest\User as User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Scool\EnrollmentMobile\Models\Enrollment;
use Scool\EnrollmentMobile\Repositories\EnrollmentRepository;
use Scool\EnrollmentMobile\Repositories\ModuleRepository;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class EnrollmentsControllerTest
 */
class EnrollmentsControllerTest extends BrowserKitTest
{

    use DatabaseMigrations;

    //S'executa al començar els testos.
    protected $repository;


    public function construct()
    {
        $this->repository= Mockery::mock(EnrollmentRepository::class);
    }

    //S'executa al finalitzar els testos
    public function tearDown()
    {
        Mockery::close();
    }

    protected function normalLogin()
    {
        $normalUser = factory(User::class)->create();
        $this->actingAs($normalUser);
    }

    protected function adminLogin()
    {
        Permission::create(['name' => 'browse enrollments']);
        Permission::create(['name' => 'read enrollments']);
        Permission::create(['name' => 'edit enrollments']);
        Permission::create(['name' => 'add enrollments']);
        Permission::create(['name' => 'delete enrollments']);
        $role = Role::create(['name' => 'manage enrollments']);
        $role->givePermissionTo('browse enrollments');
        $role->givePermissionTo('read enrollments');
        $role->givePermissionTo('edit enrollments');
        $role->givePermissionTo('add enrollments');
        $role->givePermissionTo('delete enrollments');

        $adminUser = factory(User::class)->create();
        $this->actingAs($adminUser->assignRole("manage enrollments"));

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
    /**
     * User without redirect to login.
     * @group failing
     * @return void
     */
    public function testIndexWithoutUser()
    {

        $this->app->instance(EnrollmentRepository::class, $this->repository);
        $this->call('GET', 'enrollments');

        //Redirect.
        $this->assertResponseStatus(302);
    }

    /**
     * User without permission see unauthorized.
     * @group failing
     * @return void
     */
    public function testIndexWithoutPermission()
    {
        //Fase 1 : preparació -> isolation/mocking
        $this->normalLogin();

        $this->app->instance(EnrollmentRepository::class, $this->repository);
        $this->call('GET', 'enrollments');

        //Unauthorized.
        $this->assertResponseStatus(403);
    }

    /**
     * User with permission can login.
     * @group failing
     * @return void
     */
    public function testIndexWithPermission()
    {
        //Fase 1 : preparació -> isolation/mocking
        $this->adminLogin();

        $this->app->instance(ModuleRepository::class, $this->repository);
        $this->call('GET', 'modules');
        $this->assertResponseOk();
        $this->assertViewHas('modules');

        $modules = $this->response->getOriginalContent()->getData()['modules'];

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $modules);
    }

    /**
     * Store modules with permission can login.
     * @group failing
     * @return void
     */
    public function testStore()
    {
        $this->normalLogin();


        $this->call('GET', 'modules');

        $this->post('modules');

        $modules = $this->response->getOriginalContent();

        $this->assertEquals(count($modules),1);
    }

    /**
     * Delete modules with permission can login.
     * @group failing
     * @return void
     */
    public function testDelete()
    {
        $this->normalLogin();


        $this->call('GET', 'modules');

        $this->delete('modules');

        $modules = $this->response->getOriginalContent();

        $this->assertEquals(count($modules),1);
    }

    /**
     * User without permission see unauthorized.
     * @group failing
     * @return void
     */
    public function nonLogedUserCantSeeDashboard()
    {
        //Fase 1 : preparació -> isolation/mocking
        $this->app->instance(EnrollmentRepository::class, $this->repository);
        $this->call('GET', 'home');
        $this->assertResponseStatus(403);
    }

    /**
     * User without permission see unauthorized.
     * @group failing
     * @return void
     */
    public function logedUserCanSeeDashboard()
    {
        //Fase 1 : preparació -> isolation/mocking
        $this->normalLogin();

        $this->app->instance(EnrollmentRepository::class, $this->repository);
        $this->call('GET', 'home');
        $this->assertResponseOk();
    }
}
