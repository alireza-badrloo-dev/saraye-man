<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'فیلد ایمیل الزامی است.',
            'email.email' => 'فرمت ایمیل صحیح نیست.',
            'password.required' => 'رمز عبور را فراموش نکنید!',
            'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد.'
        ]);




        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {


            $request->session()->regenerate();

            return redirect()->route('user.profile');
        }


        return back()->withErrors(['email' => 'ایمیل یا رمز عبور اشتباه است',])->withInput();
    }

    public function loginShow()
    {
        return view('user.loginUser');
    }

    public function registerShow()
    {
        return view('user.registerUser');
    }

    public function register(Request $request, SmsService $sms)
    {
        $request->validate([
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'mobile' => ['required', 'string', 'min:11', 'regex:/^\d+$/', 'unique:users,mobile'],
        ], [

            'first_name.required' => 'لطفاً نام خود را وارد کنید.',
            'first_name.string' => 'نام باید به صورت متنی باشد.',
            'first_name.min' => 'نام باید حداقل 3 کاراکتر باشد',
            'last_name.required' => 'لطفاً نام خانوادگی خود را وارد کنید.',
            'last_name.string' => 'نام خانوادگی باید به صورت متنی باشد.',
            'last_name.min' => 'نام خانوادگی باید حداقل 3 کاراکتر باشد',
            'email.required' => 'فیلد ایمیل الزامی است.',
            'email.email' => 'فرمت ایمیل صحیح نیست.',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
            'password.required' => 'رمز عبور را فراموش نکنید!',
            'password.min' => 'رمز عبور باید حداقل ۶ کاراکتر باشد.',
            'mobile.required' => 'لطفاً شماره موبایل خود را وارد کنید.',
            'mobile.min' => 'شماره تلفن باید 11 رقم باشد',
            'mobile.unique' => 'این شماره موبایل قبلاً ثبت شده است.',
        ]);


        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        $sms->sendWelcomeSms($user->mobile);
        Auth::login($user);

        return redirect()->route('user.profile');
    }
}
