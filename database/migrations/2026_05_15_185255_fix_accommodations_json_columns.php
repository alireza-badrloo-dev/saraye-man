<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Accommodation;

return new class extends Migration
{
    public function up()
    {
        $accommodations = Accommodation::all();
        foreach ($accommodations as $accommodation) {
            // تبدیل images
            if (is_string($accommodation->images)) {
                $accommodation->images = json_decode($accommodation->images, true);
            }
            // تبدیل general_facilities
            if (is_string($accommodation->general_facilities)) {
                $accommodation->general_facilities = json_decode($accommodation->general_facilities, true);
            }
            // تبدیل room_facilities
            if (is_string($accommodation->room_facilities)) {
                $accommodation->room_facilities = json_decode($accommodation->room_facilities, true);
            }
            // تبدیل private_facilities
            if (is_string($accommodation->private_facilities)) {
                $accommodation->private_facilities = json_decode($accommodation->private_facilities, true);
            }
            // تبدیل leisure_facilities
            if (is_string($accommodation->leisure_facilities)) {
                $accommodation->leisure_facilities = json_decode($accommodation->leisure_facilities, true);
            }
            // تبدیل entertainment_facilities
            if (is_string($accommodation->entertainment_facilities)) {
                $accommodation->entertainment_facilities = json_decode($accommodation->entertainment_facilities, true);
            }
            
            $accommodation->saveQuietly();
        }
    }

    public function down()
    {
        // برگشت به حالت قبل لازم نیست
    }
};