<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        return view('user.profileEdit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
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
            'birth_date.regex' => 'فرمت تاریخ تولد باید شبیه 1403/01/15 باشد.',
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
