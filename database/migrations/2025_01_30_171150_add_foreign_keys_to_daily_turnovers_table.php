<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDailyTurnoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_turnovers', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->after('total')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->cascadeOnDelete();// Veza sa klijentom
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
            $table->dropForeign(['client_id']);  // Brišemo strani ključ client_id
            $table->dropColumn('client_id');  // Brišemo client_id kolonu
        });
    }
}
