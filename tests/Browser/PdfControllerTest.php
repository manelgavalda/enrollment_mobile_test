<?php

namespace Tests\Browser;

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
    public function test_users_are_shown_correctly()
    {

        $enrollments = $this->createEnrollments(25);

        dump($enrollments[0]->name);
        $this->browse(function (Browser $browser) use ($enrollments){
            $browser->visit('enrollmentspdf/view')
            ->assertTitle('Enrollments List')
            ->assertSee($enrollments[0]->name);

            // Funciona amb css selectors.
            $this->assertEquals(3,count($browser->elements('div#enrollments-list table#enrollments-tablelist tr th')));
            $this->assertEquals(26,count($browser->elements('div#enrollments-list table#enrollments-tablelist tr')));
        });
    }

    /**
     * Test user is converted to pdf correctly.
     * @return void
     * @group failing
     */
    public function test_show_dashboard_elements_without_authentication()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->assertSee('todo');
        });
    }

    private function createEnrollments($num = null)
    {
        return factory(Enrollment::class, $num)->create();
    }
    //TODO PWAT ( service worker, manifest )
}
