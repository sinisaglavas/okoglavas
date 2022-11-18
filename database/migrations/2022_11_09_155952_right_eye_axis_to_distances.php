<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RightEyeAxisToDistances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distances', function (Blueprint $table) {
            $table->integer('right_eye_axis')->after('right_eye_cylinder');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distances', function (Blueprint $table) {
            $table->dropColumn('right_eye_axis');

        });
    }
}
