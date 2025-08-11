<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'patient' to the role enum
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'doctor', 'manager', 'patient') NULL DEFAULT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'patient' from the role enum
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'doctor', 'manager') NULL DEFAULT NULL");
    }
};
