<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountToDailyTurnovers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_turnovers', function (Blueprint $table) {
            if (!Schema::hasColumn('daily_turnovers', 'discount')) {
                $table->integer('discount')->after('price')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_turnovers', function (Blueprint $table) {
            if (!Schema::hasColumn('daily_turnovers', 'discount')) {
                $table->dropColumn('discount');
            }
        });
    }
}
