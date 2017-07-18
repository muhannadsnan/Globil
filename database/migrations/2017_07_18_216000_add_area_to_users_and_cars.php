<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAreaToUsersAndCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {            
            $table->integer('manicipality')->unsigned()->nullable()->after('phone');
            $table->integer('city')->unsigned()->nullable()->after('manicipality');
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->integer('manicipality')->unsigned()->nullable()->after('yearly_fee');
            $table->integer('city')->unsigned()->nullable()->after('manicipality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->string('city')->nullable();
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('manicipality');
            $table->dropColumn('city');
        });
    }
}
