<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('properties');
            $table->integer('block_id')->unsigned();
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->integer('unit_id')->unsigned();
//            $table->foreign('unit_id')->references('id')->on('units');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('type');
            $table->string('message')->nullable();
            $table->text('image')->nullable();
            $table->timestamps('created_at');
            $table->integer('status')->default(1);
            $table->dateTime('resolved_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
