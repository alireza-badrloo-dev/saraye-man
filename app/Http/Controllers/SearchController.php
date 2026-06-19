<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // شروع کوئری برای اقامتگاه‌های فعال
        $query = Accommodation::where('status', 'active')->with(['city', 'rooms']);
        
        // 1. جستجو بر اساس نام شهر یا عنوان اقامتگاه
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhereHas('city', function($city) use ($search) {
                      $city->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        // 2. فیلتر بر اساس تاریخ (اقامتگاه‌هایی که در بازه انتخابی رزرو نشده‌اند)
        if ($request->filled('from_date') && $request->filled('to_date')) {
            try {
                // تبدیل تاریخ شمسی به میلادی
                $fromDate = Jalalian::fromFormat('Y/m/d', $request->from_date)->toCarbon();
                $toDate = Jalalian::fromFormat('Y/m/d', $request->to_date)->toCarbon();
                
                // پیدا کردن اقامتگاه‌هایی که در بازه تاریخ رزرو شده‌اند
                $bookedAccommodations = Reservation::where(function($q) use ($fromDate, $toDate) {
                    // رزروهایی که تاریخ ورود یا خروجشان در بازه است
                    $q->whereBetween('check_in', [$fromDate, $toDate])
                      ->orWhereBetween('check_out', [$fromDate, $toDate])
                      // یا رزروهایی که بازه انتخابی را کاملاً پوشش می‌دهند
                      ->orWhere(function($sq) use ($fromDate, $toDate) {
                          $sq->where('check_in', '<=', $fromDate)
                             ->where('check_out', '>=', $toDate);
                      });
                })->pluck('accommodation_id')->unique();
                
                // حذف اقامتگاه‌های رزرو شده
                if ($bookedAccommodations->isNotEmpty()) {
                    $query->whereNotIn('id', $bookedAccommodations);
                }
                
            } catch (\Exception $e) {
                // اگر تاریخ نامعتبر بود، خطا نده و ادامه بده
            }
        }
        
        // 3. فیلتر بر اساس محدوده قیمت
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        if (($minPrice !== null && $minPrice > 0) || ($maxPrice !== null && $maxPrice < 10000000)) {
            $minPrice = $minPrice ? (int)$minPrice : 0;
            $maxPrice = $maxPrice ? (int)$maxPrice : 10000000;
            
            $query->whereHas('rooms', function($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('price', [$minPrice, $maxPrice]);
            });
        }
        
        // 4. فیلتر بر اساس نام اقامتگاه (فیلتر سمت راست)
        if ($request->filled('filter_name')) {
            $query->where('title', 'like', "%{$request->filter_name}%");
        }
        
        // 5. فیلتر بر اساس امکانات
        if ($request->filled('facilities')) {
            $facilities = explode(',', $request->facilities);
            foreach ($facilities as $facility) {
                $query->whereJsonContains('general_facilities', $facility);
            }
        }
        
        // 6. فیلتر بر اساس امتیاز
        if ($request->filled('rating')) {
            $rating = $request->rating;
            if ($rating >= 4.5) {
                $query->where('rating', '>=', 4.5);
            } elseif ($rating >= 4) {
                $query->whereBetween('rating', [4, 4.49]);
            } elseif ($rating >= 3.5) {
                $query->whereBetween('rating', [3.5, 3.99]);
            } elseif ($rating >= 3) {
                $query->whereBetween('rating', [3, 3.49]);
            } else {
                $query->where('rating', '<', 3);
            }
        }
        
        // 7. مرتب‌سازی
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->withMin('rooms', 'price')->orderBy('rooms_min_price', 'asc');
                    break;
                case 'price_desc':
                    $query->withMin('rooms', 'price')->orderBy('rooms_min_price', 'desc');
                    break;
                case 'rating_desc':
                    $query->orderBy('rating', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        // محاسبه بیشترین قیمت برای نمایش در فیلتر
        $maxPriceInDb = Room::max('price') ?? 10000000;
        
        // اجرای کوئری با صفحه‌بندی
        $accommodations = $query->paginate(12);
        
        return view('user.search-results', compact('accommodations', 'maxPriceInDb'));
    }
}