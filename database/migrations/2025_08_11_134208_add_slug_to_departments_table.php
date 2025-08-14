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
        Schema::table('departments', function (Blueprint $table) {
            $table->string('slug')->after('name')->nullable()->unique();
        });

          // Generate slugs for existing departments
    $departments = \App\Models\Department::all();
    foreach ($departments as $department) {
        $department->slug = \Illuminate\Support\Str::slug($department->name);
        $department->save();
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            //
        });
    }
};
