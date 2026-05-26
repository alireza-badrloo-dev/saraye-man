<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.loginAdmin');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $credentials = $request->only('email', 'password');
    
    if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
        $admin = Auth::guard('admin')->user();
        
        // بروزرسانی آخرین زمان لاگین - روش جایگزین
        DB::table('admins')
            ->where('id', $admin->id)
            ->update(['last_login_at' => now()]);
        
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors([
        'email' => 'ایمیل یا رمز عبور اشتباه است.',
    ])->withInput();
}

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}