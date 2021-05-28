<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //timestamp username action externaldata
        Schema::create('loggings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('user');
            $table->string('action', 500);
            $table->string('externaldata', 500);

            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loggings');
    }
}
