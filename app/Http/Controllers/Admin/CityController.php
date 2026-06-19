<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::withCount('accommodations')
            ->orderBy('name')
            ->paginate(5);
        
        return view('admin.city', compact('cities'));
    }

    public function create()
    {
        return view('admin.createCity');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // ذخیره عکس
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cities', 'public');
            $validated['image'] = $imagePath;
        }

        City::create($validated);

        return redirect()->route('admin.cities.index')
            ->with('success', 'شهر با موفقیت اضافه شد.');
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('admin.editCity', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // ذخیره عکس جدید
        if ($request->hasFile('image')) {
            // حذف عکس قدیمی
            if ($city->image) {
                Storage::disk('public')->delete($city->image);
            }
            
            $imagePath = $request->file('image')->store('cities', 'public');
            $validated['image'] = $imagePath;
        }

        $city->update($validated);

        return redirect()->route('admin.cities.index')
            ->with('success', 'شهر با موفقیت ویرایش شد.');
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        
        if ($city->accommodations()->count() > 0) {
            return back()->with('error', 'این شهر دارای اقامتگاه است و قابل حذف نمی‌باشد.');
        }
        
        // حذف عکس
        if ($city->image) {
            Storage::disk('public')->delete($city->image);
        }
        
        $city->delete();

        return back()->with('success', 'شهر با موفقیت حذف شد.');
    }
}