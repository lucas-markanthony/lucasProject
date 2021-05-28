<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('student_records');
        Schema::create('student_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('studentId');
            $table->integer('enrollmentId');

            $table->string('subject', 50);
            $table->string('first_grading', 5)->nullable();
            $table->string('first_grading_status', 50)->default('PENDING');
            $table->string('second_grading', 5)->nullable();
            $table->string('second_grading_status', 50)->default('PENDING');
            $table->string('third_grading', 5)->nullable();
            $table->string('third_grading_status', 50)->default('PENDING');
            $table->string('fourth_grading', 5)->nullable();
            $table->string('fourth_grading_status', 50)->default('PENDING');
            $table->string('final_grading', 5)->nullable();
            $table->string('final_grading_status', 50)->default('PENDING');

            $table->index('enrollmentId');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_records');
    }
}
