<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->integer('graduation_year');
            $table->string('department');
            $table->string('city')->nullable();
            $table->string('current_job')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_photo_url')->nullable();
            $table->json('privacy_settings')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('verification_document_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni_profiles');
    }
};
