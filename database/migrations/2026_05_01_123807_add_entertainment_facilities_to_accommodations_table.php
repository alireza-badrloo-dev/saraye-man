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
         Schema::table('accommodations', function (Blueprint $table) {
            $table->string('entertainment_facilities')->nullable(); // اضافه کردن ستون جدید
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('accommodations', function (Blueprint $table) {
            $table->dropColumn('entertainment_facilities'); // برای برگرداندن تغییرات
        });
    }
};
