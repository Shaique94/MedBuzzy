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
        Schema::table('appointments', function (Blueprint $table) {
          $table->boolean('is_rescheduled')->default(false);
            $table->foreignId('original_appointment_id')
                ->nullable()
                ->constrained('appointments')
                ->onDelete('set null');
            $table->text('reschedule_reason')->nullable();
            $table->dateTime('rescheduled_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
             $table->dropForeign(['original_appointment_id']);
            $table->dropColumn([
                'is_rescheduled',
                'original_appointment_id',
                'reschedule_reason',
                'rescheduled_at'
            ]);
        });
    }
};
