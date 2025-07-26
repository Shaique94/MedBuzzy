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
       // First check if column exists
        if (!Schema::hasColumn('doctors', 'manager_id')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->unsignedBigInteger('manager_id')
                        ->after('user_id')
                  ->default(1) 
                  ->nullable(); 
        });
    }

        // Assign default manager (1 or your admin user ID)
        DB::table('doctors')->whereNull('manager_id')->update(['manager_id' => 1]);

        // Add foreign key constraint if not exists
        Schema::table('doctors', function (Blueprint $table) {
            $table->foreign('manager_id')
                  ->references('id')
                  ->on('users')
                 ->onDelete('set null'); 
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
     {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
            $table->dropColumn('manager_id');
        });
    }
};