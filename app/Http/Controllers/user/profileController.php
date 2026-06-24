<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }


    public function edit()
    {
        $user = Auth::user();
        return view('user.profileEdit', compact('user'));
    }


    public function update(Request $request)
    {

        $validated = $request->validate([
            'first_name'   => 'nullable|string|max:255',
            'last_name'    => 'nullable|string|max:255',
            'nationality'  => 'nullable|string|max:255',
            'national_id'  => 'nullable|string|max:20',
            'postal_code'  => 'nullable|string|max:20',
            'gender'       => 'nullable|in:اقا,خانم',
            'birth_date'   => ['nullable', 'regex:/^\d{4}\/\d{2}\/\d{2}$/'],
            'address'      => 'nullable|string|max:1000',
        ], [
            
            'first_name.string' => 'نام باید به صورت متن باشد.',
            'first_name.max' => 'نام نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'last_name.string' => 'نام خانوادگی باید به صورت متن باشد.',
            'last_name.max' => 'نام خانوادگی نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'nationality.string' => 'ملیت باید به صورت متن باشد.',
            'nationality.max' => 'ملیت نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'national_id.string' => 'کد ملی باید به صورت متن باشد.',
            'national_id.max' => 'کد ملی نباید بیشتر از ۲۰ کاراکتر باشد.',

            'postal_code.string' => 'کد پستی باید به صورت متن باشد.',
            'postal_code.max' => 'کد پستی نباید بیشتر از ۲۰ کاراکتر باشد.',

            'gender.in' => 'جنسیت انتخاب شده معتبر نیست. گزینه‌های مجاز: اقا، خانم',

            'birth_date.regex' => 'فرمت تاریخ تولد باید شبیه ۱۴۰۳/۰۱/۱۵ باشد.',

            'address.string' => 'آدرس باید به صورت متن باشد.',
            'address.max' => 'آدرس نباید بیشتر از ۱۰۰۰ کاراکتر باشد.',
        ]);

        $user = $request->user();


        $user->update([
            'first_name'  => $validated['first_name'] ?? $user->first_name,
            'last_name'   => $validated['last_name'] ?? $user->last_name,
            'nationality' => $validated['nationality'] ?? $user->nationality,
            'national_id' => $validated['national_id'] ?? $user->national_id,
            'postal_code' => $validated['postal_code'] ?? $user->postal_code,
            'gender'      => $validated['gender'] ?? $user->gender,
            'birth_date'  => $validated['birth_date'] ?? $user->birth_date,
            'address'     => $validated['address'] ?? $user->address,
        ]);

        return redirect('/user/profile')->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    }

    
}
