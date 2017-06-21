<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPicturesAdsId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->integer('ads_id')->after('user_id')->nullable()->unsigned();
            $table->foreign('ads_id')->references('id')->on('ads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropForeign(['ads_id']);
            $table->dropColumn('ads_id');
        });
    }
}
