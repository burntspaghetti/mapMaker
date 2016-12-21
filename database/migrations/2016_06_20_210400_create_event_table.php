<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('date_occurred')->nullable()->default('null');
            $table->string('details')->default('null');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('location');
            $table->integer('marker_id')->unsigned();
            $table->foreign('marker_id')->references('id')->on('marker');
            $table->integer('map_id')->unsigned();
            $table->foreign('map_id')->references('id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event');
    }
}
