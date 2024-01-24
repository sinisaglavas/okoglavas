<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDebtorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_debtors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('debit')->nullable(); // duguje
            $table->integer('installment_number')->nullable(); // broj rata
            $table->integer('installment_amount')->nullable(); // iznos rate
            $table->string('debt_company'); // kompanija koja je dužna
            $table->text('note')->nullable();
            $table->unsignedBigInteger('debt_company_id');
            $table->unsignedBigInteger('client_id');
            $table->foreign('debt_company_id')->references('id')->on('debt_companies');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('company_debtors');
    }
}
