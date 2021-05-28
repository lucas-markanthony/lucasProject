<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_enrollments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //school year
            $table->string('school_year',9);
            $table->string('grade',3);
            $table->string('section',50);

            $table->integer('studentId');
            $table->string('schemeID',250);
            $table->string('enrollment_status',50);

            $table->index('school_year');
            $table->index('grade');
            $table->index('section');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_enrollments');
    }
}
