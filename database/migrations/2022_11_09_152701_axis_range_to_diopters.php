<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AxisRangeToDiopters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diopters', function (Blueprint $table) {
            $table->integer('axis_range')->after('cylinder_range');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diopters', function (Blueprint $table) {
            $table->dropColumn('axis_range');
        });
    }
}
