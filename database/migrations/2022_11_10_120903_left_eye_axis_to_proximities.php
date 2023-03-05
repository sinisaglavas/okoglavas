<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeftEyeAxisToProximities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proximities', function (Blueprint $table) {
            $table->integer('left_eye_axis')->after('left_eye_cylinder');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proximities', function (Blueprint $table) {
            $table->dropColumn('left_eye_axis');

        });
    }
}
