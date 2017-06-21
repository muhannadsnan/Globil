<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->nullable()->unsigned();
            $table->integer('user_id')->nullable()->unsigned(); // not to know who uploaded it, but to use it for profile
            $table->integer('album_id')->nullable()->unsigned();
            $table->string('ext');
            $table->timestamps();

            // FOREIGN KEYS
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
