<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCarTableFuelType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['fuel_type_bensin', 'fuel_type_diesel', 'fuel_type_gas', 'fuel_type_electric']);
            $table->integer('fuel_type')->after('co2')->unsigned();
        });
    }

    /**
     * Reverse the migrations.     *
     * @return void

     */
    public function down()
    {
        //
    }
}
