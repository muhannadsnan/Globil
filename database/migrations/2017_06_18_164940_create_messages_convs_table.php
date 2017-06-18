<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesConvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_1')->unsigned();
            $table->integer('user_id_2')->unsigned();
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conv_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('text');
            $table->boolean('seen')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('conv_id')->references('id')->on('conversations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
        Schema::dropIfExists('messages');
    }
}
