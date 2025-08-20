<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uploaded_documents', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("returns_id")->unsigned();
            $table->enum("document_type", ["financial statement", "previous filing"]);
            $table->text("document_title");
            $table->text("document");
            $table->double("income", 20, 2);
            $table->double("tax_paid", 20, 2);
            $table->timestamps();
            $table->foreign('returns_id')->references('id')->on('returns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploaded_documents');
    }
};
