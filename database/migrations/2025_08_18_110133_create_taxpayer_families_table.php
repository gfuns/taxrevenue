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
        Schema::create('taxpayer_families', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("tax_payer_id")->unsigned()->nullable();
            $table->enum("reationship", ["spouse", "child"]);
            $table->date("dob");
            $table->string("btin")->nullable();
            $table->string("occupation");
            $table->text("business_name")->nullable();
            $table->text("business_address")->nullable();
            $table->timestamps();
            $table->foreign('tax_payer_id')->references('id')->on('tax_payers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxpayer_families');
    }
};
