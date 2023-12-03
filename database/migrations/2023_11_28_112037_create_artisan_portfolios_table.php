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
        Schema::create('artisan_portfolios', function (Blueprint $table) {
            $table->id();
            $table->integer('artisan_id')->unsigned();
            $table->text('file');
            $table->string('portfolio_url')->nullable;
            $table->timestamps();
            $table->foreign('artisan_id')->references('id')->on('artisans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artisan_portfolios');
    }
};
