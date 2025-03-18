<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactLensesClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('contact_lenses_clients')) {
            Schema::create('contact_lenses_clients', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('date_of_birth');
                $table->string('address');
                $table->string('city');
                $table->string('phone');
                $table->integer('identity_card')->nullable();
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
        if (!Schema::hasTable('contact_lenses_clients')) {
            Schema::dropIfExists('contact_lenses_clients');
            }
        }
    }
