<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
                DB::statement("ALTER TABLE appointments MODIFY COLUMN status ENUM('pending', 'scheduled', 'completed', 'cancelled', 'rescheduled') DEFAULT 'pending'");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
           DB::statement("ALTER TABLE appointments MODIFY COLUMN status ENUM('pending', 'scheduled', 'completed', 'cancelled') DEFAULT 'pending'");
        });
    }
};
