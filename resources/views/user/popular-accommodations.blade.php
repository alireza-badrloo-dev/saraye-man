@extends('user.Layouts.master')
@section('Mycontent')
    <div>
        <picture class="city-banner">
            <img class="w-full object-cover" src="/image/home.jpg" alt="home" />
        </picture>
        <div class="mx-1 md:mx-20 xl:mx-40 relative -mt-20">
            <h1 class="text-2xl text-gray-800 mb-4">🔥 محبوب‌ترین اقامتگاه‌ها</h1>

            <!-- فرم جستجو -->
            <x-search-form />

            <div class="grid grid-cols-12 gap-6 mb-12">
                <!-- فیلترهای سمت راست -->
                <div class="col-span-full order-2 lg:-order-1 lg:col-span-3">
                    <div class="border p-3 rounded-b-none rounded-md border-gray-300">
                        <h1 class="text-md text-gray-600">فیلترهای اقامتگاه</h1>
                    </div>

                    <div class="border p-3 rounded-md rounded-t-none border-gray-300 border-t-0">
                        <!-- جستجوی نام اقامتگاه -->
                        <p class="text-gray-600 text-sm mb-3">نام اقامتگاه</p>
                        <div class="relative flex items-center">
                            <input type="text" name="filter_name" id="filter_name" value="{{ request('filter_name') }}"
                                class="border border-gray-300 bg-gray-50 text-xs p-2 w-full rounded-md hover:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-500"
                                placeholder="جستجو">
                            <i class="fas fa-search absolute left-2 text-gray-400 text-xs"></i>
                        </div>
                        <hr class="text-gray-300 my-3">

                        <!-- محدوده قیمت -->
                        <p class="text-gray-600 text-sm mb-3">محدوده قیمت (تومان)</p>
                        <div class="flex justify-between gap-3">
                            <div class="w-full">
                                <label class="text-xs text-gray-500 block mb-1">حداقل قیمت</label>
                                <input type="number" id="min-price" name="min_price" value="{{ request('min_price', 0) }}"
                                    class="border border-gray-300 rounded-md p-2 w-full text-sm focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div class="w-full">
                                <label class="text-xs text-gray-500 block mb-1">حداکثر قیمت</label>
                                <input type="number" id="max-price" name="max_price"
                                    value="{{ request('max_price', $maxPriceInDb ?? 10000000) }}"
                                    class="border border-gray-300 rounded-md p-2 w-full text-sm focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                        <hr class="text-gray-300 my-3">

                        <!-- امکانات عمومی -->
                        <p class="text-gray-600 text-sm mb-3">امکانات عمومی</p>
                        <div class="flex flex-col space-y-3 items-start w-full max-h-40 overflow-y-auto">
                            <div class="flex">
                                <input type="checkbox" name="facilities[]" value="wifi" id="facility_wifi"
                                    class="me-2 facility-checkbox"
                                    {{ in_array('wifi', explode(',', request('facilities', ''))) ? 'checked' : '' }}>
                                <label for="facility_wifi" class="text-xs text-gray-500 font-medium">وای فای رایگان</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" name="facilities[]" value="parking" id="facility_parking"
                                    class="me-2 facility-checkbox"
                                    {{ in_array('parking', explode(',', request('facilities', ''))) ? 'checked' : '' }}>
                                <label for="facility_parking" class="text-xs text-gray-500 font-medium">پارکینگ</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" name="facilities[]" value="restaurant" id="facility_restaurant"
                                    class="me-2 facility-checkbox"
                                    {{ in_array('restaurant', explode(',', request('facilities', ''))) ? 'checked' : '' }}>
                                <label for="facility_restaurant" class="text-xs text-gray-500 font-medium">رستوران</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" name="facilities[]" value="pool" id="facility_pool"
                                    class="me-2 facility-checkbox"
                                    {{ in_array('pool', explode(',', request('facilities', ''))) ? 'checked' : '' }}>
                                <label for="facility_pool" class="text-xs text-gray-500 font-medium">استخر</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" name="facilities[]" value="gym" id="facility_gym"
                                    class="me-2 facility-checkbox"
                                    {{ in_array('gym', explode(',', request('facilities', ''))) ? 'checked' : '' }}>
                                <label for="facility_gym" class="text-xs text-gray-500 font-medium">باشگاه ورزشی</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" name="facilities[]" value="spa" id="facility_spa"
                                    class="me-2 facility-checkbox"
                                    {{ in_array('spa', explode(',', request('facilities', ''))) ? 'checked' : '' }}>
                                <label for="facility_spa" class="text-xs text-gray-500 font-medium">اسپا و سونا</label>
                            </div>
                        </div>
                        <hr class="text-gray-300 my-3">

                        <!-- امتیاز اقامتگاه -->
                        <p class="text-gray-600 text-sm mb-3">امتیاز اقامتگاه</p>
                        <div class="space-y-2">
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex items-center">
                                    <input type="radio" name="rating" value="4.5" class="ml-2"
                                        {{ request('rating') == '4.5' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-0.5">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <span class="text-sm text-gray-700 mr-1">عالی</span>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">4.5 به بالا</span>
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex items-center">
                                    <input type="radio" name="rating" value="4" class="ml-2"
                                        {{ request('rating') == '4' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-0.5">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="far fa-star text-gray-300 text-xs"></i>
                                        <span class="text-sm text-gray-700 mr-1">خیلی خوب</span>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">4 تا 4.5</span>
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex items-center">
                                    <input type="radio" name="rating" value="3.5" class="ml-2"
                                        {{ request('rating') == '3.5' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-0.5">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="far fa-star text-gray-300 text-xs"></i>
                                        <i class="far fa-star text-gray-300 text-xs"></i>
                                        <span class="text-sm text-gray-700 mr-1">خوب</span>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">3.5 تا 4</span>
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex items-center">
                                    <input type="radio" name="rating" value="3" class="ml-2"
                                        {{ request('rating') == '3' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-0.5">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="far fa-star text-gray-300 text-xs"></i>
                                        <i class="far fa-star text-gray-300 text-xs"></i>
                                        <span class="text-sm text-gray-700 mr-1">متوسط</span>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">3 تا 3.5</span>
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex items-center">
                                    <input type="radio" name="rating" value="0" class="ml-2"
                                        {{ request('rating') == '0' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-0.5">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <i class="far fa-star text-gray-300 text-xs"></i>
                                        <i class="far fa-star text-gray-300 text-xs"></i>
                                        <i class="far fa-star text-gray-300 text-xs"></i>
                                        <span class="text-sm text-gray-700 mr-1">ضعیف</span>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">کمتر از 3</span>
                            </label>
                        </div>

                        <button id="applyFilters"
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-md mt-4 transition">
                            اعمال فیلترها
                        </button>
                    </div>
                </div>

                <!-- لیست اقامتگاه‌ها -->
                <div class="col-span-full lg:col-span-9">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
                        <h1 class="text-xl font-bold text-gray-800"> محبوب‌ترین اقامتگاه‌ها</h1>
                        <p class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                            <i class="fas fa-building ml-1"></i> {{ $accommodations->total() }} اقامتگاه
                        </p>
                    </div>

                    <!-- مرتب‌سازی -->
                    <div class="flex flex-wrap items-center gap-2 mb-6">
                        <span class="text-sm text-gray-600 ml-2">مرتب سازی:</span>
                        <a href="{{ route('popularAccommodations', array_merge(request()->all(), ['sort' => 'rating'])) }}"
                            class="sort-link text-sm px-3 py-1.5 rounded-md transition {{ !request('sort') || request('sort') == 'rating' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            محبوب‌ترین
                        </a>
                        <a href="{{ route('popularAccommodations', array_merge(request()->all(), ['sort' => 'price_asc'])) }}"
                            class="sort-link text-sm px-3 py-1.5 rounded-md transition {{ request('sort') == 'price_asc' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            کمترین قیمت
                        </a>
                        <a href="{{ route('popularAccommodations', array_merge(request()->all(), ['sort' => 'price_desc'])) }}"
                            class="sort-link text-sm px-3 py-1.5 rounded-md transition {{ request('sort') == 'price_desc' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            بیشترین قیمت
                        </a>
                        <a href="{{ route('popularAccommodations', array_merge(request()->all(), ['sort' => 'newest'])) }}"
                            class="sort-link text-sm px-3 py-1.5 rounded-md transition {{ request('sort') == 'newest' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            جدیدترین
                        </a>
                    </div>

                    <!-- کارت‌های اقامتگاه -->
                    @if ($accommodations->count() > 0)
                        <div class="grid grid-cols-1 p-4 sm:p-0 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach ($accommodations as $item)
                                <div class="bg-white rounded-xl overflow-hidden transition group">
                                    @php
                                        $images = is_string($item->images)
                                            ? json_decode($item->images, true)
                                            : $item->images ?? [];
                                        $firstImage = $images[0] ?? null;
                                        $rating = $item->rating ?? 0;
                                        $full = floor($rating);
                                        $half = $rating - $full >= 0.5 ? 1 : 0;
                                        $empty = 5 - $full - $half;
                                        $minPrice = $item->rooms->min('price') ?? 0;
                                    @endphp
                                    <a href="{{ route('details', $item->id) }}">

                                        <div class="relative">
                                            @if ($firstImage)
                                                <img class="w-full rounded-t-md object-cover group-hover:scale-105 transition duration-300 h-48"
                                                    src="{{ asset('storage/uplouds/' . $firstImage) }}"
                                                    alt="{{ $item->title }}">
                                            @else
                                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-md">
                                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                                </div>
                                            @endif

                                           
                                        </div>

                                        <div class="my-2 space-y-1 p-2">
                                            <h2 class="text-md text-gray-800">{{ $item->title }}</h2>

                                            <div
                                                class="text-xs text-justify text-gray-600 w-48 2xl:64 whitespace-nowrap overflow-hidden overflow-ellipsis">
                                                {{ $item->address }}
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <p class="text-gray-400 text-xs">
                                                    از <span class="text-gray-600 text-sm">{{ number_format($minPrice) }}
                                                        تومان</span>/ 1شب
                                                </p>

                                                <div class="flex items-center text-gray-400" dir="ltr">
                                                    @for ($i = 0; $i < $full; $i++)
                                                        <span class="text-yellow-400">★</span>
                                                    @endfor

                                                    @if ($half)
                                                        <span class="text-yellow-400">☆</span>
                                                    @endif

                                                    @for ($i = 0; $i < $empty; $i++)
                                                        <span>★</span>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- صفحه‌بندی -->
                        @if ($accommodations->hasPages())
                            <div class="mt-8">
                                {{ $accommodations->links("vendor.pagination.user-orange") }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-16 bg-white rounded-xl">
                            <i class="fas fa-fire text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500 text-lg">هیچ اقامتگاه محبوبی یافت نشد.</p>
                            <a href="{{ route('home') }}"
                                class="inline-block mt-4 bg-orange-500 text-white px-6 py-2 rounded-lg transition">
                                بازگشت به صفحه اصلی
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const applyBtn = document.getElementById('applyFilters');
            if (applyBtn) {
                applyBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    let url = new URL(window.location.href);

                    // دریافت مقادیر قیمت
                    const minPrice = document.getElementById('min-price')?.value;
                    const maxPrice = document.getElementById('max-price')?.value;

                    if (minPrice !== undefined && minPrice !== '') {
                        url.searchParams.set('min_price', minPrice);
                    } else {
                        url.searchParams.delete('min_price');
                    }
                    if (maxPrice !== undefined && maxPrice !== '') {
                        url.searchParams.set('max_price', maxPrice);
                    } else {
                        url.searchParams.delete('max_price');
                    }

                    // نام اقامتگاه
                    const filterName = document.getElementById('filter_name')?.value;
                    if (filterName && filterName.trim() !== '') {
                        url.searchParams.set('filter_name', filterName.trim());
                    } else {
                        url.searchParams.delete('filter_name');
                    }

                    // امکانات
                    const facilities = [];
                    document.querySelectorAll('input[name="facilities[]"]:checked').forEach(cb => {
                        facilities.push(cb.value);
                    });
                    if (facilities.length > 0) {
                        url.searchParams.set('facilities', facilities.join(','));
                    } else {
                        url.searchParams.delete('facilities');
                    }

                    // امتیاز
                    const rating = document.querySelector('input[name="rating"]:checked')?.value;
                    if (rating) {
                        url.searchParams.set('rating', rating);
                    } else {
                        url.searchParams.delete('rating');
                    }

                    // جستجوی اصلی
                    const searchQuery = document.querySelector('input[name="search"]')?.value;
                    if (searchQuery && searchQuery.trim() !== '') {
                        url.searchParams.set('search', searchQuery.trim());
                    }

                    // تاریخ
                    const fromDate = document.querySelector('input[name="from_date"]')?.value;
                    const toDate = document.querySelector('input[name="to_date"]')?.value;
                    if (fromDate) url.searchParams.set('from_date', fromDate);
                    if (toDate) url.searchParams.set('to_date', toDate);

                    window.location.href = url.toString();
                });
            }

            // Enter در فیلتر نام
            document.getElementById('filter_name')?.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    applyBtn.click();
                }
            });

            // مقداردهی اولیه ورودی‌های قیمت از URL
            const urlParams = new URLSearchParams(window.location.search);
            const urlMinPrice = urlParams.get('min_price');
            const urlMaxPrice = urlParams.get('max_price');

            if (urlMinPrice && document.getElementById('min-price')) {
                document.getElementById('min-price').value = urlMinPrice;
            }
            if (urlMaxPrice && document.getElementById('max-price')) {
                document.getElementById('max-price').value = urlMaxPrice;
            }
        });
    </script>
@endsection