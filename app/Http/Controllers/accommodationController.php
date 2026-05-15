<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\City;
use App\Models\Room;
use Illuminate\Http\Request;

class accommodationController extends Controller
{
    public function index()
    {
        // $data = Accommodation::with('rooms');
         $data = Accommodation::withMin('rooms', 'price')->get();
        
        

        return view('user.accommodations', compact('data'));
    }
}
