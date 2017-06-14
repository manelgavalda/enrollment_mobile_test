<?php

namespace Manelgavalda\EnrollmentMobileTest\Console\Commands;

use Illuminate\Console\Command;
use Scool\EnrollmentMobile\Models\Enrollment;

class RandomEnrollment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enrollment:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Basic Enrollment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        factory(Enrollment::class)->create([
            "name" => "1 Enrollment",
            "validated" => null,
            "finished" => false,
            "user_id" => 1,
            "classroom_id" => 1,
            "study_id" => 1,
            "course_id" => 1
        ]);
    }
}
