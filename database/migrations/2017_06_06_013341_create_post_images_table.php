<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostImagesTable extends Migration
{
    public function up()
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image',5000);
            $table->integer('user_id');
            $table->integer('post_id');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('post_images');
    }
}
