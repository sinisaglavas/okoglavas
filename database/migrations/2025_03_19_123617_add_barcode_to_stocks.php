<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarcodeToStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('barcode')->after('describe')->nullable();
            //unsigned ako bar-kod ne može biti negativan
            //bolje je koristiti bigInteger umesto integer
            //jer bar-kodovi često imaju više cifara nego što standardni integer može da podrži
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('barcode');
        });
    }
}
