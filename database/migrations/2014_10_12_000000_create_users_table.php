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
        Schema::create('users', function (Blueprint $table) {
            $table->increments("id");
            $table->string('last_name');
            $table->string('other_names');
            $table->string('email')->unique();
            $table->string('phone_number')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('profile_photo')->nullable();
            $table->string('role');
            $table->integer('role_id')->nullable();
            $table->integer('mda_id')->nullable();
            $table->integer('tax_office_id')->nullable();
            $table->enum('category', ['tax payer', 'bdic', 'birs hq', 'birs area office', 'mda admin']);
            $table->string('password');
            $table->integer('profile_updated')->default(0);
            $table->enum('status', ['active', 'suspended'])->default('active');
            $table->string('auth_2fa')->nullable();
            $table->string('google2fa_secret')->nullable();
            $table->string('token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
