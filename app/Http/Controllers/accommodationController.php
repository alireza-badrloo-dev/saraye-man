<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\City;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class accommodationController extends Controller
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
        
        // 2. فیلتر بر اساس تاریخ
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            
            $bookedAccommodations = Reservation::where(function($q) use ($fromDate, $toDate) {
                $q->whereBetween('check_in', [$fromDate, $toDate])
                  ->orWhereBetween('check_out', [$fromDate, $toDate])
                  ->orWhere(function($sq) use ($fromDate, $toDate) {
                      $sq->where('check_in', '<=', $fromDate)
                         ->where('check_out', '>=', $toDate);
                  });
            })->pluck('accommodation_id')->unique();
            
            $query->whereNotIn('id', $bookedAccommodations);
        }
        
        // 3. فیلتر بر اساس محدوده قیمت
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        // بررسی اینکه آیا فیلتر قیمت اعمال شده است
        if (($minPrice !== null && $minPrice > 0) || ($maxPrice !== null && $maxPrice < 10000000)) {
            $minPrice = $minPrice ? (int)$minPrice : 0;
            $maxPrice = $maxPrice ? (int)$maxPrice : 10000000;
            
            // استفاده از whereHas برای فیلتر بر اساس اتاق‌ها
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
        
        // 6. فیلتر بر اساس امتیاز (از جدول comments)
        if ($request->filled('rating')) {
            $rating = $request->rating;
            if ($rating == 4.5) {
                $query->where('rating', '>=', 4.5);
            } elseif ($rating == 4) {
                $query->whereBetween('rating', [4, 4.49]);
            } elseif ($rating == 3.5) {
                $query->whereBetween('rating', [3.5, 3.99]);
            } elseif ($rating == 3) {
                $query->whereBetween('rating', [3, 3.49]);
            } elseif ($rating == 0) {
                $query->where('rating', '<', 3);
            }
        }
        
        // 7. محاسبه بیشترین قیمت برای نمایش در فیلتر
        $maxPriceInDb = Room::max('price') ?? 10000000;
        
        // 8. مرتب‌سازی
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
        
        $accommodations = $query->paginate(12);
        
        return view('user.accommodations', compact('accommodations', 'maxPriceInDb'));
    }
    
    
}