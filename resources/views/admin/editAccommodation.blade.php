@extends('admin.Layout.master')
@section('Content')
    <div class="p-4 md:p-6">
        <!-- دکمه بازگشت -->
        <div class="mb-6">
            <a href="{{ route('admin.accommodation') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-indigo-600 transition-colors">
                <i class="fas fa-arrow-right"></i>
                <span>بازگشت به لیست اقامتگاه‌ها</span>
            </a>
        </div>

        <!-- نمایش پیام موفقیت -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- نمایش پیام خطا -->
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- عنوان صفحه -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">ویرایش اقامتگاه</h1>
                <p class="text-gray-500 mt-1">اطلاعات اقامتگاه را ویرایش کنید</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.accommodation.show', $accommodation->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                    <i class="fas fa-eye"></i>
                    <span>مشاهده اقامتگاه</span>
                </a>
            </div>
        </div>

        <!-- فرم ویرایش اقامتگاه -->
        <form action="{{ route('admin.accommodation.update', $accommodation->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- اطلاعات پایه -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-info-circle text-indigo-600"></i>
                        اطلاعات پایه
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">عنوان اقامتگاه <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $accommodation->title) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('title')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">شهر <span
                                class="text-red-500">*</span></label>
                        <select name="city_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                            <option value="">انتخاب شهر</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ old('city_id', $accommodation->city_id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ریتینگ اقامتگاه </label>
                        <input type="text" name="rating" value="{{ old('rating', $accommodation->rating) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('rating')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-2">آدرس <span
                                class="text-red-500">*</span></label>
                        <textarea name="address" rows="3" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">{{ old('address', $accommodation->address) }}</textarea>
                        @error('address')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- زمان‌های ورود و خروج -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-clock text-indigo-600"></i>
                        زمان‌های ورود و خروج
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">زمان ورود (Check-in) <span
                                class="text-red-500">*</span></label>
                        <input type="time" name="check_in_time"
                            value="{{ old('check_in_time', $accommodation->check_in_time) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('check_in_time')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">زمان خروج (Check-out) <span
                                class="text-red-500">*</span></label>
                        <input type="time" name="check_out_time"
                            value="{{ old('check_out_time', $accommodation->check_out_time) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('check_out_time')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- مشخصات فیزیکی -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-building text-indigo-600"></i>
                        مشخصات فیزیکی
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تعداد طبقات</label>
                        <input type="number" name="floors" value="{{ old('floors', $accommodation->floors) }}"
                            min="1"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('floors')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تعداد اتاق‌ها</label>
                        <input type="number" name="rooms_count"
                            value="{{ old('rooms_count', $accommodation->rooms_count) }}" min="1"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('rooms_count')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- توضیحات -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-align-left text-indigo-600"></i>
                        توضیحات کامل
                    </h3>
                </div>
                <div class="p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">توضیحات <span
                            class="text-red-500">*</span></label>
                    <textarea name="description" rows="6" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">{{ old('description', $accommodation->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- امکانات عمومی -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-wifi text-indigo-600"></i>
                        امکانات عمومی
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @php
                            $generalFacilitiesList = [
                                'وای فای رایگان',
                                'پارکینگ',
                                'رستوران',
                                'کافه',
                                'پذیرش ۲۴ ساعته',
                                'آسانسور',
                                'سیستم گرمایشی',
                                'سیستم سرمایشی',
                                'خدمات تاکسی',
                                'خشکشویی',
                                'انبار چمدان',
                                'سرویس رفت و آمد',
                            ];
                            $selectedGeneral = old('general_facilities', $accommodation->general_facilities ?? []);
                            if (!is_array($selectedGeneral)) {
                                $selectedGeneral = json_decode($selectedGeneral, true) ?? [];
                            }
                        @endphp
                        @foreach ($generalFacilitiesList as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="general_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, $selectedGeneral) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- امکانات اتاق -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-bed text-indigo-600"></i>
                        امکانات اتاق
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @php
                            $roomFacilitiesList = [
                                'تلویزیون',
                                'یخچال',
                                'گاوصندوق',
                                'رخت‌آویز',
                                'میز کار',
                                'صندلی',
                                'کمد لباس',
                                'دمپایی',
                                'حوله',
                                'لوازم بهداشتی',
                                'سشوار',
                                'چای و قهوه',
                            ];
                            $selectedRoom = old('room_facilities', $accommodation->room_facilities ?? []);
                            if (!is_array($selectedRoom)) {
                                $selectedRoom = json_decode($selectedRoom, true) ?? [];
                            }
                        @endphp
                        @foreach ($roomFacilitiesList as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="room_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, $selectedRoom) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- امکانات اختصاصی -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-swimming-pool text-indigo-600"></i>
                        امکانات اختصاصی
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @php
                            $privateFacilitiesList = [
                                'استخر اختصاصی',
                                'باشگاه ورزشی',
                                'اسپا و سونا',
                                'جکوزی',
                                'باغ اختصاصی',
                                'تراس',
                                'باربیکیو',
                                'آشپزخانه مجزا',
                                'پارکینگ اختصاصی',
                                'ورودی اختصاصی',
                            ];
                            $selectedPrivate = old('private_facilities', $accommodation->private_facilities ?? []);
                            if (!is_array($selectedPrivate)) {
                                $selectedPrivate = json_decode($selectedPrivate, true) ?? [];
                            }
                        @endphp
                        @foreach ($privateFacilitiesList as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="private_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, $selectedPrivate) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- امکانات تفریحی و سرگرمی -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-gamepad text-indigo-600"></i>
                        امکانات تفریحی و سرگرمی
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @php
                            $entertainmentFacilitiesList = [
                                'اتاق بازی',
                                'سینما',
                                'بیلیارد',
                                'تنیس روی میز',
                                'بازی‌های ویدیویی',
                                'کتابخانه',
                                'اجاره دوچرخه',
                                'تورهای گردشگری',
                            ];
                            $selectedEntertainment = old(
                                'entertainment_facilities',
                                $accommodation->entertainment_facilities ?? [],
                            );
                            if (!is_array($selectedEntertainment)) {
                                $selectedEntertainment = json_decode($selectedEntertainment, true) ?? [];
                            }
                        @endphp
                        @foreach ($entertainmentFacilitiesList as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="entertainment_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, $selectedEntertainment) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- امکانات اوقات فراغت -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-hiking text-indigo-600"></i>
                        امکانات اوقات فراغت
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @php
                            $leisureFacilitiesList = [
                                'کوهنوردی',
                                'اسکی',
                                'ماهیگیری',
                                'اسب‌سواری',
                                'ورزش‌های آبی',
                                'یوگا',
                                'ماساژ',
                                'منطقه پیک نیک',
                            ];
                            $selectedLeisure = old('leisure_facilities', $accommodation->leisure_facilities ?? []);
                            if (!is_array($selectedLeisure)) {
                                $selectedLeisure = json_decode($selectedLeisure, true) ?? [];
                            }
                        @endphp
                        @foreach ($leisureFacilitiesList as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="leisure_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, $selectedLeisure) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- تصاویر موجود -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-images text-indigo-600"></i>
                        تصاویر اقامتگاه
                    </h3>
                </div>
                <div class="p-6">
                    @php
                        $currentImages = $accommodation->images ?? [];
                        if (is_string($currentImages)) {
                            $currentImages = json_decode($currentImages, true) ?? [];
                        }
                    @endphp

                    @if (!empty($currentImages))
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">تصاویر فعلی</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($currentImages as $index => $image)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/uplouds/' . $image) }}"
                                            class="w-full h-32 object-cover rounded-lg">
                                        <button type="button" onclick="removeImage('{{ $image }}', this)"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="existing_images" id="existingImages"
                                value="{{ json_encode($currentImages) }}">
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">اضافه کردن تصاویر جدید</label>
                        <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        <p class="text-xs text-gray-500 mt-1">حداکثر حجم هر تصویر ۵ مگابایت | فرمت‌های مجاز: jpeg, png,
                            jpg, webp</p>
                        @error('images.*')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- وضعیت اقامتگاه -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-toggle-on text-indigo-600"></i>
                        وضعیت اقامتگاه
                    </h3>
                </div>
                <div class="p-6">
                    <select name="status"
                        class="w-full md:w-64 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        <option value="active" {{ old('status', $accommodation->status) == 'active' ? 'selected' : '' }}>
                            فعال</option>
                        <option value="inactive"
                            {{ old('status', $accommodation->status) == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                        <option value="pending"
                            {{ old('status', $accommodation->status) == 'pending' ? 'selected' : '' }}>در انتظار تایید
                        </option>
                        <option value="blocked"
                            {{ old('status', $accommodation->status) == 'blocked' ? 'selected' : '' }}>مسدود</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- نکات مهم -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-exclamation-triangle text-indigo-600"></i>
                        نکات مهم
                    </h3>
                </div>
                <div class="p-6">
                    <textarea name="important_notes" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">{{ old('important_notes', $accommodation->important_notes) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">مثل قوانین ورود، محدودیت‌ها، موارد خاص و...</p>
                    @error('important_notes')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- در editAccommodation.blade.php، بعد از بخش امکانات -->

            <!-- اتاق‌های اقامتگاه -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-bed text-indigo-600"></i>
                        اتاق‌های اقامتگاه
                    </h3>
                </div>
                <div class="p-6">
                    <div id="rooms-container">
                        @foreach ($accommodation->rooms as $index => $room)
                            <div class="room-item grid grid-cols-1 md:grid-cols-6 gap-3 mb-4 p-4 border rounded-lg">
                                <input type="hidden" name="rooms[{{ $index }}][id]"
                                    value="{{ $room->id }}">
                                <input type="text" name="rooms[{{ $index }}][title]"
                                    value="{{ $room->title }}" placeholder="عنوان اتاق" class="border rounded-lg p-2"
                                    required>
                                <input type="text" name="rooms[{{ $index }}][capacity]"
                                    value="{{ $room->capacity }}" placeholder="ظرفیت (نفر)"
                                    class="border rounded-lg p-2" required>
                                <input type="text" name="rooms[{{ $index }}][beds]"
                                    value="{{ $room->beds }}" placeholder="تخت‌ها" class="border rounded-lg p-2"
                                    required>
                                <input type="number" name="rooms[{{ $index }}][price]"
                                    value="{{ $room->price }}" placeholder="قیمت (تومان)" class="border rounded-lg p-2"
                                    required>
                                <div class="flex items-center gap-2">
                                    @if ($room->image)
                                        <img src="{{ asset('storage/uplouds/rooms/' . $room->image) }}"
                                            class="w-12 h-12 object-cover rounded">
                                    @endif
                                    <input type="file" name="rooms[{{ $index }}][image]" accept="image/*"
                                        class="border rounded-lg p-1">
                                </div>
                                <button type="button" onclick="this.closest('.room-item').remove()"
                                    class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRoom()"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-plus ml-2"></i> افزودن اتاق جدید
                    </button>
                </div>
            </div>

            <script>
                let roomCount = {{ $accommodation->rooms->count() }};
                <input type="hidden" name="rooms[{{ $index }}][id]" value="{{ $room->id }}">
                function addRoom() {
                    const html = `
        <div class="room-item grid grid-cols-1 md:grid-cols-6 gap-3 mb-4 p-4 border rounded-lg">
            <input type="text" name="rooms[${roomCount}][title]" placeholder="عنوان اتاق" class="border rounded-lg p-2">
            <input type="text" name="rooms[${roomCount}][capacity]" placeholder="ظرفیت (نفر)" class="border rounded-lg p-2">
            <input type="text" name="rooms[${roomCount}][beds]" placeholder="تخت‌ها" class="border rounded-lg p-2">
            <input type="number" name="rooms[${roomCount}][price]" placeholder="قیمت (تومان)" class="border rounded-lg p-2">
            <input type="file" name="rooms[${roomCount}][image]" accept="image/*" class="border rounded-lg p-1">
            <button type="button" onclick="this.closest('.room-item').remove()" class="bg-red-500 text-white px-3 py-2 rounded-lg">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
                    document.getElementById('rooms-container').insertAdjacentHTML('beforeend', html);
                    roomCount++;
                }
            </script>

            <!-- دکمه‌های ارسال -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.accommodation') }}"
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                    انصراف
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    ذخیره تغییرات
                </button>
            </div>
        </form>
    </div>

    <script>
        function removeImage(imagePath, element) {
            if (confirm('آیا از حذف این تصویر مطمئن هستید؟')) {
                // حذف از نمایش
                element.closest('.relative').remove();

                // به‌روزرسانی input مخفی
                let existingImages = document.getElementById('existingImages');
                let images = JSON.parse(existingImages.value || '[]');
                images = images.filter(img => img !== imagePath);
                existingImages.value = JSON.stringify(images);
            }
        }
    </script>
@endsection
