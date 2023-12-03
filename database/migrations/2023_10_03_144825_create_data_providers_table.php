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
        Schema::create('data_providers', function (Blueprint $table) {
            $table->id();
            $table->string('biller');
            $table->string('service_id');
            $table->string('biller_logo');
            $table->double('fee', 12, 2)->default(0.00);
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_providers');
    }
};
