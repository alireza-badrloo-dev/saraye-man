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

        <!-- عنوان صفحه -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">جزئیات اقامتگاه</h1>
                <p class="text-gray-500 mt-1">مشاهده اطلاعات کامل اقامتگاه</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.accommodation.edit', $accommodation->id) }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                    <i class="fas fa-edit"></i>
                    <span>ویرایش اقامتگاه</span>
                </a>
                <form action="{{ route('admin.accommodation.destroy', $accommodation->id) }}" method="POST" class="inline"
                    onsubmit="return confirm('آیا از حذف این اقامتگاه مطمئن هستید؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                        <i class="fas fa-trash"></i>
                        <span>حذف اقامتگاه</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- ستون راست: تصاویر اقامتگاه -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-5 border-b bg-gray-50">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                            <i class="fas fa-image text-indigo-600"></i>
                            گالری تصاویر
                        </h3>
                    </div>
                    <div class="p-5">
                        @php
                            $images = is_string($accommodation->images)
                                ? json_decode($accommodation->images, true)
                                : $accommodation->images ?? [];
                        @endphp

                        @if (!empty($images))
                            <!-- Swiper Container -->
                            <div class="swiper gallery-swiper overflow-hidden relative  mb-4">
                                <div class="swiper-wrapper">
                                    @foreach ($images as $image)
                                        @php
                                            $cleanImage = str_replace(['uplouds/', 'uploads/'], '', $image);
                                        @endphp
                                        @if ($cleanImage && file_exists(storage_path('app/public/uplouds/' . $cleanImage)))
                                            <div class="swiper-slide z-0">
                                                <img src="{{ asset('storage/uplouds/' . $cleanImage) }}"
                                                    class="w-full h-96 object-cover rounded-lg cursor-pointer"
                                                    alt="{{ $accommodation->title }}"
                                                    onclick="showImage('{{ asset('storage/uplouds/' . $cleanImage) }}')">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            </div>

                            <!-- تعداد عکس‌ها -->
                            <div class="text-center text-sm text-gray-500 mt-2">
                                <i class="fas fa-images ml-1"></i>
                                {{ count($images) }} تصویر
                            </div>
                        @else
                            <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-image text-gray-400 text-6xl mb-2 block"></i>
                                    <p class="text-gray-500">تصویری برای این اقامتگاه وجود ندارد</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- توضیحات کامل -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
                    <div class="p-5 border-b bg-gray-50">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                            <i class="fas fa-align-left text-indigo-600"></i>
                            توضیحات کامل
                        </h3>
                    </div>
                    <div class="p-5">
                        <p class="text-gray-700 leading-relaxed">{{ $accommodation->description }}</p>
                    </div>
                </div>

                <!-- نکات مهم -->
                @if ($accommodation->important_notes)
                    <div class="bg-yellow-50 rounded-xl shadow-md overflow-hidden mt-6 border border-yellow-200">
                        <div class="p-5 border-b border-yellow-200">
                            <h3 class="font-bold text-yellow-800 text-lg flex items-center gap-2">
                                <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                                نکات مهم
                            </h3>
                        </div>
                        <div class="p-5">
                            <p class="text-yellow-700">{{ $accommodation->important_notes }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- ستون چپ: اطلاعات اقامتگاه -->
            <div class="space-y-6">
                <!-- اطلاعات پایه -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-5 border-b bg-gray-50">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                            <i class="fas fa-info-circle text-indigo-600"></i>
                            اطلاعات پایه
                        </h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">عنوان اقامتگاه</p>
                            <p class="text-lg font-bold text-gray-800">{{ $accommodation->title }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">شهر</p>
                            <p class="text-gray-800">{{ $accommodation->city->name ?? 'نامشخص' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">آدرس</p>
                            <p class="text-gray-800">{{ $accommodation->address }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">ساعت ورود</p>
                                <p class="text-gray-800 font-medium">{{ $accommodation->check_in_time }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">ساعت خروج</p>
                                <p class="text-gray-800 font-medium">{{ $accommodation->check_out_time }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- مشخصات فیزیکی -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-5 border-b bg-gray-50">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                            <i class="fas fa-building text-indigo-600"></i>
                            مشخصات فیزیکی
                        </h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-layer-group text-indigo-600 text-xl mb-2 block"></i>
                                <p class="text-xs text-gray-500">تعداد طبقات</p>
                                <p class="text-xl font-bold text-gray-800">{{ $accommodation->floors ?? '-' }}</p>
                            </div>
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-bed text-indigo-600 text-xl mb-2 block"></i>
                                <p class="text-xs text-gray-500">تعداد اتاق‌ها</p>
                                <p class="text-xl font-bold text-gray-800">{{ $accommodation->rooms_count ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- امتیاز و وضعیت -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-5 border-b bg-gray-50">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                            <i class="fas fa-chart-line text-indigo-600"></i>
                            امتیاز و وضعیت
                        </h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">امتیاز:</span>
                            <div class="flex items-center gap-1">
                                @php
                                    $rating = $accommodation->rating ?? 0;
                                    $fullStars = floor($rating);
                                    $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                                    $emptyStars = 5 - $fullStars - $halfStar;
                                @endphp
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fas fa-star text-yellow-400"></i>
                                @endfor
                                @if ($halfStar)
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="far fa-star text-yellow-400"></i>
                                @endfor
                                <span class="mr-2 font-bold">{{ number_format($rating, 1) }}</span>
                                @if ($accommodation->rating_count > 0)
                                    <span class="text-xs text-gray-500">({{ $accommodation->rating_count }} نظر)</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">وضعیت:</span>
                            @php
                                $statusColors = [
                                    'active' => 'bg-green-100 text-green-700',
                                    'inactive' => 'bg-gray-100 text-gray-700',
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'blocked' => 'bg-red-100 text-red-700',
                                ];
                                $statusTexts = [
                                    'active' => 'فعال',
                                    'inactive' => 'غیرفعال',
                                    'pending' => 'در انتظار تایید',
                                    'blocked' => 'مسدود',
                                ];
                                $color = $statusColors[$accommodation->status] ?? 'bg-gray-100 text-gray-700';
                                $text = $statusTexts[$accommodation->status] ?? 'نامشخص';
                            @endphp
                            <span class="px-2 py-1 text-xs rounded-full {{ $color }}">{{ $text }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- امکانات اقامتگاه -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <!-- امکانات عمومی -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-wifi text-indigo-600"></i>
                        امکانات عمومی
                    </h3>
                </div>
                <div class="p-4">
                    @php
                        $generalFacilities = is_string($accommodation->general_facilities)
                            ? json_decode($accommodation->general_facilities, true)
                            : $accommodation->general_facilities ?? [];
                    @endphp
                    @if (!empty($generalFacilities))
                        <div class="flex flex-wrap gap-2">
                            @foreach ($generalFacilities as $facility)
                                <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded-full">
                                    <i class="fas fa-check-circle ml-1 text-xs"></i>
                                    {{ $facility }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">امکاناتی ثبت نشده است</p>
                    @endif
                </div>
            </div>

            <!-- امکانات اتاق -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-bed text-indigo-600"></i>
                        امکانات اتاق
                    </h3>
                </div>
                <div class="p-4">
                    @php
                        $roomFacilities = is_string($accommodation->room_facilities)
                            ? json_decode($accommodation->room_facilities, true)
                            : $accommodation->room_facilities ?? [];
                    @endphp
                    @if (!empty($roomFacilities))
                        <div class="flex flex-wrap gap-2">
                            @foreach ($roomFacilities as $facility)
                                <span class="px-2 py-1 bg-green-50 text-green-700 text-xs rounded-full">
                                    <i class="fas fa-check-circle ml-1 text-xs"></i>
                                    {{ $facility }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">امکاناتی ثبت نشده است</p>
                    @endif
                </div>
            </div>

            <!-- امکانات اختصاصی -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-swimming-pool text-indigo-600"></i>
                        امکانات اختصاصی
                    </h3>
                </div>
                <div class="p-4">
                    @php
                        $privateFacilities = is_string($accommodation->private_facilities)
                            ? json_decode($accommodation->private_facilities, true)
                            : $accommodation->private_facilities ?? [];
                    @endphp
                    @if (!empty($privateFacilities))
                        <div class="flex flex-wrap gap-2">
                            @foreach ($privateFacilities as $facility)
                                <span class="px-2 py-1 bg-purple-50 text-purple-700 text-xs rounded-full">
                                    <i class="fas fa-check-circle ml-1 text-xs"></i>
                                    {{ $facility }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">امکاناتی ثبت نشده است</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- امکانات تفریحی -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-gamepad text-indigo-600"></i>
                        امکانات تفریحی و سرگرمی
                    </h3>
                </div>
                <div class="p-4">
                    @php
                        $entertainmentFacilities = is_string($accommodation->entertainment_facilities)
                            ? json_decode($accommodation->entertainment_facilities, true)
                            : $accommodation->entertainment_facilities ?? [];
                    @endphp
                    @if (!empty($entertainmentFacilities))
                        <div class="flex flex-wrap gap-2">
                            @foreach ($entertainmentFacilities as $facility)
                                <span class="px-2 py-1 bg-orange-50 text-orange-700 text-xs rounded-full">
                                    <i class="fas fa-check-circle ml-1 text-xs"></i>
                                    {{ $facility }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">امکاناتی ثبت نشده است</p>
                    @endif
                </div>
            </div>

            <!-- امکانات اوقات فراغت -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-hiking text-indigo-600"></i>
                        امکانات اوقات فراغت
                    </h3>
                </div>
                <div class="p-4">
                    @php
                        $leisureFacilities = is_string($accommodation->leisure_facilities)
                            ? json_decode($accommodation->leisure_facilities, true)
                            : $accommodation->leisure_facilities ?? [];
                    @endphp
                    @if (!empty($leisureFacilities))
                        <div class="flex flex-wrap gap-2">
                            @foreach ($leisureFacilities as $facility)
                                <span class="px-2 py-1 bg-teal-50 text-teal-700 text-xs rounded-full">
                                    <i class="fas fa-check-circle ml-1 text-xs"></i>
                                    {{ $facility }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">امکاناتی ثبت نشده است</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- اطلاعات ثبت -->
        <div class="bg-gray-50 rounded-xl p-4 mt-6 text-center text-sm text-gray-500">
            <p>تاریخ ایجاد: {{ $accommodation->created_at ? jdate($accommodation->created_at)->format('Y/m/d') : '-' }}</p>
            <p class="mt-1">آخرین بروزرسانی:
                {{ $accommodation->updated_at ? jdate($accommodation->updated_at)->format('Y/m/d') : '-' }}</p>
        </div>
    </div>

    <!-- در showAccommodation.blade.php -->
    <div class="mt-8">
        <h3 class="text-lg font-bold mb-4">اتاق‌های اقامتگاه</h3>

        @foreach ($accommodation->rooms as $room)
            <div class="border rounded-lg p-4 mb-4 flex justify-between items-center">
                <div class="flex gap-4">
                    @if ($room->image)
                        <img src="{{ asset('storage/uplouds/rooms/' . $room->image) }}"
                            class="w-24 h-24 object-cover rounded">
                    @endif
                    <div>
                        <h4 class="font-bold">{{ $room->title }}</h4>
                        <p>ظرفیت: {{ $room->capacity }} نفر</p>
                        <p>تخت‌ها: {{ $room->beds }}</p>
                    </div>
                </div>
                <div class="text-left">
                    <p class="text-lg font-bold text-orange-500">{{ number_format($room->price) }} تومان</p>
                    <p class="text-sm text-gray-500">برای هر شب</p>
                </div>
            </div>
        @endforeach
    </div>



    <script>
        // بستن با دکمه ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImage();
            }
        });
    </script>
@endsection
