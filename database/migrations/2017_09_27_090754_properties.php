<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Properties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('properties', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->unique();
          $table->string('image');
          $table->string('street');
          $table->string('city');
          $table->string('state');
          $table->string('country');
          $table->string('zip');
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('properties');
    }
}
