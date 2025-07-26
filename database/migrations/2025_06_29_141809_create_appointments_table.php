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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->enum('status', ['pending','scheduled', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
              $table->date('original_date')->nullable(); 
    $table->boolean('rescheduled')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
