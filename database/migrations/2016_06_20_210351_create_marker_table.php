<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marker', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('letter');
            $table->string('color');
            $table->string('type');
            $table->integer('map_id')->unsigned()->nullable();
            $table->foreign('map_id')->references('id')->on('map')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('marker');
    }
}
