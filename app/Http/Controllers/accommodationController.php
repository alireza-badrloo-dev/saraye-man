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
        
        $query = Accommodation::where('status', 'active')->with(['city', 'rooms']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhereHas('city', function ($city) use ($search) {
                        $city->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;

            $bookedAccommodations = Reservation::where(function ($q) use ($fromDate, $toDate) {
                $q->whereBetween('check_in', [$fromDate, $toDate])
                    ->orWhereBetween('check_out', [$fromDate, $toDate])
                    ->orWhere(function ($sq) use ($fromDate, $toDate) {
                        $sq->where('check_in', '<=', $fromDate)
                            ->where('check_out', '>=', $toDate);
                    });
            })->pluck('accommodation_id')->unique();

            $query->whereNotIn('id', $bookedAccommodations);
        }

        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if (($minPrice !== null && $minPrice > 0) || ($maxPrice !== null && $maxPrice < 10000000)) {
            $minPrice = $minPrice ? (int)$minPrice : 0;
            $maxPrice = $maxPrice ? (int)$maxPrice : 10000000;

            $query->whereHas('rooms', function ($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('price', [$minPrice, $maxPrice]);
            });
        }

        if ($request->filled('filter_name')) {
            $query->where('title', 'like', "%{$request->filter_name}%");
        }

        if ($request->filled('facilities')) {
            $facilities = explode(',', $request->facilities);
            foreach ($facilities as $facility) {
                $query->whereJsonContains('general_facilities', $facility);
            }
        }

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

        $maxPriceInDb = Room::max('price') ?? 10000000;

        // ✅ مرتب‌سازی
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

        // ✅ فقط یک بار paginate در انتها
        $accommodations = $query->paginate(9);

        return view('user.accommodations', compact('accommodations', 'maxPriceInDb'));
    }

    public function lastAccommodations(Request $request)
    {
        $query = Accommodation::where('status', 'active')
            ->with(['city', 'rooms']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        switch ($request->sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_asc':
                $query->withMin('rooms', 'price')->orderBy('rooms_min_price', 'asc');
                break;
            case 'price_desc':
                $query->withMin('rooms', 'price')->orderBy('rooms_min_price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        
        $accommodations = $query->paginate(9);

        $cities = City::has('accommodations')->orderBy('name')->get();

        return view('user.last-accommodations', compact('accommodations', 'cities'));
    }

    public function popularAccommodations(Request $request)
    {
        $query = Accommodation::where('status', 'active')
            ->with(['city', 'rooms'])
            ->where('rating', '>', 0);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhereHas('city', function ($city) use ($search) {
                        $city->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('filter_name')) {
            $query->where('title', 'like', "%{$request->filter_name}%");
        }

        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if (($minPrice !== null && $minPrice > 0) || ($maxPrice !== null && $maxPrice < 10000000)) {
            $minPrice = $minPrice ? (int)$minPrice : 0;
            $maxPrice = $maxPrice ? (int)$maxPrice : 10000000;

            $query->whereHas('rooms', function ($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('price', [$minPrice, $maxPrice]);
            });
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

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->withMin('rooms', 'price')->orderBy('rooms_min_price', 'asc');
                    break;
                case 'price_desc':
                    $query->withMin('rooms', 'price')->orderBy('rooms_min_price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'rating':
                default:
                    $query->orderBy('rating', 'desc');
                    break;
            }
        } else {
            $query->orderBy('rating', 'desc');
        }

        
        $accommodations = $query->paginate(9);

        $maxPriceInDb = Room::max('price') ?? 10000000;

        return view('user.popular-accommodations', compact('accommodations', 'maxPriceInDb'));
    }

    public function cheapestAccommodations(Request $request)
    {
        $query = Accommodation::where('status', 'active')
            ->with(['city', 'rooms'])
            ->withMin('rooms', 'price')
            ->whereHas('rooms', function ($q) {
                $q->where('price', '>', 0);
            });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhereHas('city', function ($city) use ($search) {
                        $city->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('filter_name')) {
            $query->where('title', 'like', "%{$request->filter_name}%");
        }

        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if (($minPrice !== null && $minPrice > 0) || ($maxPrice !== null && $maxPrice < 10000000)) {
            $minPrice = $minPrice ? (int)$minPrice : 0;
            $maxPrice = $maxPrice ? (int)$maxPrice : 10000000;

            $query->whereHas('rooms', function ($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('price', [$minPrice, $maxPrice]);
            });
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

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_desc':
                    $query->orderBy('rooms_min_price', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_asc':
                default:
                    $query->orderBy('rooms_min_price', 'asc');
                    break;
            }
        } else {
            $query->orderBy('rooms_min_price', 'asc');
        }

        
        $accommodations = $query->paginate(9);

        $maxPriceInDb = Room::max('price') ?? 10000000;

        return view('user.cheapest-accommodations', compact('accommodations', 'maxPriceInDb'));
    }

    public function luxuryAccommodations(Request $request)
    {
        $query = Accommodation::where('status', 'active')
            ->with(['city', 'rooms'])
            ->withMin('rooms', 'price')
            ->whereHas('rooms', function($q) {
                $q->where('price', '>', 0);
            });

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

        if ($request->filled('filter_name')) {
            $query->where('title', 'like', "%{$request->filter_name}%");
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

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('rooms_min_price', 'asc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_desc':
                default:
                    $query->orderBy('rooms_min_price', 'desc');
                    break;
            }
        } else {
            $query->orderBy('rooms_min_price', 'desc');
        }

        
        $accommodations = $query->paginate(9);

        $maxPriceInDb = Room::max('price') ?? 10000000;

        return view('user.luxury-accommodations', compact('accommodations', 'maxPriceInDb'));
    }
}