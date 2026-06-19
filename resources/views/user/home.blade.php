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
                    <a href="lastAccomodation">موارد بیشتر </a>
                    <FaRegArrowAltCircleLeft class="text-orange-500 w-5 h-5" />
                </div>
            </div>
            <div class="swiper-second mb-12">
                <div class="swiper-wrapper ">

                    @foreach ($data as $item)
                        @php
                            $images = $item->images ?? []; // آرایه واقعی
                            $firstImage = $images[0] ?? null; // عکس اول
                        @endphp

                        <div class="swiper-slide">
                            <div class="bg-white rounded-xl  overflow-hidden  transition group">
                                <a href="{{ route('details', $item->id) }}">
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

                                    @if ($firstImage)
                                        <img class="w-full h-48 object-cover group-hover:scale-105 transition duration-300"
                                            src="{{ asset('storage/uplouds/' . $firstImage) }}" alt="{{ $item->title }}">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                                        </div>
                                    @endif

                                    <div class="py-2">
                                        <h2 class="text-md font-bold text-gray-800 mb-1 line-clamp-1">
                                            {{ $item->title }}</h2>
                                        <div
                                            class="text-xs text-justify text-gray-600 w-48 2xl:64 whitespace-nowrap overflow-hidden overflow-ellipsis">
                                            {{ $item->address }}
                                        </div>

                                        <div class="flex items-center justify-between mt-2">
                                            <p class="text-gray-400 text-xs">
                                                از <span
                                                    class="text-gray-600 text-sm font-bold">{{ number_format($minPrice) }}</span>
                                                تومان
                                                <span class="text-xs">/ شب</span>
                                            </p>
                                            <div class="flex items-center gap-1" dir="ltr">
                                                @for ($i = 0; $i < $full; $i++)
                                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                @endfor
                                                @if ($half)
                                                    <i class="fas fa-star-half-alt text-yellow-400 text-xs"></i>
                                                @endif
                                                @for ($i = 0; $i < $empty; $i++)
                                                    <i class="far fa-star text-gray-300 text-xs"></i>
                                                @endfor
                                                <span
                                                    class="text-xs font-bold text-gray-700 mr-1">{{ number_format($rating, 1) }}</span>
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

        </div>
    </div>
@endsection
