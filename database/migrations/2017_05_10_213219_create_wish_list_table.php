<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish-list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->nullable()->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->timestamps();

            // FOREIGN KEYS
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wish-list');
    }
}
