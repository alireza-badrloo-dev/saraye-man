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

    public function index(Request $request)
    {
        $query = Accommodation::with('city');


        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');
        }


        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }


        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $accommodations = $query->paginate(15);


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



    public function store(Request $request)
    {
        try {

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
                'rooms' => 'nullable|array',
                'rooms.*.title' => 'required|string|max:255',
                'rooms.*.capacity' => 'required|string',
                'rooms.*.beds' => 'required|string',
                'rooms.*.price' => 'required|numeric|min:0',
                'rooms.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
            ], [

                'title.required' => 'وارد کردن عنوان اقامتگاه الزامی است.',
                'title.string' => 'عنوان اقامتگاه باید به صورت متن باشد.',
                'title.max' => 'عنوان اقامتگاه نباید بیشتر از ۲۵۵ کاراکتر باشد.',

                'city_id.required' => 'انتخاب شهر الزامی است.',
                'city_id.exists' => 'شهر انتخاب شده معتبر نیست.',

                'address.required' => 'وارد کردن آدرس اقامتگاه الزامی است.',
                'address.string' => 'آدرس اقامتگاه باید به صورت متن باشد.',

                'description.required' => 'وارد کردن توضیحات اقامتگاه الزامی است.',
                'description.string' => 'توضیحات اقامتگاه باید به صورت متن باشد.',

                'check_in_time.required' => 'وارد کردن ساعت ورود الزامی است.',

                'check_out_time.required' => 'وارد کردن ساعت خروج الزامی است.',

                'floors.integer' => 'تعداد طبقات باید به صورت عدد باشد.',
                'floors.min' => 'تعداد طبقات باید حداقل ۱ باشد.',

                'rooms_count.integer' => 'تعداد اتاق‌ها باید به صورت عدد باشد.',
                'rooms_count.min' => 'تعداد اتاق‌ها باید حداقل ۱ باشد.',


                'images.*.image' => 'فایل انتخاب شده باید تصویر باشد.',
                'images.*.mimes' => 'فرمت تصویر باید یکی از jpeg, png, jpg, webp باشد.',
                'images.*.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',

                'rooms.array' => 'اتاق‌ها باید به صورت آرایه ارسال شوند.',


                'rooms.*.title.required' => 'وارد کردن عنوان اتاق الزامی است.',
                'rooms.*.title.string' => 'عنوان اتاق باید به صورت متن باشد.',
                'rooms.*.title.max' => 'عنوان اتاق نباید بیشتر از ۲۵۵ کاراکتر باشد.',

                'rooms.*.capacity.required' => 'وارد کردن ظرفیت اتاق الزامی است.',
                'rooms.*.capacity.string' => 'ظرفیت اتاق باید به صورت متن باشد.',

                'rooms.*.beds.required' => 'وارد کردن تعداد تخت‌ها الزامی است.',
                'rooms.*.beds.string' => 'تعداد تخت‌ها باید به صورت متن باشد.',

                'rooms.*.price.required' => 'وارد کردن قیمت اتاق الزامی است.',
                'rooms.*.price.numeric' => 'قیمت اتاق باید به صورت عدد باشد.',
                'rooms.*.price.min' => 'قیمت اتاق نمی‌تواند منفی باشد.',

                'rooms.*.image.image' => 'فایل انتخاب شده باید تصویر باشد.',
                'rooms.*.image.mimes' => 'فرمت تصویر اتاق باید یکی از jpeg, png, jpg, webp باشد.',
                'rooms.*.image.max' => 'حجم تصویر اتاق نباید بیشتر از ۲ مگابایت باشد.',
            ]);

            DB::beginTransaction();

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


            $accommodation->general_facilities = $request->general_facilities ?? [];
            $accommodation->room_facilities = $request->room_facilities ?? [];
            $accommodation->private_facilities = $request->private_facilities ?? [];
            $accommodation->leisure_facilities = $request->leisure_facilities ?? [];
            $accommodation->entertainment_facilities = $request->entertainment_facilities ?? [];

            $accommodation->save();

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


            if ($request->has('rooms') && !empty($request->rooms)) {
                foreach ($request->rooms as $roomData) {
                    $room = new Room();
                    $room->accommodation_id = $accommodation->id;
                    $room->title = $roomData['title'];
                    $room->capacity = $roomData['capacity'];
                    $room->beds = $roomData['beds'];
                    $room->price = $roomData['price'];


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

    public function show(int $id)
    {
        $accommodation = Accommodation::with('city')->findOrFail($id);
        return view('admin.showAccommodation', compact('accommodation'));
    }

    public function edit(int $id)
    {
        $accommodation = Accommodation::findOrFail($id);
        $cities = City::orderBy('name', 'asc')->get();

        return view('admin.editAccommodation', compact('accommodation', 'cities'));
    }



    public function update(Request $request, $id)
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
            ], [
                
                'title.required' => 'وارد کردن عنوان اقامتگاه الزامی است.',
                'title.string' => 'عنوان اقامتگاه باید به صورت متن باشد.',
                'title.max' => 'عنوان اقامتگاه نباید بیشتر از ۲۵۵ کاراکتر باشد.',

                'city_id.required' => 'انتخاب شهر الزامی است.',
                'city_id.exists' => 'شهر انتخاب شده معتبر نیست.',

                'address.required' => 'وارد کردن آدرس اقامتگاه الزامی است.',
                'address.string' => 'آدرس اقامتگاه باید به صورت متن باشد.',

                'description.required' => 'وارد کردن توضیحات اقامتگاه الزامی است.',
                'description.string' => 'توضیحات اقامتگاه باید به صورت متن باشد.',

                'check_in_time.required' => 'وارد کردن ساعت ورود الزامی است.',

                'check_out_time.required' => 'وارد کردن ساعت خروج الزامی است.',

                'floors.integer' => 'تعداد طبقات باید به صورت عدد باشد.',
                'floors.min' => 'تعداد طبقات باید حداقل ۱ باشد.',

                'rooms_count.integer' => 'تعداد اتاق‌ها باید به صورت عدد باشد.',
                'rooms_count.min' => 'تعداد اتاق‌ها باید حداقل ۱ باشد.',

                'status.in' => 'وضعیت انتخاب شده معتبر نیست. گزینه‌های مجاز: فعال، غیرفعال، در انتظار، مسدود',

                
                'images.*.image' => 'فایل انتخاب شده باید تصویر باشد.',
                'images.*.mimes' => 'فرمت تصویر باید یکی از jpeg, png, jpg, webp باشد.',
                'images.*.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
            ]);

            DB::beginTransaction();


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


            $accommodation->general_facilities = $request->general_facilities ?? [];
            $accommodation->room_facilities = $request->room_facilities ?? [];
            $accommodation->private_facilities = $request->private_facilities ?? [];
            $accommodation->leisure_facilities = $request->leisure_facilities ?? [];
            $accommodation->entertainment_facilities = $request->entertainment_facilities ?? [];


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


            $existingRoomIds = [];

            if ($request->has('rooms') && is_array($request->rooms)) {
                foreach ($request->rooms as $roomData) {

                    $room = null;

                    if (isset($roomData['id']) && !empty($roomData['id'])) {
                        $room = Room::find($roomData['id']);
                        if ($room) {
                            $existingRoomIds[] = $room->id;
                        }
                    }


                    if (!$room) {
                        $room = new Room();
                        $room->accommodation_id = $accommodation->id;
                    }


                    $room->title = $roomData['title'] ?? '';
                    $room->capacity = $roomData['capacity'] ?? '';
                    $room->beds = $roomData['beds'] ?? '';
                    $room->price = $roomData['price'] ?? 0;


                    if (isset($roomData['image']) && $roomData['image'] && $roomData['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $filename = time() . '_' . uniqid() . '.' . $roomData['image']->getClientOriginalExtension();
                        $roomData['image']->storeAs('uplouds/rooms', $filename, 'public');
                        $room->image = $filename;
                    }

                    $room->save();


                    if (!in_array($room->id, $existingRoomIds)) {
                        $existingRoomIds[] = $room->id;
                    }
                }
            }


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

    
    public function destroy(int $id)
    {
        try {
            $accommodation = Accommodation::findOrFail($id);
            $title = $accommodation->title;

            
            $images = $accommodation->images ?? [];

            if (!empty($images) && is_array($images)) {
                foreach ($images as $image) {
                    
                    $cleanImage = str_replace(['uplouds/', 'uploads/'], '', $image);

                    
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
        
        $accommodations = Accommodation::where('status', 'active')
            ->with('city')
            ->withMin('rooms', 'price')
            ->get();

       
        $fileName = 'اقامتگاه_' . date('Y-m-d') . '.csv';

        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        
        $callback = function () use ($accommodations) {
            $file = fopen('php://output', 'w');

            
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

           
            fputcsv($file, ['شناسه', 'عنوان اقامتگاه', 'شهر', 'وضعیت', 'حداقل قیمت (تومان)']);

            
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
