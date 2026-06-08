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
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('vehicle_type')->nullable(); // Cycle, Bike, etc.
            $table->string('vehicle_number')->nullable();
            $table->enum('status', ['idle', 'busy', 'offline'])->default('offline');
            $table->enum('application_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('identity_proof')->nullable(); // URL to document
            $table->decimal('current_balance', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riders');
    }
};
