<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller // بهتر است نام کلاس با حرف بزرگ شروع شود
{
    public function index($id)
    {
        // ابتدا شهر و اقامتگاه‌هایش را با Eager Loading بارگذاری می‌کنیم
        $city = City::with('accommodations.rooms')->findOrFail($id);




        $allPrices = collect();
        foreach ($city->accommodations as $acc) {
            $allPrices = $allPrices->merge($acc->rooms->pluck('price'));
        }
        $minPrice = $allPrices->isNotEmpty() ? $allPrices->min() : null;

        // حالا هم شهر و اقامتگاه‌ها و هم کمترین قیمت را به ویو ارسال می‌کنیم
        return view('user.city', compact('city', 'minPrice'));
    }
}
