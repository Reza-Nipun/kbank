<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicabilities', function (Blueprint $table) {
            $table->id();
            $table->string('applicability_name')->nullable();
            $table->string('applicability_description')->nullable();
            $table->integer('status')->comment('0=Inactive, 1=Active')->nullable();
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
        Schema::dropIfExists('applicabilities');
    }
}
