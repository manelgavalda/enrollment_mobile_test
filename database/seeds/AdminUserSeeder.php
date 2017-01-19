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
            factory(App\User::class)->create([
                    "name" => "manelgavalda",
                    "email" => "manelgavalda@iesebre.com",
                    "password" => bcrypt(env('ADMIN_PWD', '123456'))/*->assignRole('administrator')*/]
            );
        } catch (\Illuminate\Database\QueryException $exception) {

        }
    }
}