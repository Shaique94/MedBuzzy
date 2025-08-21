<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Doctor;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->decimal('review_avg', 3, 1)->nullable()->after('status');
        });
        // Optionally, populate existing doctors' review_avg based on current reviews
        Doctor::all()->each(function ($doctor) {
            $doctor->updateReviewAverage();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('review_avg');
        });
    }
};
