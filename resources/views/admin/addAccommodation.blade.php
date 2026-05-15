@extends('admin.Layout.master')
@section('Content')
    <div class="p-4 md:p-6">

        <!-- عنوان صفحه -->
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">افزودن اقامتگاه جدید</h1>
            <p class="text-gray-500 mt-1">اطلاعات کامل اقامتگاه را وارد کنید</p>
        </div>

        <!-- فرم اضافه کردن اقامتگاه -->
        <form action="{{ route('admin.accommodation.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- اطلاعات پایه اقامتگاه -->
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-info-circle text-indigo-600"></i>
                        اطلاعات پایه
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">عنوان اقامتگاه <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        @error('title')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">شهر <span
                                class="text-red-500">*</span></label>
                        <select name="city_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                            <option value="">انتخاب شهر</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">آدرس <span
                                class="text-red-500">*</span></label>
                        <textarea name="address" rows="3" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">تصاویر اقامتگاه</label>
                        <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/jpg"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 @error('images.*') @enderror">
                        <p class="text-xs text-gray-500 mt-1">حداکثر حجم هر تصویر ۵ مگابایت | فرمت‌های مجاز: jpeg, png, jpg
                        </p>
                        @error('images.*')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">ریتینگ اقامتگاه</label>
                        <input type="text" name="rating" class="w-full border border-gray-300 rounded-lg px-4 py-2">

                        </p>
                        @error('rating')
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
                        <input type="time" name="check_in_time" value="{{ old('check_in_time', '14:00') }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('check_in_time')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">زمان خروج (Check-out) <span
                                class="text-red-500">*</span></label>
                        <input type="time" name="check_out_time" value="{{ old('check_out_time', '12:00') }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('check_out_time')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
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
                        <input type="number" name="floors" value="{{ old('floors') }}" min="1" max="50"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('floors')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تعداد اتاق‌ها</label>
                        <input type="number" name="rooms_count" value="{{ old('rooms_count') }}" min="1"
                            max="500"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        @error('rooms_count')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
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
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- امکانات عمومی (General Facilities) -->
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
                            $generalFacilities = [
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
                        @endphp
                        @foreach ($generalFacilities as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="general_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, old('general_facilities', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('general_facilities')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- امکانات اتاق (Room Facilities) -->
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
                            $roomFacilities = [
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
                        @endphp
                        @foreach ($roomFacilities as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="room_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, old('room_facilities', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('room_facilities')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- امکانات اختصاصی (Private Facilities) -->
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
                            $privateFacilities = [
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
                        @endphp
                        @foreach ($privateFacilities as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="private_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, old('private_facilities', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('private_facilities')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- امکانات تفریحی و سرگرمی (Entertainment Facilities) -->
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
                            $entertainmentFacilities = [
                                'اتاق بازی',
                                'سینما',
                                'بیلیارد',
                                'تنیس روی میز',
                                'بازی‌های ویدیویی',
                                'کتابخانه',
                                'اجاره دوچرخه',
                                'تورهای گردشگری',
                            ];
                        @endphp
                        @foreach ($entertainmentFacilities as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="entertainment_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, old('entertainment_facilities', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('entertainment_facilities')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- امکانات تفریحی اوقات فراغت (Leisure Facilities) -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-hiking text-indigo-600"></i>
                        امکانات تفریحی و اوقات فراغت
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @php
                            $leisureFacilities = [
                                'کوهنوردی',
                                'اسکی',
                                'ماهیگیری',
                                'اسب‌سواری',
                                'ورزش‌های آبی',
                                'یوگا',
                                'ماساژ',
                                'منطقه پیک نیک',
                            ];
                        @endphp
                        @foreach ($leisureFacilities as $facility)
                            <label
                                class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                <input type="checkbox" name="leisure_facilities[]" value="{{ $facility }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ in_array($facility, old('leisure_facilities', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('leisure_facilities')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">نکات مهم (اختیاری)</label>
                    <textarea name="important_notes" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">{{ old('important_notes') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">مثل قوانین ورود، محدودیت‌ها، موارد خاص و...</p>
                    @error('important_notes')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- در فرم addAccommodation -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <i class="fas fa-bed text-indigo-600"></i>
                        اتاق‌های اقامتگاه
                    </h3>
                </div>
                <div class="p-6">
                    <div id="rooms-container">
                        <div class="room-item grid grid-cols-1 md:grid-cols-5 gap-4 mb-4 p-4 border rounded-lg">
                            <input type="text" name="rooms[0][title]" placeholder="عنوان اتاق"
                                class="border rounded p-2">
                            <input type="text" name="rooms[0][capacity]" placeholder="ظرفیت (نفر)"
                                class="border rounded p-2">
                            <input type="text" name="rooms[0][beds]" placeholder="تخت‌ها" class="border rounded p-2">
                            <input type="number" name="rooms[0][price]" placeholder="قیمت" class="border rounded p-2">
                            <input type="file" name="rooms[0][image]" class="border rounded p-2">
                        </div>
                    </div>
                    <button type="button" onclick="addRoom()" class="bg-gray-200 px-4 py-2 rounded">+ افزودن اتاق
                        جدید</button>
                </div>
            </div>

            <script>
                let roomCount = 1;

                function addRoom() {
                    const html = `
            <div class="room-item grid grid-cols-1 md:grid-cols-5 gap-4 mb-4 p-4 border rounded-lg">
                <input type="text" name="rooms[${roomCount}][title]" placeholder="عنوان اتاق" class="border rounded p-2">
                <input type="text" name="rooms[${roomCount}][capacity]" placeholder="ظرفیت (نفر)" class="border rounded p-2">
                <input type="text" name="rooms[${roomCount}][beds]" placeholder="تخت‌ها" class="border rounded p-2">
                <input type="number" name="rooms[${roomCount}][price]" placeholder="قیمت" class="border rounded p-2">
                <input type="file" name="rooms[${roomCount}][image]" class="border rounded p-2">
                <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 text-white px-2 py-1 rounded">حذف</button>
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
                <button type="submit" name="submit"
                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    ذخیره اقامتگاه
                </button>
            </div>

        </form>
    </div>
@endsection
