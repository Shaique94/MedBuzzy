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
            $table->time('start_time')->nullable()->after('available_days'); // Doctor's daily start time
            $table->time('end_time')->nullable()->after('start_time');       // Doctor's daily end time
            $table->unsignedInteger('slot_duration_minutes')->default(30)->after('end_time'); // Slot duration in minutes
            $table->unsignedInteger('patients_per_slot')->default(1)->after('slot_duration_minutes'); // Max patients per slot
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn([
                'start_time',
                'end_time',
                'slot_duration_minutes',
                'patients_per_slot',
            ]);
        });
    }
};
