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
        Schema::table('reservations', function (Blueprint $table) {
            // چک کردن وجود فیلدها قبل از اضافه کردن
            if (!Schema::hasColumn('reservations', 'authority')) {
                $table->string('authority')->nullable()->after('tracking_code');
            }
            
            if (!Schema::hasColumn('reservations', 'ref_id')) {
                $table->string('ref_id')->nullable()->after('authority');
            }
            
            if (!Schema::hasColumn('reservations', 'transaction_id')) {
                $table->string('transaction_id')->nullable()->after('ref_id');
            }
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['authority', 'ref_id', 'transaction_id']);
        });
    }
};
