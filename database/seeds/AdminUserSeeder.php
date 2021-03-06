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
                    "name" => "Manel Gavaldà Andreu",
                    "email" => "manelgavalda@iesebre.com",
                    "password" => bcrypt(env('ADMIN_PWD', '123456'))]
            )->assignRole("manage enrollments");
        } catch (\Illuminate\Database\QueryException $exception) {

        }

        try {
            factory(Manelgavalda\EnrollmentMobileTest\User::class)->create([
                    "name" => "Normal User",
                    "email" => "normaluser@iesebre.com",
                    "password" => bcrypt(env('ADMIN_PWD', '123456'))]
            );
        } catch (\Illuminate\Database\QueryException $exception) {

        }

        try {
            factory(Manelgavalda\EnrollmentMobileTest\User::class)->create([
                    "name" => "Mr Admin",
                    "email" => "admin@iesebre.com",
                    "password" => bcrypt(env('ADMIN_PWD', '123456'))]
            )->assignRole("manage enrollments");
        } catch (\Illuminate\Database\QueryException $exception) {

        }
    }
}