<?php

use Illuminate\Database\Seeder;
use Scool\EnrollmentMobile\Database\Seeds\EnrollmentMobileSeeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserSeeder::class);
        //Added enrollments seeder.
        $this->call(EnrollmentMobileSeeder::class);
    }
}