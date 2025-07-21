<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Modify existing comment column to be nullable
            $table->text('comment')->nullable()->change();

            // Add new appointment_id column (assuming foreign key)
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Reverse the changes
            $table->text('comment')->nullable(false)->change();
            $table->dropForeign(['appointment_id']);
            $table->dropColumn('appointment_id');
        });
    }
};
