<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentContactLensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_contact_lenses', function (Blueprint $table) {
            $table->id();
            $table->integer('payment')->nullable();
            $table->unsignedBigInteger('debtors_contact_lenses_id');
            $table->foreign('debtors_contact_lenses_id')->references('id')->on('debtors_contact_lenses');
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
        Schema::dropIfExists('payment_contact_lenses');
    }
}
