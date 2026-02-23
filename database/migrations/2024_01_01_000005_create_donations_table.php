<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->foreignId('donor_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->boolean('anonymous')->default(false);
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'received', 'refunded'])->default('pending');
            $table->string('proof_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
