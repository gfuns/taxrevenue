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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->integer("tax_payer_id")->unsigned();
            $table->integer("mda_id")->unsigned();
            $table->integer("payment_type_id")->unsigned()->nullable();
            $table->integer("payment_item_id")->unsigned();
            $table->integer("tax_office_id")->unsigned();
            $table->string("period");
            $table->string("reference");
            $table->text("narration")->nullable();
            $table->double("amount", 20, 2);
            $table->enum("status", ["pending", "successful", "failed"])->default("pending");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('mdas')->onDelete('cascade');
            $table->foreign('tax_payer_id')->references('id')->on('tax_payers')->onDelete('cascade');
            $table->foreign('mda_id')->references('id')->on('mdas')->onDelete('cascade');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade');
            $table->foreign('payment_item_id')->references('id')->on('payment_items')->onDelete('cascade');
            $table->foreign('tax_office_id')->references('id')->on('tax_offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
