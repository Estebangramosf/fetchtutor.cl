<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeckEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deck_events', function (Blueprint $table) {
            $table->increments('EVM_ID');
            $table->integer('EVN_ID');
            $table->integer('JGD_ID');
            $table->integer('MAZ_ID');
            $table->string('EVM_NOMBRE_MAZO');
            $table->string('EVM_POSICION');
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
        Schema::dropIfExists('deck_events');
    }
}
