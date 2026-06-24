@extends('user.Layouts.master')
@section('Mycontent')
    <div>

        <div class="class= mx-1  md:mx-20 xl:mx-40">
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
        </div>
        <picture class="city-banner">
            <img class="w-full object-cover" src="/image/home.jpg" alt="home" />
        </picture>

        <div class=" mx-1  md:mx-20 xl:mx-40 relative -mt-28">
            <div class="mb-12">
                <h1 class="text-2xl  text-gray-800 mb-4">رزرو اقامتگاه و اقامتگاه های کشور</h1>
                <p>اولین ارائه دهنده اولین ارائه دهنده رسمی خدمات تخصصی رزرواسیون اقامتگاه و اقامتگاه های کشور</p>
            </div>
            <x-search-form />


            <h1 class="text-xl  text-gray-800 mb-4">مقاصد محبوب</h1>
            <div class="swiper-container  mb-8">
                <div class="swiper-wrapper ">
                    @foreach ($city as $item)
                        <div class="swiper-slide " id="first">
                            <a href="{{ route('city', ['id' => $item->id]) }}">
                                <img src="{{ asset('image/' . $item->image) }}" class="object-cover " alt="اسلاید ۱">
                                <div class="slide-caption">
                                    <h2 class="text-md  text-gray-800">اقامتگاه های {{ $item->name }}</h2>

                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- دکمه‌های ناوبری (اختیاری) -->
                {{-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> --}}
                <!-- نقاط ناوبری (اختیاری) -->

                {{-- <div class="swiper-pagination"></div> --}}


            </div>

            <div class="flex justify-between w-full items-center mb-4">
                <h1 class="text-xl  text-gray-800 ">آخرین اقامتگاه ها</h1>
                <div class="flex items-center space-x-1">
                    <a href="{{ route('lastAccommodations') }}" class="text-orange-500">موارد بیشتر <i class="fas fa-arrow-left "></i></a>
                    
                </div>
            </div>
            <div class="swiper-second swiper-carousel mb-12">
                <div class="swiper-wrapper ">

                    @foreach ($data as $item)
                        @php
                            $images = $item->images ?? []; // آرایه واقعی
                            $firstImage = $images[0] ?? null; // عکس اول
                        @endphp

                        <div class="swiper-slide">
                            <div class="bg-white rounded-xl  overflow-hidden  transition group">
                                <a href="{{ route('details', ['id' => $item->id]) }}" class="space-y-3">




                                    @if ($firstImage)
                                        <img class="w-full rounded-t-md object-cover group-hover:scale-105 transition duration-300"
                                            src="{{ asset('storage/uplouds/' . $firstImage) }}" alt="{{ $item->title }}">
                                    @endif



                                    <div class="my-2 space-y-1">
                                        <h2 class="text-md text-gray-800">{{ $item->title }}</h2>

                                        <div
                                            class="text-xs text-justify text-gray-600 w-48 2xl:64 whitespace-nowrap overflow-hidden overflow-ellipsis">
                                            {{ $item->address }}
                                        </div>

                                        <div class="flex items-center justify-between">


                                            <p class="text-gray-400 text-xs">
                                                از <span class="text-gray-600 text-sm">{{ number_format($item->rooms_min_price) }}
                                                    تومان</span>/ 1شب
                                            </p>


                                            <div class="flex items-center text-gray-400">
                                                @php
                                                    $rating = $item->rating;
                                                    $full = floor($rating);
                                                    $half = $rating - $full >= 0.5 ? 1 : 0;
                                                    $empty = 5 - $full - $half;
                                                @endphp

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
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach




                </div>
                <!-- دکمه‌های ناوبری (اختیاری) -->
                {{-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> --}}
                <!-- نقاط ناوبری (اختیاری) -->
                {{-- <div class="swiper-pagination "></div> --}}
            </div>

            <!-- بخش جدید: اقامتگاه‌های محبوب -->
            <div class="flex justify-between w-full items-center mb-4">
                <h1 class="text-xl text-gray-800"> محبوب‌ترین اقامتگاه‌ها</h1>
                <div class="flex items-center space-x-1">
                    <a href="{{ route('popularAccommodations') }}" class="text-orange-500">موارد بیشتر <i class="fas fa-arrow-left "></i></a>
                    
                </div>
            </div>
            <div class="swiper-third swiper-carousel mb-12">
                <div class="swiper-wrapper">
                    @foreach ($popularAccommodations as $item)
                        @php
                            $images = $item->images ?? [];
                            $firstImage = $images[0] ?? null;
                        @endphp
                        <div class="swiper-slide ">
                            <div class="bg-white rounded-xl overflow-hidden  transition group">
                                <a href="{{ route('details', ['id' => $item->id]) }}" class="space-y-3">
                                    @if ($firstImage)
                                        <img class="w-full rounded-t-md object-cover group-hover:scale-105 transition duration-300"
                                            src="{{ asset('storage/uplouds/' . $firstImage) }}" alt="{{ $item->title }}">
                                    @endif
                                    <div class="my-2 space-y-1">
                                        <div class="flex items-center justify-between">
                                            <h2 class="text-md text-gray-800">{{ $item->title }}</h2>
                                            <span class="bg-orange-100 text-orange-600 shrink-0 text-xs px-2 py-1 rounded-full">
                                                <i class="fas fa-fire"></i> محبوب
                                            </span>
                                        </div>
                                        <div class="text-xs text-justify text-gray-600 w-48 2xl:64 whitespace-nowrap overflow-hidden overflow-ellipsis">
                                            {{ $item->address }}
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-gray-400 text-xs">
                                                از <span class="text-gray-600 text-sm">{{ number_format($item->rooms_min_price) }} تومان</span>/ 1شب
                                            </p>
                                            <div class="flex items-center text-gray-400" dir="ltr">
                                                @php
                                                    $rating = $item->rating;
                                                    $full = floor($rating);
                                                    $half = $rating - $full >= 0.5 ? 1 : 0;
                                                    $empty = 5 - $full - $half;
                                                @endphp
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
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- بخش جدید: اقامتگاه‌های ارزان -->
            <div class="flex justify-between w-full items-center mb-4">
                <h1 class="text-xl text-gray-800"> ارزان‌ترین اقامتگاه‌ها</h1>
                <div class="flex items-center space-x-1">
                    <a href="{{ route('cheapestAccommodations') }}" class="text-orange-500">موارد بیشتر <i class="fas fa-arrow-left "></i></a>
                    
                </div>
            </div>
            <div class="swiper-fourth swiper-carousel mb-12">
                <div class="swiper-wrapper">
                    @foreach ($cheapestAccommodations as $item)
                        @php
                            $images = $item->images ?? [];
                            $firstImage = $images[0] ?? null;
                        @endphp
                        <div class="swiper-slide">
                            <div class="bg-white rounded-xl overflow-hidden transition group">
                                <a href="{{ route('details', ['id' => $item->id]) }}" class="space-y-3">
                                    @if ($firstImage)
                                        <img class="w-full rounded-t-md object-cover group-hover:scale-105 transition duration-300"
                                            src="{{ asset('storage/uplouds/' . $firstImage) }}" alt="{{ $item->title }}">
                                    @endif
                                    <div class="my-2 space-y-1">
                                        <div class="flex items-center justify-between">
                                            <h2 class="text-md text-gray-800">{{ $item->title }}</h2>
                                            <span class="bg-green-100 text-green-600 shrink-0 text-xs px-2 py-1 rounded-full">
                                                <i class="fas fa-tag"></i> ارزان
                                            </span>
                                        </div>
                                        <div class="text-xs text-justify text-gray-600 w-48 2xl:64 whitespace-nowrap overflow-hidden overflow-ellipsis">
                                            {{ $item->address }}
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-gray-400 text-xs">
                                                از <span class="text-gray-600 text-sm">{{ number_format($item->rooms_min_price) }} تومان</span>/ 1شب
                                            </p>
                                            <div class="flex items-center text-gray-400" dir="ltr">
                                                @php
                                                    $rating = $item->rating;
                                                    $full = floor($rating);
                                                    $half = $rating - $full >= 0.5 ? 1 : 0;
                                                    $empty = 5 - $full - $half;
                                                @endphp
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
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- بخش جدید: اقامتگاه‌های لوکس -->
            <div class="flex justify-between w-full items-center mb-4">
                <h1 class="text-xl text-gray-800"> اقامتگاه‌های لوکس</h1>
                <div class="flex items-center space-x-1">
                    <a href="{{ route('luxuryAccommodations') }}" class="text-orange-500">موارد بیشتر <i class="fas fa-arrow-left "></i></a>
                    
                </div>
            </div>
            <div class="swiper-fifth swiper-carousel mb-12">
                <div class="swiper-wrapper">
                    @foreach ($luxuryAccommodations as $item)
                        @php
                            $images = $item->images ?? [];
                            $firstImage = $images[0] ?? null;
                        @endphp
                        <div class="swiper-slide">
                            <div class="bg-white rounded-xl overflow-hidden transition group">
                                <a href="{{ route('details', ['id' => $item->id]) }}" class="space-y-3">
                                    @if ($firstImage)
                                        <img class="w-full rounded-t-md object-cover group-hover:scale-105 transition duration-300"
                                            src="{{ asset('storage/uplouds/' . $firstImage) }}" alt="{{ $item->title }}">
                                    @endif
                                    <div class="my-2 space-y-1">
                                        <div class="flex items-center justify-between">
                                            <h2 class="text-md text-gray-800">{{ $item->title }}</h2>
                                            <span class="bg-purple-100 text-purple-600 shrink-0 text-xs px-2 py-1 rounded-full">
                                                <i class="fas fa-crown"></i> لوکس
                                            </span>
                                        </div>
                                        <div class="text-xs text-justify text-gray-600 w-48 2xl:64 whitespace-nowrap overflow-hidden overflow-ellipsis">
                                            {{ $item->address }}
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-gray-400 text-xs">
                                                از <span class="text-gray-600 text-sm">{{ number_format($item->rooms_min_price) }} تومان</span>/ 1شب
                                            </p>
                                            <div class="flex items-center text-gray-400" dir="ltr">
                                                @php
                                                    $rating = $item->rating;
                                                    $full = floor($rating);
                                                    $half = $rating - $full >= 0.5 ? 1 : 0;
                                                    $empty = 5 - $full - $half;
                                                @endphp
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
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    
@endsection