<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\City;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {

        $data = Accommodation::where('status', 'active')->withMin('rooms', 'price')->get();
        $city = City::all()->take(8);

        
        $popularAccommodations = Accommodation::where('status', 'active')
            ->with(['city', 'rooms'])
            ->orderBy('rating', 'desc')
            ->take(6)
            ->get();

        $cheapestAccommodations = Accommodation::where('status', 'active')
            ->with(['city', 'rooms'])
            ->withMin('rooms', 'price')
            ->orderBy('rooms_min_price', 'asc')
            ->take(6)
            ->get();

        $luxuryAccommodations = Accommodation::where('status', 'active')
            ->with(['city', 'rooms'])
            ->withMin('rooms', 'price')
            ->orderBy('rooms_min_price', 'desc')
            ->take(6)
            ->get();

        return view('user.home', compact('data', 'city', 'luxuryAccommodations', 'cheapestAccommodations', 'popularAccommodations'));
    }


    
}
