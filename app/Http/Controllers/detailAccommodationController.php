<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class detailAccommodationController extends Controller
{
    public function index($id){
        $data = Accommodation::findorfail($id);
        $accommodation = Accommodation::with('rooms')->findOrFail($id);

        return view('user.detailAccommodation', compact('data','accommodation'));
    }
}
