<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRightEyeAddToContactLensesExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_lenses_exams', function (Blueprint $table) {
            $table->string('right_eye_add')->after('right_eye_axis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_lenses_exams', function (Blueprint $table) {
            $table->dropColumn('right_eye_add');
        });
    }
}
