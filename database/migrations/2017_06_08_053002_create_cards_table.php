<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('CRT_ID');
            $table->integer('CRT_NUMERO_EDICION');
            $table->string('CRT_NOMBRE');
            $table->string('CRT_TIPO');
            $table->string('CRT_MANA');
            $table->string('CRT_RAREZA');
            $table->string('CRT_ARTISTA');
            $table->string('CRT_EDICION');
            $table->string('EDN_COD_INTERNO');
            $table->integer('EDN_ID');
            $table->string('CRT_IMAGEN');
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
        Schema::dropIfExists('cards');
    }
}
