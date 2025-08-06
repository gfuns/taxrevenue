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
        Schema::create('payment_items', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('mda_id')->unsigned();
            $table->string("revenue_item");
            $table->string("revenue_code");
            $table->double("amount", 12, 2)->nullable();
            $table->double("percentage", 12, 2)->nullable();
            $table->enum("fee_config", ["fixed", "percentage", "assessment based"]);
            $table->enum("status", ["active", "deactivated"])->default("active");
            $table->timestamps();
            $table->foreign('mda_id')->references('id')->on('mdas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_items');
    }
};
