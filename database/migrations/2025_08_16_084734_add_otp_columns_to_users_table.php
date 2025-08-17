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
        Schema::table('users', function (Blueprint $table) {
            $table->string('otp', 6)->nullable()->after('remember_token');
            $table->timestamp('otp_generated_at')->nullable()->after('otp');
        });
    }

    /**
     * Reverse the migrations.
     */
     public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['otp', 'otp_generated_at']);
        });
    }
};
