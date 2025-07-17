<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('doctors', function (Blueprint $table) {
        $table->date('unavailable_from')->nullable()->after('available_days');
        $table->date('unavailable_to')->nullable()->after('unavailable_from');
    });
}

public function down()
{
    Schema::table('doctors', function (Blueprint $table) {
        $table->dropColumn('unavailable_from');
        $table->dropColumn('unavailable_to');
    });
}

};
