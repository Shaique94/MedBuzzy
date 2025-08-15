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
            // Add new payment status fields
            $table->enum('payment_status', ['initiated', 'processing', 'paid', 'failed', 'refunded'])->default('initiated')->after('status');
            $table->string('order_id')->nullable()->after('razorpay_signature');
            $table->string('receipt_no')->nullable()->after('order_id');
            $table->decimal('total_amount', 10, 2)->nullable()->after('amount');
            $table->timestamp('payment_date')->nullable()->after('total_amount');
            $table->string('ip_address')->nullable()->after('payment_date');
            $table->integer('month')->nullable()->after('ip_address');
            $table->integer('year')->nullable()->after('month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'payment_status', 
                'order_id', 
                'receipt_no', 
                'total_amount', 
                'payment_date', 
                'ip_address', 
                'month', 
                'year'
            ]);
        });
    }
};
