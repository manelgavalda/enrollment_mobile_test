<?php

use Illuminate\Database\Seeder;

/**
 * Class AdminUserSeeder
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            factory(Manelgavalda\EnrollmentMobileTest\User::class)->create([
                    "name" => "manel",
                    "email" => "manelgavalda@iesebre.com",
                    "password" => bcrypt(env('ADMIN_PWD', '123456'))]
            )->assignRole("manage enrollments");
        } catch (\Illuminate\Database\QueryException $exception) {

        }
    }
}