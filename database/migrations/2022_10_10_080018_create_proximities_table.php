<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProximitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proximities', function (Blueprint $table) {
            $table->id();
            $table->string('right_eye_sphere');
            $table->string('right_eye_cylinder');
            $table->string('right_eye_pd');
            $table->string('left_eye_sphere');
            $table->string('left_eye_cylinder');
            $table->string('left_eye_pd');
            $table->string('exam');
            $table->unsignedBigInteger('client_id');
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
        Schema::dropIfExists('proximities');
    }
}
