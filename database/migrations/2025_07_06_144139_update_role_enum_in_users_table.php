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
        // Change enum column by running raw SQL
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'doctor', 'manager') NOT NULL");
    }

    public function down(): void
    {
        // Revert to original enum (remove manager)
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'doctor') NOT NULL");
    }
};
