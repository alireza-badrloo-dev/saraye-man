<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller // بهتر است نام کلاس با حرف بزرگ شروع شود
{
    public function index($id)
    {

        $city = City::with(['accommodations' => function ($query) {
            $query->where('status', 'active')
                ->withMin('rooms', 'price')
                ->withCount('rooms')
                ->with('rooms');
        }])->findOrFail($id);

        
        $minPrice = $city->accommodations->min('rooms_min_price');

        

        return view('user.city', compact('city', 'minPrice'));
    }
}
