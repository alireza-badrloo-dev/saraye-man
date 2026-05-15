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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // شناسه یکتا برای هر اتاق

            // ارتباط با اقامتگاه
            $table->foreignId('accommodation_id')
                  ->constrained('accommodations')
                  ->onDelete('cascade'); 
            // وقتی اقامتگاه حذف شد، اتاق‌هاش هم حذف بشن

            $table->string('title'); // عنوان اتاق (مثلاً سوئیت ویژه)
            $table->string('capacity'); // تعداد نفرات قابل اقامت
            $table->string('beds'); // تعداد یا نوع تخت‌ها (مثلاً ۲ تخت یک‌نفره)
            $table->string('image')->nullable(); // آدرس عکس اصلی اتاق
            $table->decimal('price', 12, 2); // قیمت اتاق (مثلاً 500000.00)

            $table->timestamps(); // تاریخ ساخت و ویرایش
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
