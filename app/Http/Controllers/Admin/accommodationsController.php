<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\City;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use \App\Exports\AccommodationsExport;
use \Maatwebsite\Excel\Facades\Excel;

class AccommodationsController extends Controller
{
    // در کنترلر AccommodationController
    public function index(Request $request)
    {
        $query = Accommodation::with('city');

        // فیلتر جستجو
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');
        }

        // فیلتر وضعیت
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // فیلتر شهر
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $accommodations = $query->paginate(15);

        // آمار برای کارت‌ها
        $totalAccommodations = Accommodation::count();
        $activeCount = Accommodation::where('status', 'active')->count();
        $pendingCount = Accommodation::where('status', 'pending')->count();
        $inactiveCount = Accommodation::where('status', 'inactive')->count() +
            Accommodation::where('status', 'blocked')->count();

        $cities = City::all();

        return view('admin.accommodation', compact(
            'accommodations',
            'totalAccommodations',
            'activeCount',
            'pendingCount',
            'inactiveCount',
            'cities'
        ));
    }

    public function add()
    {
        $cities = City::all();
        return view('admin.addAccommodation', compact('cities'));
    }

    // در متد store کنترلر AccommodationController

    public function store(Request $request)
    {
        try {
            // اعتبارسنجی
            $request->validate([
                'title' => 'required|string|max:255',
                'city_id' => 'required|exists:cities,id',
                'address' => 'required|string',
                'description' => 'required|string',
                'check_in_time' => 'required',
                'check_out_time' => 'required',
                'floors' => 'nullable|integer|min:1',
                'rooms_count' => 'nullable|integer|min:1',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                // اعتبارسنجی برای اتاق‌ها
                'rooms' => 'nullable|array',
                'rooms.*.title' => 'required|string|max:255',
                'rooms.*.capacity' => 'required|string',
                'rooms.*.beds' => 'required|string',
                'rooms.*.price' => 'required|numeric|min:0',
                'rooms.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
            ]);

            DB::beginTransaction();

            // ایجاد اقامتگاه جدید
            $accommodation = new Accommodation();
            $accommodation->title = $request->title;
            $accommodation->city_id = $request->city_id;
            $accommodation->address = $request->address;
            $accommodation->description = $request->description;
            $accommodation->check_in_time = $request->check_in_time;
            $accommodation->check_out_time = $request->check_out_time;
            $accommodation->floors = $request->floors;
            $accommodation->rooms_count = $request->rooms_count;
            $accommodation->important_notes = $request->important_notes;
            $accommodation->rating = $request->rating;

            // فیلدهای JSON
            $accommodation->general_facilities = $request->general_facilities ?? [];
            $accommodation->room_facilities = $request->room_facilities ?? [];
            $accommodation->private_facilities = $request->private_facilities ?? [];
            $accommodation->leisure_facilities = $request->leisure_facilities ?? [];
            $accommodation->entertainment_facilities = $request->entertainment_facilities ?? [];

            $accommodation->save();

            // ذخیره تصاویر اقامتگاه
            if ($request->hasFile('images')) {
                $images = [];
                foreach ($request->file('images') as $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('uplouds', $filename, 'public');
                    $images[] = $filename;
                }
                $accommodation->images = $images;
                $accommodation->save();
            }

            // ذخیره اتاق‌ها
            if ($request->has('rooms') && !empty($request->rooms)) {
                foreach ($request->rooms as $roomData) {
                    $room = new Room();
                    $room->accommodation_id = $accommodation->id;
                    $room->title = $roomData['title'];
                    $room->capacity = $roomData['capacity'];
                    $room->beds = $roomData['beds'];
                    $room->price = $roomData['price'];

                    // ذخیره تصویر اتاق
                    if (isset($roomData['image']) && $roomData['image']->isValid()) {
                        $filename = time() . '_' . uniqid() . '.' . $roomData['image']->getClientOriginalExtension();
                        $roomData['image']->storeAs('uplouds/rooms', $filename, 'public');
                        $room->image = $filename;
                    }

                    $room->save();
                }
            }

            DB::commit();

            return redirect()->route('admin.accommodation')
                ->with('success', 'اقامتگاه "' . $accommodation->title . '" با موفقیت اضافه شد');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'خطا در ذخیره اطلاعات: ' . $e->getMessage());
        }
    }

    public function show(int$id)
    {
        $accommodation = Accommodation::with('city')->findOrFail($id);
        return view('admin.showAccommodation', compact('accommodation'));
    }

    public function edit(int$id)
    {
        $accommodation = Accommodation::findOrFail($id);
        $cities = City::orderBy('name', 'asc')->get();

        // دیکد کردن امکانات برای نمایش در فرم
        // $accommodation->general_facilities = json_decode($accommodation->general_facilities, true) ?? [];
        // $accommodation->room_facilities = json_decode($accommodation->room_facilities, true) ?? [];
        // $accommodation->private_facilities = json_decode($accommodation->private_facilities, true) ?? [];
        // $accommodation->leisure_facilities = json_decode($accommodation->leisure_facilities, true) ?? [];
        // $accommodation->entertainment_facilities = json_decode($accommodation->entertainment_facilities, true) ?? [];
        // $accommodation->images = json_decode($accommodation->images, true) ?? [];

        return view('admin.editAccommodation', compact('accommodation', 'cities'));
    }

    /**
     * بروزرسانی اقامتگاه
     */
    // در متد update کنترلر AccommodationController

    public function update(Request $request,$id)
    {
        try {
            $accommodation = Accommodation::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'city_id' => 'required|exists:cities,id',
                'address' => 'required|string',
                'description' => 'required|string',
                'check_in_time' => 'required',
                'check_out_time' => 'required',
                'floors' => 'nullable|integer|min:1',
                'rooms_count' => 'nullable|integer|min:1',
                'status' => 'nullable|in:active,inactive,pending,blocked',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            DB::beginTransaction();

            // بروزرسانی اطلاعات پایه اقامتگاه
            $accommodation->title = $request->title;
            $accommodation->city_id = $request->city_id;
            $accommodation->address = $request->address;
            $accommodation->description = $request->description;
            $accommodation->check_in_time = $request->check_in_time;
            $accommodation->check_out_time = $request->check_out_time;
            $accommodation->floors = $request->floors;
            $accommodation->rooms_count = $request->rooms_count;
            $accommodation->important_notes = $request->important_notes;
            $accommodation->status = $request->status ?? $accommodation->status;
            $accommodation->rating = $request->rating;

            // بروزرسانی امکانات
            $accommodation->general_facilities = $request->general_facilities ?? [];
            $accommodation->room_facilities = $request->room_facilities ?? [];
            $accommodation->private_facilities = $request->private_facilities ?? [];
            $accommodation->leisure_facilities = $request->leisure_facilities ?? [];
            $accommodation->entertainment_facilities = $request->entertainment_facilities ?? [];

            // بروزرسانی تصاویر اقامتگاه
            $existingImages = $request->existing_images ? json_decode($request->existing_images, true) : [];
            $accommodation->images = $existingImages;

            if ($request->hasFile('images')) {
                $currentImages = $accommodation->images ?? [];
                $newImages = [];
                foreach ($request->file('images') as $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('uplouds', $filename, 'public');
                    $newImages[] = $filename;
                }
                $accommodation->images = array_merge($currentImages, $newImages);
            }

            $accommodation->save();

            // ========== بروزرسانی اتاق‌ها ==========
            $existingRoomIds = [];

            if ($request->has('rooms') && is_array($request->rooms)) {
                foreach ($request->rooms as $roomData) {
                    // بررسی می‌کنیم آیا اتاق قبلاً وجود داشته یا جدید است
                    $room = null;

                    // اگه id داشت و در دیتابیس وجود داشت
                    if (isset($roomData['id']) && !empty($roomData['id'])) {
                        $room = Room::find($roomData['id']);
                        if ($room) {
                            $existingRoomIds[] = $room->id;
                        }
                    }

                    // اگه اتاق پیدا نشد، یک اتاق جدید بساز
                    if (!$room) {
                        $room = new Room();
                        $room->accommodation_id = $accommodation->id;
                    }

                    // مقداردهی فیلدها
                    $room->title = $roomData['title'] ?? '';
                    $room->capacity = $roomData['capacity'] ?? '';
                    $room->beds = $roomData['beds'] ?? '';
                    $room->price = $roomData['price'] ?? 0;

                    // ذخیره تصویر جدید اتاق (اگه آپلود شده باشه)
                    if (isset($roomData['image']) && $roomData['image'] && $roomData['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $filename = time() . '_' . uniqid() . '.' . $roomData['image']->getClientOriginalExtension();
                        $roomData['image']->storeAs('uplouds/rooms', $filename, 'public');
                        $room->image = $filename;
                    }

                    $room->save();

                    // اضافه کردن id اتاق به لیست برای جلوگیری از حذف
                    if (!in_array($room->id, $existingRoomIds)) {
                        $existingRoomIds[] = $room->id;
                    }
                }
            }

            // حذف اتاق‌هایی که در فرم نیستند
            Room::where('accommodation_id', $accommodation->id)
                ->whereNotIn('id', $existingRoomIds)
                ->delete();

            DB::commit();

            return redirect()->route('admin.accommodation')
                ->with('success', 'اقامتگاه "' . $accommodation->title . '" با موفقیت بروزرسانی شد');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'خطا در بروزرسانی اطلاعات: ' . $e->getMessage());
        }
    }

    /**
     * حذف اقامتگاه
     */
    public function destroy(int$id)
    {
        try {
            $accommodation = Accommodation::findOrFail($id);
            $title = $accommodation->title;

            // حذف تصاویر از استوریج
            $images = $accommodation->images ?? [];

            if (!empty($images) && is_array($images)) {
                foreach ($images as $image) {
                    // فقط نام فایل رو پاک کن (بدون uplouds/)
                    $cleanImage = str_replace(['uplouds/', 'uploads/'], '', $image);

                    // مسیر درست برای حذف
                    $filePath = 'uplouds/' . $cleanImage;

                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }

            $accommodation->delete();

            return redirect()->route('admin.accommodation')
                ->with('success', 'اقامتگاه "' . $title . '" با موفقیت حذف شد');
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در حذف اقامتگاه: ' . $e->getMessage());
        }
    }



   public function downloadExcel()
{
    // دریافت داده‌ها
    $accommodations = Accommodation::where('status', 'active')
        ->with('city')
        ->withMin('rooms', 'price')
        ->get();
    
    // اسم فایل
    $fileName = 'اقامتگاه_' . date('Y-m-d') . '.csv';
    
    // هدرهای دانلود
    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => "attachment; filename=\"$fileName\"",
        'Pragma' => 'no-cache',
        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        'Expires' => '0',
    ];
    
    // ساخت محتوا
    $callback = function() use ($accommodations) {
        $file = fopen('php://output', 'w');
        
        // اضافه کردن BOM برای UTF-8 فارسی
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // هدرهای ستون‌ها
        fputcsv($file, ['شناسه', 'عنوان اقامتگاه', 'شهر', 'وضعیت', 'حداقل قیمت (تومان)']);
        
        // داده‌ها
        foreach ($accommodations as $item) {
            fputcsv($file, [
                $item->id,
                $item->title,
                $item->city->name ?? 'نامشخص',
                $item->status == 'active' ? 'فعال' : 'غیرفعال',
                number_format($item->rooms_min_price ?? 0) . ' تومان'
            ]);
        }
        
        fclose($file);
    };
    
    return response()->stream($callback, 200, $headers);
}
}
