<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtorsContactLensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtors_contact_lenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('client_phone');
            $table->integer('debit')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_phone')->references('phone')->on('contact_lenses_clients');
            $table->foreign('client_id')->references('id')->on('contact_lenses_clients');
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
        Schema::dropIfExists('debtors_contact_lenses');
    }
}
