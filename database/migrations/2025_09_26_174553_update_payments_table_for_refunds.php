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
        Schema::table('payments', function (Blueprint $table) {
            // Refund fields
            $table->string('refund_id')->nullable()->after('transaction_id');
            $table->decimal('refund_amount', 10, 2)->nullable()->after('refund_id');
        });

        // Enum change ke liye raw SQL (kyunki Laravel enum direct modify nahi karta)
        DB::statement("ALTER TABLE payments MODIFY COLUMN status ENUM('pending','paid','failed','refunded') NOT NULL");
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['refund_id', 'refund_amount']);
        });

        // Wapas purana enum
        DB::statement("ALTER TABLE payments MODIFY COLUMN status ENUM('pending','paid','failed') NOT NULL");
    }

};
