<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('debt_companies')) {
            Schema::create('debt_companies', function (Blueprint $table) {
                $table->id();
                $table->string('name_company'); // naziv kompanije
                $table->text('other_data')->nullable(); // ostali podaci
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('debt_companies')) {
            Schema::dropIfExists('debt_companies');
        }
    }
}
