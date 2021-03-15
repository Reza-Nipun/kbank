<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id()->comment('Document Number');
            $table->integer('reference_no')->nullable();
            $table->string('reference_code')->nullable();
            $table->string('subject')->nullable();
            $table->integer('version')->nullable();
            $table->string('document_url')->nullable();
            $table->foreignId('category_id')->constrained('categories')->nullable();
            $table->foreignId('applicability_id')->constrained('applicabilities')->nullable();
            $table->foreignId('document_type_id')->constrained('document_types')->nullable();
            $table->foreignId('uploaded_by')->constrained('users')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
