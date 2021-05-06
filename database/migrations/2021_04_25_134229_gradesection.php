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
        Schema::dropIfExists('schoolyear');
        Schema::create('gradeSection', function (Blueprint $table) {
            $table->integer('grade');
            $table->string('section', 100);
        });

        Schema::create('schoolyear', function (Blueprint $table) {
            $table->string('schoolyear', 9);
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
        Schema::dropIfExists('schoolyear');
    }
}
