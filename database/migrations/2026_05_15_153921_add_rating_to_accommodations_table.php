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
             $table->decimal('rating', 2, 1) // 2 رقم کل، 1 رقم اعشار (مثلاً 4.5)
                  ->nullable()
                  ->default(0)
                  ->comment('امتیاز اقامتگاه از 0 تا 5')
                  ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accommodations', function (Blueprint $table) {
              $table->dropColumn('rating');
        });
    }
};
