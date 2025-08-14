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
            $table->boolean('user_rescheduled')->default(false)->after('rescheduled');
            $table->unsignedInteger('user_reschedule_count')->default(0)->after('user_rescheduled');
            $table->timestamp('user_rescheduled_at')->nullable()->after('user_reschedule_count');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['user_rescheduled', 'user_reschedule_count', 'user_rescheduled_at']);
        });
    }
};
