<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavedSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_searches', function (Blueprint $table) {
            $table->increments('id');

            $table->text('users')->nullable(); // JSON DATA {[1,2,3,4..]},
            $table->text('brand_model')->nullable();
            $table->text('country')->nullable();
            $table->text('year')->nullable();
            $table->text('color')->nullable();
            $table->text('desc')->nullable();
            $table->text('fuel_type')->nullable(); // instead of 4 boolean options
            $table->text('gear')->nullable();
            $table->text('cylinder')->nullable();
            $table->text('car_type')->nullable();
            $table->text('roof_type')->nullable();
            $table->text('wheel_drive')->nullable(); 
            $table->text('reg_nr')->nullable();
            
            $table->integer('min_price')->unsigned()->nullable();
            $table->integer('max_price')->unsigned()->nullable();
            $table->integer('min_kilometer')->unsigned()->nullable();
            $table->integer('max_kilometer')->unsigned()->nullable();
            $table->integer('min_weight')->unsigned()->nullable(); 
            $table->integer('max_weight')->unsigned()->nullable(); 
            $table->integer('min_co2')->unsigned()->nullable();
            $table->integer('max_co2')->unsigned()->nullable(); 
            $table->integer('min_HP')->unsigned()->nullable();
            $table->integer('max_HP')->unsigned()->nullable();
            $table->integer('min_reg_fee')->unsigned()->nullable();
            $table->integer('max_reg_fee')->unsigned()->nullable();
            $table->integer('min_yearly_fee')->unsigned()->nullable();
            $table->integer('max_yearly_fee')->unsigned()->nullable();

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
        Schema::dropIfExists('saved_searches');
    }
}
