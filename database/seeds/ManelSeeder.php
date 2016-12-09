<?php

use Illuminate\Database\Seeder;

class ManelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            factory(User::class)->create([
                    "name" => "Manel Gavaldà Andreu",
                    "email" => "manelgavalda@iesebre.com",
                    "password" => bcrypt(env('MANEL_PASS', 'secret'))]
            );
        } catch (\Illuminate\Database\QueryException $exception) {
        }
    }
}