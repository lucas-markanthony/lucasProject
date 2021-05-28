<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // student data
            $table->string('lrn',13);

            $table->string('first_name',150);
            $table->string('last_name',150);
            $table->string('middle_name',150)->nullable();
            $table->string('ext_name',150)->nullable();
            
            $table->integer('age')->nullable();
            $table->string('gender',6);
            $table->date('dob');
            
            $table->string('contact_no',15)->nullable();
            $table->string('email',150)->nullable();
            
            // student address
            $table->string('street',150)->nullable();
            $table->string('barangay',150)->nullable();
            $table->string('city',150)->nullable();
            $table->string('province',150)->nullable();
            $table->string('country',150)->nullable();
            $table->string('postal',6)->nullable();

            //parent data
            $table->string('father_name',255)->nullable();
            $table->string('father_occupation',150)->nullable();
            $table->string('father_contact',15)->nullable();
            $table->string('mother_name',255)->nullable();
            $table->string('mother_occupation',150)->nullable();
            $table->string('mother_contact',15)->nullable();
            $table->string('guardian_name',255)->nullable();
            $table->string('guardian_occupation',150)->nullable();
            $table->string('guardian_contact',15)->nullable();

            // elem school data
            $table->string('e_schoolname',255)->nullable();
            $table->string('e_schoolyr',50)->nullable();
            $table->string('e_address',255)->nullable();

            $table->index('lrn');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
