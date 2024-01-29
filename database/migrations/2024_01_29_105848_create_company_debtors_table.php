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
            $table->date('date');
            $table->string('debt_company'); // kompanija koja je dužna
            $table->string('name');
            $table->integer('debit')->nullable(); // duguje
            $table->integer('installment_number'); // broj rata
            $table->decimal('installment_amount', 8, 2); // iznos rate
            $table->decimal('total_all', 12, 2)->default(0.00); // 12 ukupno mesta, 2 decimale
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
