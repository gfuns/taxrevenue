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
        Schema::create('income_sources', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("returns_id")->unsigned();
            $table->text("source");
            $table->double("salary", 12, 2)->nullable();
            $table->double("allowances", 12, 2)->nullable();
            $table->double("comissions", 12, 2)->nullable();
            $table->double("total", 12, 2);
            $table->timestamps();
            $table->foreign('returns_id')->references('id')->on('returns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_sources');
    }
};
