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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('razorpay_payment_id')->nullable()->after('transaction_id');
            $table->string('razorpay_order_id')->nullable()->after('razorpay_payment_id');
            $table->text('razorpay_signature')->nullable()->after('razorpay_order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['razorpay_payment_id', 'razorpay_order_id', 'razorpay_signature']);
        });
    }
};
