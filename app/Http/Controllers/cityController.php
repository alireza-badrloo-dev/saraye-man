<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\City;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;

class CityController extends Controller
{
    public function index($id, Request $request)
    {
        
        $city = City::findOrFail($id);
        
        
        $query = Accommodation::where('status', 'active')->where('city_id', $id)->with(['city', 'rooms']);
        
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }
        
       
        if ($request->filled('from_date') && $request->filled('to_date')) {
            try {
                $fromDate = Jalalian::fromFormat('Y/m/d', $request->from_date)->toCarbon();
                $toDate = Jalalian::fromFormat('Y/m/d', $request->to_date)->toCarbon();
                
                $bookedAccommodations = Reservation::where(function($q) use ($fromDate, $toDate) {
                    $q->whereBetween('check_in', [$fromDate, $toDate])
                      ->orWhereBetween('check_out', [$fromDate, $toDate])
                      ->orWhere(function($sq) use ($fromDate, $toDate) {
                          $sq->where('check_in', '<=', $fromDate)
                             ->where('check_out', '>=', $toDate);
                      });
                })->pluck('accommodation_id')->unique();
                
                if ($bookedAccommodations->isNotEmpty()) {
                    $query->whereNotIn('id', $bookedAccommodations);
                }
            } catch (\Exception $e) {
                Log::error('Date filter error: ' . $e->getMessage());
            }
        }
        
        
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        
        if (($minPrice !== null && $minPrice > 0) || ($maxPrice !== null && $maxPrice < 10000000)) {
            $minPrice = $minPrice ? (int)$minPrice : 0;
            $maxPrice = $maxPrice ? (int)$maxPrice : 10000000;
            
            
            $query->whereHas('rooms', function($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('price', [$minPrice, $maxPrice]);
            });
        }
        
        if ($request->filled('filter_name')) {
            $query->where('title', 'like', "%{$request->filter_name}%");
        }
        
    
        if ($request->filled('facilities')) {
            $facilities = explode(',', $request->facilities);
            foreach ($facilities as $facility) {
                $query->whereJsonContains('general_facilities', trim($facility));
            }
        }
        
        
        if ($request->filled('rating')) {
            $rating = (float)$request->rating;
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
        
       
        $maxPriceInDb = Room::max('price') ?? 10000000;
        
       
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->withMin('rooms', 'price')
                          ->orderBy('rooms_min_price', 'asc');
                    break;
                case 'price_desc':
                    $query->withMin('rooms', 'price')
                          ->orderBy('rooms_min_price', 'desc');
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
        
        $accommodations = $query->paginate(9);
        
        
        $accommodations->appends($request->all());
        
        return view('user.city', compact('city', 'accommodations', 'maxPriceInDb'));
    }
}