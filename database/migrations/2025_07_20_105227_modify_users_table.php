<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
   public function up(): void
{
    // Change enum column to allow NULL with same enum values
    DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'doctor', 'manager','patient') NULL DEFAULT NULL");
}

public function down(): void
{
    // Revert to NOT NULL with same enum values
    DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'doctor', 'manager','patient') NOT NULL");
}
};
