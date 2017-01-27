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
            $table->string('details')->nullable()->default('null');
            $table->string('lat')->default('null');
            $table->string('lng')->default('null');
            $table->string('location')->nullable()->default('null');
//            $table->integer('location_id')->unsigned();
//            $table->foreign('location_id')->references('id')->on('location');
            $table->integer('marker_id')->nullable()->unsigned();
            $table->foreign('marker_id')->nullable()->references('id')->on('marker');
            $table->integer('map_id')->unsigned();
            $table->foreign('map_id')->references('id')->on('map');
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
