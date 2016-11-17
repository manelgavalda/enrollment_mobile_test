<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment', function (Blueprint $table) {
            $table->increments('enrollment_id');
            $table->string('enrollment_periodid');
            $table->integer('enrollment_personid');
            $table->integer('enrollment_study_id');
            $table->integer('enrollment_course_id');
            $table->integer('enrollment_group_id');
            $table->dateTime('enrollment_entryDate');
            $table->timestamp('enrollment_last_update');
            $table->integer('enrollment_creationUserId')->nullable();
            $table->integer('enrollment_lastupdateUserId')->nullable();
            $table->string('enrollment_markedForDeletion');
            $table->enum('enrollment_markedForDeletionDate',array('n', 'y'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
