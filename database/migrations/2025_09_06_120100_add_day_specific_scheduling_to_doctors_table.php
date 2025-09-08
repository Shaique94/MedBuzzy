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
        Schema::table('doctors', function (Blueprint $table) {
            // Add day-specific schedule configuration
            $table->json('day_specific_schedule')->nullable()->after('available_days');
            $table->boolean('use_day_specific_schedule')->default(false)->after('day_specific_schedule');
            
            // Keep existing columns for backward compatibility
            // The day_specific_schedule JSON will contain:
            // {
            //   "monday": {"start_time": "09:00", "end_time": "17:00", "patients_per_slot": 1, "is_available": true},
            //   "tuesday": {"start_time": "09:00", "end_time": "17:00", "patients_per_slot": 1, "is_available": true},
            //   ... etc
            // }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['day_specific_schedule', 'use_day_specific_schedule']);
        });
    }
};
