<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
         Schema::table('accommodations', function (Blueprint $table) {
            $table->foreignId('city_id')->constrained()->onDelete('cascade'); // کلید خارجی
        });
    }

    public function down(): void
    {
         Schema::table('accommodations', function (Blueprint $table) {
            $table->dropForeign(['city_id']); // حذف کلید خارجی
            $table->dropColumn('city_id'); // حذف ستون
        });
    }
};
