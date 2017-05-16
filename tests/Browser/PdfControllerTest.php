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
     */
    public function test_users_are_converted_to_pdf_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/enrollmentspdf/pdf')
                    ->assertSee('todo');
        });
    }

    /**
     * Test user is converted to pdf correctly.
     * @return void
     */
    public function test_enrollment_is_converted_to_pdf_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/enrollment/pdf/1')
                ->assertStatus(200);
        });
    }

    /**
     * Test user is converted to pdf correctly.
     * @return void
     */
    public function test_enrollment_is_shown_correctly()
    {
        $this->createEnrollments();

        $this->browse(function (Browser $browser) use ($enrollment) {
            $browser->visit('/enrollment/pdf/' . $enrollment->id)
                ->assertSee($enrollment->name)
                ->assertStatus(200);
        });
    }

    /**
     * Test user is converted to pdf correctly.
     *
     * @group failing
     * @return void
     */
    public function test_users_are_shown_correctly()
    {

        $enrollments = $this->createEnrollments(25);

        $this->browse(function (Browser $browser) use ($enrollments){
            $browser->visit('/enrollments/pdf/view')
            ->assertTitle('Enrollments List')
            ->assertSee($enrollments[0]->name);

            // Funciona amb css selectors.
            $this-assertEquals(2,count($browser->elements('div#enrollments-list table#enrollments-tablelist tr th')));
            $this-assertEquals(25,count($browser->elements('div#enrollments-list table#enrollments-tablelist tr')));
        });
    }

    private function createEnrollments($num = 25)
    {
        return factory(Enrollment::class, $num)->create();
    }
}
