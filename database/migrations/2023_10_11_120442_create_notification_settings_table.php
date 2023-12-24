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
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned();
            $table->integer('push_notification')->default(1);
            $table->integer('email_notification')->default(1);
            $table->integer('unusual_activity')->default(1);
            $table->integer('new_browser_signin')->default(1);
            $table->integer('latest_news')->default(1);
            $table->integer('features_updates')->default(1);
            $table->integer('account_tips')->default(1);
            $table->integer('all_not')->default(1);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_settings');
    }
};
