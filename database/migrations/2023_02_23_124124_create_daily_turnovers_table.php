<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyTurnoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_turnovers', function (Blueprint $table) {
            $table->id();
            $table->string('article');
            $table->string('describe');
            $table->string('material');
            $table->string('installation_type');
            $table->integer('pcs');
            $table->integer('price');
            $table->integer('total');
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('stock_id')->references('id')->on('stocks');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('daily_turnovers');
    }
}
