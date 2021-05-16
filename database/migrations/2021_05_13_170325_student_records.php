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
            $table->integer('first_grading')->nullable();
            $table->string('first_grading_status', 50)->default('PENDING');
            $table->integer('second_grading')->nullable();
            $table->string('second_grading_status', 50)->default('PENDING');
            $table->integer('third_grading')->nullable();
            $table->string('third_grading_status', 50)->default('PENDING');
            $table->integer('fourth_grading')->nullable();
            $table->string('fourth_grading_status', 50)->default('PENDING');
            $table->integer('final_grading')->nullable();
            $table->string('final_grading_status', 50)->default('PENDING');

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
