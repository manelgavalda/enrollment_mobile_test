<?php

namespace Tests\Browser;

use Manelgavalda\EnrollmentMobileTest\User;
use Scool\EnrollmentMobile\Models\Enrollment;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PdfControllerTest extends DuskTestCase
{
    //les sqlite en memòria no funcionen amb el dusk ja que s'executen desde el navegador.
    use DatabaseMigrations;
    /**
     * Test enrollments are converted to pdf correctly.
     *
     * @return void
     * @group failing
     */
    public function test_users_are_converted_to_pdf_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/enrollmentspdf/pdf');
//                      ->pause(500000);
//                    ->assertSee('html');
            //No puc comprovar pdf.
        });
    }

    /**
     * Test user is converted to pdf correctly.
     * @return void
     * @group failing
     */
    public function test_enrollment_is_converted_to_pdf_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/enrollment/pdf/1')
                ->assertSee('todo');
        });
    }

    /**
     * Test user is converted to pdf correctly.
     * @return void
     * @group failing
     */
    public function test_enrollment_is_shown_correctly()
    {
        $enrollment = $this->createEnrollments();

        $this->browse(function (Browser $browser) use ($enrollment) {
            $browser->visit('/enrollment/pdf/' . $enrollment->id)
                ->assertSee('todo');
        });
    }

    /**
     * Test user is converted to pdf correctly.
     * @return void
     */
//    public function test_users_are_shown_correctly()
//    {
//
//        $enrollments = $this->createEnrollments(25);
//
//        dump($enrollments[0]->name);
//        $this->browse(function (Browser $browser) use ($enrollments){
//            $browser->visit('enrollmentspdf/view')
//            ->assertTitle('Enrollments List')
//            ->assertSee($enrollments[0]->name);
//
//            // Funciona amb css selectors.
//            $this->assertEquals(3,count($browser->elements('div#enrollments-list table#enrollments-tablelist tr th')));
//            $this->assertEquals(26,count($browser->elements('div#enrollments-list table#enrollments-tablelist tr')));
//        });
//    }

public function test_can_view_login()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
//                ->pause(50000)
            ->assertPathIs('/login');
//            ->assertSee(' Sign in to start your session ');
    });
}

    /**
     * Test cant view dashboard without login.
     * @return void
     * @group failing
     */
    public function test_can_view_dashboard_without_login()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
//                ->pause(50000)
                ->assertPathIs('/login');
        });
    }

    /**
     * Test can view dashboard with login.
     * @return void
     * @group failing
     */
    public function test_can_view_dashboard_when_login()
    {
        $user = factory(User::class)->create([
            'name' => 'Manel Gavaldà',
            'email' => 'dusklogin@iesebre.com'
        ]);

        $this->browse(function (Browser $browser)  use ($user) {
            $browser->visit('/home')
                ->assertPathIs('/login')
                ->pause(10000)
                ->type('email', $user->email)
                ->pause(10000)
                ->type('password', 'secret')
                ->pause(10000)
                ->press('Sign In')
                ->pause(10000)
                ->assertPathIs('/home')
                ->pause(10000)
                ->assertSee('Dashboard')
                ->pause(10000)
                ->assertSee('Enrollment')
                ->pause(10000)
                ->assertSee('Manel Gavaldà');
        });
    }

    private function createEnrollments($num = null)
    {
        return factory(Enrollment::class, $num)->create();
    }
    //TODO PWAT ( service worker, manifest )
}
