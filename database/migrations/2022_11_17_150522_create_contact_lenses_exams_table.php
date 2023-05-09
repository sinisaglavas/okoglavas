<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactLensesExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_lenses_exams', function (Blueprint $table) {
            $table->id();
            $table->string('right_eye_sphere');
            $table->string('right_eye_cylinder');
            $table->integer('right_eye_axis');
            $table->string('left_eye_sphere');
            $table->string('left_eye_cylinder');
            $table->integer('left_eye_axis');
            $table->string('producer');
            $table->string('type');
            $table->string('base_curve');
            $table->string('diameter');
            $table->string('material');
            $table->string('packaging');
            $table->string('maximum_use');
            $table->string('exam');
            $table->unsignedBigInteger('contact_lenses_client_id');
            $table->foreign('contact_lenses_client_id')->references('id')->on('contact_lenses_clients');
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
        Schema::dropIfExists('contact_lenses_exams');
    }
}
