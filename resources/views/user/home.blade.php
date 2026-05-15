@extends('user.Layouts.master')
@section('Mycontent')
    <div>

        <div class="class= mx-1  md:mx-20 xl:mx-40">
            @session('success')
                <div class="w-full p-2 bg-green-100 border border-green-500 text-green-500 rounded-lg">{{ $value }}</div>
            @endsession
        </div>
        <picture class="city-banner">
            <img class="w-full object-cover" src="/image/home.jpg" alt="home" />
        </picture>

        <div class=" mx-1  md:mx-20 xl:mx-40 relative -mt-28">
            <div class="mb-12">
                <h1 class="text-2xl  text-gray-800 mb-4">رزرو اقامتگاه و اقامتگاه های کشور</h1>
                <p>اولین ارائه دهنده اولین ارائه دهنده رسمی خدمات تخصصی رزرواسیون اقامتگاه و اقامتگاه های کشور</p>
            </div>
            <div
                class="w-full mb-12  p-4 grid  md:grid-cols-2 xl:grid-cols-4  gap-4 border border-gray-300 rounded-md  bg-white items-center">
                <div class=" ">
                    <label class="text-xs  text-gray-600" htmlFor="نام شهر یا اقامتگاه">نام شهر یا
                        اقامتگاه</label>
                    <input class="border border-gray-300 rounded-md p-2 w-full " type="text" />

                </div>
                <div class="">
                    <label class="text-xs  text-gray-600" htmlFor="از تاریخ">از تاریخ</label>
                    <input data-jdp class="border border-gray-300 rounded-md p-2 w-full" type="text">

                </div>
                <div>
                    <label class="text-xs  text-gray-600" htmlFor="تا مدت">تا مدت</label>
                    <input class="border border-gray-300 rounded-md p-2 w-full" type="text" />

                </div>
                <div>
                    <button class="bg-orange-500 hover:bg-orange-600 mt-6 py-2.5 px-3 text-white rounded-md w-full "><a
                            href="/search">جستجو</a></button>
                </div>
            </div>


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
                            <a href="{{ route('details', ['id' => $item->id]) }}" class="space-y-3">


                             

                                @if ($firstImage)
                                    <img class="w-full rounded-md" src="{{ asset('storage/uplouds/' . $firstImage) }}" alt="{{ $item->title }}">
                                @endif



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
                            </a>
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
