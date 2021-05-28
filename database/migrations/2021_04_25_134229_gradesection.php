<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Gradesection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('gradeSection');
        Schema::dropIfExists('subjectGroup');
        Schema::create('gradeSection', function (Blueprint $table) {
            $table->string('schoolyear', 9);
            $table->string('grade', 3);
            $table->string('section', 100);
            $table->string('subjectgroup', 50);
        });

        Schema::create('subjectGroup', function (Blueprint $table) {
            $table->string('name', 50);
            $table->string('subjectgroup', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gradeSection');
        Schema::dropIfExists('subjectGroup');
        Schema::dropIfExists('subjectDescriptions');
    }
}
