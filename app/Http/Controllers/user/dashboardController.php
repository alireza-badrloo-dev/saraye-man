<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function dashboard(){
        $user = Auth::user(); 
        return view('user.dashboard' , compact('user'));
    }
   

    public function reserve()
    {
        $user = Auth::user(); 
        return view('user.reserve' , compact('user'));
    }

    public function comment()
    {
        $user = Auth::user(); 
        return view('user.comment' , compact('user'));
    }

    public function favorite()
    {
        $user = Auth::user(); // کل اطلاعات کاربر
        return view('user.favorite' , compact('user'));
    }

    public function logout()
    {
        
        Auth::guard('web')->logout(); 
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home'); 
    }
}
