<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\City;
use Illuminate\Http\Request;

class homeController extends Controller
{
     public function index(){
        
        $data = Accommodation::withMin('rooms', 'price')->get();
        $city = City::all();
        
        return view('user.home' , compact('data', 'city' ));
    }
}
