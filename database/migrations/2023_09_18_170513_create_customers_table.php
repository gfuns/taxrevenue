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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('username')->nullable();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('photo')->nullable();
            $table->string('gender')->nullable();
            $table->string('account_pin')->nullable();
            $table->enum('verification_status', ['none', 'pending', 'verified'])->default('none');
            $table->enum('account_type', ["guest", "artisan", "business"])->default('guest');
            $table->string('referral_code')->nullable();
            $table->string('device_token')->nullable();
            $table->enum('status', ["active", "suspended", "banned", "deleted"])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
