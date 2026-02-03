<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('google_id')->nullable()->unique();
            $table->string('avatar')->nullable();
            $table->string('provider')->nullable(); // 'google' or 'email'
            $table->rememberToken();
            $table->timestamps();

            $table->index('google_id');
            $table->index('provider');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
