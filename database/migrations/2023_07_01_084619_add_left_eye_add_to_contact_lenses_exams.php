<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeftEyeAddToContactLensesExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_lenses_exams', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_lenses_exams', 'left_eye_add')) {
                $table->string('left_eye_add')->after('left_eye_axis')->nullable();
            }
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
            if (!Schema::hasColumn('contact_lenses_exams', 'left_eye_add')) {
                $table->dropColumn('left_eye_add');
            }
        });
    }
}
