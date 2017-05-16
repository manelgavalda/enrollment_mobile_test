<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PdfControllerTest extends DuskTestCase
{
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
     *
     * @group failing
     * @return void
     */
    public function test_user_is_converted_to_pdf_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/enrollment/pdf/1')
                ->assertStatus(200);
        });
    }
}
