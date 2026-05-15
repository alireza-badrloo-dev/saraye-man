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
            // اضافه کردن ستون mobile بعد از ستون password (یا هر ستون دلخواه دیگر)
            // nullable() یعنی این ستون اجباری نیست (می‌تواند خالی باشد)
            // unique() یعنی هر شماره موبایل فقط یک بار می‌تواند در جدول وجود داشته باشد
            $table->string('mobile')->unique()->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // اگر migration rollback شد، ستون mobile را حذف کن
            $table->dropColumn('mobile');
        });
    }
};
