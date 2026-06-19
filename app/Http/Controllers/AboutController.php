<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\City;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('user.about');
    }
}