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
        Schema::create('returns', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->integer("tax_payer_id")->unsigned();
            $table->enum("category", ["individual", "corporate"]);
            $table->string("period");
            $table->string("reference");
            $table->text("narration")->nullable();
            $table->double("income", 20, 2);
            $table->double("tax_paid", 20, 2);
            $table->enum("status", ["draft", "awaiting assessment", "awaiting payment", "paid"])->default("draft");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tax_payer_id')->references('id')->on('tax_payers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
