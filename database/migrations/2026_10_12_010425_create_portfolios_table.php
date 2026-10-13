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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            // ---- Personal Information ----
            $table->string('full_name');
            $table->string('profile_picture')->nullable();
            $table->string('email');
            $table->string('contact_number')->nullable();
            $table->text('address')->nullable();
            $table->text('about_me')->nullable();

            // ---- Structured data (stored as JSON) ----
            // Works on SQLite, MySQL, and PostgreSQL (Supabase)
            $table->json('education')->nullable();
            $table->json('skills')->nullable();
            $table->json('projects')->nullable();
            $table->json('experience')->nullable();
            $table->json('social_links')->nullable();

            // ---- Template choice ----
            // 'simple', 'modern', or 'creative'
            $table->string('template')->default('simple');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};