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
         Schema::create('accommodations', function (Blueprint $table) {
            $table->id(); // شناسه یکتا برای هر اقامتگاه
            $table->string('title'); // عنوان اقامتگاه
            $table->text('address'); // آدرس کامل اقامتگاه
            $table->json('images')->nullable(); // آرایه‌ای از آدرس عکس‌ها (چند عکس) - از نوع JSON استفاده می‌کنیم
            $table->time('check_in_time'); // ساعت ورود
            $table->time('check_out_time'); // ساعت خروج
            $table->tinyInteger('floors')->nullable(); // تعداد طبقات
            $table->smallInteger('rooms_count')->nullable(); // تعداد کل اتاق‌ها (برای اطلاعات کلی)
            $table->text('description'); // توضیحات کلی اقامتگاه
            $table->json('general_facilities')->nullable(); // امکانات عمومی (مثلا پارکینگ، وای‌فای) - JSON
            $table->json('room_facilities')->nullable(); // امکانات اتاق‌ها (مثلا تهویه، تلویزیون) - JSON
            $table->json('private_facilities')->nullable(); // امکانات اختصاصی (مثلا استخر خصوصی) - JSON
            $table->json('leisure_facilities')->nullable(); // امکانات رفاهی و تفریحی (مثلا سالن بازی، استخر عمومی) - JSON
            $table->text('important_notes')->nullable(); // نکات مهم اقامتگاه
            $table->timestamps(); // ستون‌های created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
