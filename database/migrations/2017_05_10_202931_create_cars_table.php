<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('brand');
            $table->string('model');
            $table->smallInteger('year')->unsigned();
            $table->integer('price')->unsigned();
            $table->integer('kilometer')->unsigned();
            $table->string('color'); // JSON >> https://github.com/bahamas10/css-color-names/blob/master/css-color-names.json
            $table->boolean('fuel_type_bensin')->nullable(); // 1=bensin, 2=diesel, 3=gas, 4=electric
            $table->boolean('fuel_type_diesel')->nullable(); // 5=b+d, 6=b+g, 7=
            $table->boolean('fuel_type_gas')->nullable();
            $table->boolean('fuel_type_electric')->nullable();
            $table->tinyInteger('gear')->unsigned(); // 1,2
            $table->smallInteger('weight')->unsigned(); // kg
            $table->float('cylinder')->unsigned(); // 6.0
            $table->tinyInteger('co2')->unsigned(); // 318
            $table->tinyInteger('car_type')->unsigned(); // 1,2,3...
            $table->tinyInteger('roof_type')->unsigned(); // 1,2,3...
            $table->smallInteger('HP')->unsigned();
            $table->tinyInteger('wheel_drive')->unsigned(); // 1=front, 2=rear, 3=4X4
            $table->string('reg_nr');
            $table->float('reg_fee')->unsigned();
            $table->float('yearly_fee')->unsigned();
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
        Schema::dropIfExists('cars');
    }
}
