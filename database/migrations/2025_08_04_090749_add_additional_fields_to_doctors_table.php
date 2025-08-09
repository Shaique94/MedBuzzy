<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add additional fields to the doctors table.
     */
    public function up(): void
    {
        // Ensure the 'qualification' column exists before proceeding
        if (!Schema::hasColumn('doctors', 'qualification')) {
            throw new \Exception('The qualification column is missing in the doctors table.');
        }

        Schema::table('doctors', function (Blueprint $table) {
            // JSON field to store an array of languages spoken by the doctor
            $table->json('languages_spoken')->nullable()->after('qualification');
            // Name of the clinic or hospital where the doctor practices
            $table->string('clinic_hospital_name', 100)->nullable()->after('languages_spoken');
            // Unique medical registration number for the doctor
            $table->string('registration_number', 50)->nullable()->unique()->after('clinic_hospital_name');
            // Detailed professional biography of the doctor
            $table->text('professional_bio')->nullable()->after('registration_number');
            // JSON field to store an array of achievements and awards
            $table->json('achievements_awards')->nullable()->after('professional_bio');
            // JSON field to store references to verification documents
            $table->json('verification_documents')->nullable()->after('achievements_awards');
            // JSON field to store social media links with platform and URL
            $table->json('social_media_links')->nullable()->after('verification_documents');
        });
    }

    /**
     * Reverse the migrations by dropping the added columns.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn([
                'languages_spoken',
                'clinic_hospital_name',
                'registration_number',
                'professional_bio',
                'medical_council_affiliation',
                'achievements_awards',
                'verification_documents',
                'social_media_links',
            ]);
        });
    }
};