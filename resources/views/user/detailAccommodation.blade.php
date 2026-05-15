@extends('user.Layouts.master')
@section('Mycontent')
    <div class="mx-1 md:mx-20 xl:mx-40">
        <div class="flex justify-between items-center mt-8 mb-12">
            <div>
                <h1 class="text-2xl text-gray-800 mb-4">{{ $data->title }}</h1>
                <p class="text-sm text-gray-600">{{ $data->address }}</p>
            </div>
            <div class="hidden sm:flex flex-col sm:w-60 lg:w-72 space-y-3">
                <div class="flex items-center">
                    <a class="border hover:border-orange-500 border-gray-500 p-2 rounded-full me-3" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M15 5.75a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM17.25 2a3.75 3.75 0 0 0-3.654 4.598L8.448 9.396a3.75 3.75 0 1 0 0 5.209l5.148 2.797a3.75 3.75 0 1 0 .956-1.757l-5.148-2.797a3.761 3.761 0 0 0 0-1.696l5.148-2.798A3.75 3.75 0 1 0 17.25 2ZM3.5 12A2.25 2.25 0 1 1 8 12a2.25 2.25 0 0 1-4.5 0Zm13.75 4a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <button class="bg-orange-500 hover:bg-orange-600 py-2 text-white rounded-xl w-full">
                        <a href="#room">لیست اتاق ها</a>
                    </button>
                </div>
                <div class="flex p-2 justify-between items-center bg-green-100 text-green-500 border border-green-500 rounded-md">
                    <p>امتیازات کاربران</p>
                    <p>{{ number_format($data->rating, 1) }} از 10</p>
                </div>
            </div>
        </div>

        @php
            $images = $data->images ?? [];
            $totalImages = count($images);
            $imagesToShow = array_slice($images, 0, 5);
        @endphp

        @if (!empty($imagesToShow))
            <div class="relative mb-8 hidden sm:grid">
                <div class="grid grid-cols-4 grid-rows-2 gap-3">
                    <div class="col-span-2 row-span-2">
                        <img class="w-full h-full object-cover rounded-lg" 
                             src="{{ asset('storage/uplouds/' . $imagesToShow[0]) }}"
                             alt="Image 1">
                    </div>

                    @for ($i = 1; $i < count($imagesToShow) && $i < 5; $i++)
                        <div class="col-span-1 row-span-1">
                            <img class="rounded-lg w-full h-full object-cover"
                                 src="{{ asset('storage/uplouds/' . $imagesToShow[$i]) }}" 
                                 alt="Image {{ $i + 1 }}">
                        </div>
                    @endfor

                    @if ($totalImages > 0)
                        <div class="absolute left-2 bottom-2 place-items-center">
                            <div class="flex justify-between items-center p-2 text-xs lg:py-1 lg:px-4 bg-slate-100 lg:text-xs rounded-2xl">
                                <button id="openModal" class="text-blue-500">مشاهده همه ({{ $totalImages }})</button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M6 9.75A3.75 3.75 0 0 1 9.75 6h.5a.75.75 0 0 1 0 1.5h-.5A2.25 2.25 0 0 0 7.5 9.75v4.5a2.25 2.25 0 0 0 2.25 2.25h4.5a2.25 2.25 0 0 0 2.25-2.25v-.5a.75.75 0 0 1 1.5 0v.5A3.75 3.75 0 0 1 14.25 18h-4.5A3.75 3.75 0 0 1 6 14.25v-4.5Z"
                                        clip-rule="evenodd" fill="#3b82f6"></path>
                                    <path fill-rule="evenodd"
                                        d="M13 6.75a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0V8.56l-3.47 3.47a.75.75 0 1 1-1.06-1.06l3.47-3.47h-1.69a.75.75 0 0 1-.75-.75Z"
                                        clip-rule="evenodd" fill="#3b82f6"></path>
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Modal برای گالری -->
        <div id="modal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-75 backdrop-blur-sm hidden">
            <div class="relative bg-transparent p-4 rounded-lg max-w-4xl mx-auto w-full h-[80vh]">
                <button id="closeGalleryModalBtn" class="absolute top-4 left-6 text-white hover:text-gray-300 text-3xl font-bold z-10">
                    &times;
                </button>
                <div class="swiper-details overflow-hidden relative w-full h-full">
                    <div class="swiper-wrapper">
                        @foreach ($images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/uplouds/' . $image) }}"
                                    class="w-full h-[70vh] object-contain rounded-md"
                                    alt="تصویر اقامتگاه {{ $data->title ?? '' }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mb-2"></div>
                </div>
            </div>
        </div>

        <!-- برای حالت موبایل -->
        <div class="swiper-details sm:hidden mb-8 overflow-hidden relative w-full h-full">
            <div class="absolute left-2 top-2 z-10 p-1 bg-white rounded-full">
                <a href="#imageurl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M15 5.75a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM17.25 2a3.75 3.75 0 0 0-3.654 4.598L8.448 9.396a3.75 3.75 0 1 0 0 5.209l5.148 2.797a3.75 3.75 0 1 0 .956-1.757l-5.148-2.797a3.761 3.761 0 0 0 0-1.696l5.148-2.798A3.75 3.75 0 1 0 17.25 2ZM3.5 12A2.25 2.25 0 1 1 8 12a2.25 2.25 0 0 1-4.5 0Zm13.75 4a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/uplouds/' . $image) }}" 
                             class="w-full h-[70vh] object-cover rounded-md"
                             alt="تصویر اقامتگاه {{ $data->title ?? '' }}">
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="grid grid-cols-2 gap-5 mb-8">
            <div class="w-full col-span-full sm:col-span-1">
                <h1 class="text-lg mb-4">درباره {{ $data->title }}</h1>
                <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                    <div class="flex flex-col space-y-2 items-center justify-start">
                        <div class="flex justify-center items-center space-x-1">
                            <svg class="me-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19 17V7a4 4 0 0 0-7.756-1.38.561.561 0 0 1-.517.38c-.324 0-.569-.299-.464-.606A5.002 5.002 0 0 1 19.999 7v10a5 5 0 0 1-9.736 1.606c-.105-.307.14-.606.464-.606.234 0 .436.16.516.38A4.002 4.002 0 0 0 19 17Z"
                                    fill="#727272"></path>
                                <path d="m8.214 8 4.286 4m0 0-4.286 4m4.286-4h-10" stroke="#727272" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            <p>ساعت ورود</p>
                        </div>
                        <p class="text-gray-800">{{ substr($data->check_in_time, 0, 5) }}</p>
                    </div>
                    <div class="flex flex-col space-y-2 items-center">
                        <div class="flex justify-center items-center space-x-1">
                            <svg class="me-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19 17V7a4 4 0 0 0-7.756-1.38.561.561 0 0 1-.517.38c-.324 0-.569-.299-.464-.606A5.002 5.002 0 0 1 19.999 7v10a5 5 0 0 1-9.736 1.606c-.105-.307.14-.606.464-.606.234 0 .436.16.516.38A4.002 4.002 0 0 0 19 17Z"
                                    fill="#727272"></path>
                                <path d="M6.786 8 2.5 12m0 0 4.286 4M2.5 12h10" stroke="#727272" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            <p>ساعت خروج</p>
                        </div>
                        <p class="text-gray-800">{{ substr($data->check_out_time, 0, 5) }}</p>
                    </div>
                    <div class="flex flex-col space-y-2 items-center">
                        <div class="flex justify-center items-center space-x-1">
                            <svg class="me-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                <path d="M3.5 7.231a1 1 0 0 1 .697-.953l9-2.863a1 1 0 0 1 1.303.953V19.5a1 1 0 0 1-1 1h-9a1 1 0 0 1-1-1V7.231Z"
                                    stroke="#727272" stroke-linejoin="round"></path>
                                <path d="M14.5 11.5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-8ZM10.5 20.5v-3a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v3"
                                    stroke="#727272" stroke-linejoin="round"></path>
                                <path stroke="#727272" stroke-linecap="round" stroke-linejoin="round" d="M6.5 12.5h5M7.5 9.5h3"></path>
                                <rect x="17" y="16" width="1" height="1" rx=".5" fill="#727272"></rect>
                                <rect x="17" y="13" width="1" height="1" rx=".5" fill="#727272"></rect>
                                <path stroke="#727272" d="M16 20.5h-4"></path>
                            </svg>
                            <p>تعداد طبقه</p>
                        </div>
                        <p class="text-gray-800">{{ $data->floors ?? '-' }}</p>
                    </div>
                    <div class="flex flex-col space-y-2 items-center">
                        <div class="flex justify-center items-center space-x-1">
                            <svg class="me-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                <path stroke="#727272" stroke-linecap="round" stroke-linejoin="round" d="M10.5 13.5h1"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.998 4.503a1.5 1.5 0 0 0-2.161-1.346L6.839 5.12A1.5 1.5 0 0 0 6 6.467v13.034A1.5 1.5 0 0 0 7.5 21h3.998a1.5 1.5 0 0 0 1.5-1.5V4.503ZM10.396 2.26c1.661-.816 3.602.393 3.602 2.244v14.998a2.5 2.5 0 0 1-2.5 2.5H7.5A2.5 2.5 0 0 1 5 19.5V6.467a2.5 2.5 0 0 1 1.398-2.243l3.998-1.965Z"
                                    fill="#727272"></path>
                                <path d="M13.5 4.5h2a3 3 0 0 1 3 3v11a3 3 0 0 1-3 3h-4" stroke="#727272" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            <p>تعداد اتاق</p>
                        </div>
                        <p class="text-gray-800">{{ $data->rooms_count ?? '-' }}</p>
                    </div>
                </div>
                <div class="">
                    <p class="text-gray-800 text-xs text-justify  tracking-wide leading-5">{{ $data->description }}</p>
                </div>
            </div>

            <div class="w-full col-span-full sm:col-span-1">
                <div class="grid grid-cols-2">
                    <div class="col-span-1 w-full">
                        <h1 class="text-lg mb-4">امکانات عمومی</h1>
                        <div class="flex flex-col space-y-2 text-sm text-gray-800">
                            @php $generalFacilities = $data->general_facilities ?? []; @endphp
                            @foreach (array_slice($generalFacilities, 0, 5) as $item)
                                <div class="flex items-center">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5px"
                                            d="m7 12 3.333 3L17 9" stroke="#AAAAAA" fill="none"></path>
                                    </svg>
                                    <p>{{ $item }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-span-1 w-full">
                        <h1 class="text-lg mb-4">امکانات اتاق</h1>
                        <div class="flex flex-col space-y-2 text-sm text-gray-800">
                            @php $roomFacilities = $data->room_facilities ?? []; @endphp
                            @foreach (array_slice($roomFacilities, 0, 5) as $item)
                                <div class="flex items-center">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5px"
                                            d="m7 12 3.333 3L17 9" stroke="#AAAAAA" fill="none"></path>
                                    </svg>
                                    <p>{{ $item }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center mt-2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M6 9.75A3.75 3.75 0 0 1 9.75 6h.5a.75.75 0 0 1 0 1.5h-.5A2.25 2.25 0 0 0 7.5 9.75v4.5a2.25 2.25 0 0 0 2.25 2.25h4.5a2.25 2.25 0 0 0 2.25-2.25v-.5a.75.75 0 0 1 1.5 0v.5A3.75 3.75 0 0 1 14.25 18h-4.5A3.75 3.75 0 0 1 6 14.25v-4.5Z"
                                clip-rule="evenodd" fill="#3b82f6"></path>
                            <path fill-rule="evenodd"
                                d="M13 6.75a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0V8.56l-3.47 3.47a.75.75 0 1 1-1.06-1.06l3.47-3.47h-1.69a.75.75 0 0 1-.75-.75Z"
                                clip-rule="evenodd" fill="#3b82f6"></path>
                        </svg>
                    </div>
                    <button id="modalbtn" class="text-sm text-blue-500">مشاهده همه</button>
                </div>

                <!-- Modal امکانات کلی -->
                <div id="modalOverlay" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-75 backdrop-blur-sm hidden">
                    <div class="relative bg-transparent p-4 rounded-lg max-w-4xl mx-auto w-full h-[80vh]">
                        <button id="modalClose" class="absolute top-4 left-6 text-black hover:text-gray-300 text-3xl font-bold z-10">
                            &times;
                        </button>
                        <div class="w-full h-full bg-white rounded-md px-4 py-6 overflow-y-auto scroll-smooth">
                            <div class="flex justify-around items-center text-sm text-gray-800">
                                <a href="#title1" class="hover:text-orange-500 focus:text-orange-500 cursor-pointer">عمومی هتل</a>
                                <a href="#title2" class="hover:text-orange-500 focus:border-orange-500 cursor-pointer">امکانات اتاق</a>
                                <a href="#title3" class="hover:text-orange-500 focus:border-orange-500 cursor-pointer">امکانات اختصاصی هتل</a>
                                <a href="#title4" class="hover:text-orange-500 focus:border-orange-500 cursor-pointer">رفاهی</a>
                                <a href="#title5" class="hover:text-orange-500 focus:border-orange-500 cursor-pointer">ورزشی تفریحی</a>
                            </div>
                            <hr class="text-gray-300 w-full my-3">
                            
                            <p id="title1" class="text-gray-800 text-base my-3">عمومی اقامتگاه</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 space-y-2 text-xs md:text-sm">
                                @forelse ($generalFacilities as $item)
                                    <div class="flex items-center">
                                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5px"
                                                d="m7 12 3.333 3L17 9" stroke="#AAAAAA" fill="none"></path>
                                        </svg>
                                        <p>{{ $item }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500">امکاناتی ارائه نمیشود</p>
                                @endforelse
                            </div>
                            <hr class="text-gray-300 w-full my-3">
                            
                            <p id="title2" class="text-gray-800 text-base my-3">امکانات اتاق</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 space-y-2 text-xs md:text-sm">
                                @forelse ($roomFacilities as $item)
                                    <div class="flex items-center">
                                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5px"
                                                d="m7 12 3.333 3L17 9" stroke="#AAAAAA" fill="none"></path>
                                        </svg>
                                        <p>{{ $item }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500">امکاناتی ارائه نمیشود</p>
                                @endforelse
                            </div>
                            <hr class="text-gray-300 w-full my-3">
                            
                            <p id="title3" class="text-gray-800 text-base my-3">امکانات اختصاصی اقامتگاه</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 space-y-2 text-xs md:text-sm">
                                @php $privateFacilities = $data->private_facilities ?? []; @endphp
                                @forelse ($privateFacilities as $item)
                                    <div class="flex items-center">
                                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5px"
                                                d="m7 12 3.333 3L17 9" stroke="#AAAAAA" fill="none"></path>
                                        </svg>
                                        <p>{{ $item }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500">امکاناتی ارائه نمیشود</p>
                                @endforelse
                            </div>
                            <hr class="text-gray-300 w-full my-3">
                            
                            <p id="title4" class="text-gray-800 text-base my-3">رفاهی</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 space-y-2 text-xs md:text-sm">
                                @php $leisureFacilities = $data->leisure_facilities ?? []; @endphp
                                @forelse ($leisureFacilities as $item)
                                    <div class="flex items-center">
                                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5px"
                                                d="m7 12 3.333 3L17 9" stroke="#AAAAAA" fill="none"></path>
                                        </svg>
                                        <p>{{ $item }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500">امکاناتی ارائه نمیشود</p>
                                @endforelse
                            </div>
                            <hr class="text-gray-300 w-full my-3">
                            
                            <p id="title5" class="text-gray-800 text-base my-3">ورزشی تفریحی</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 space-y-2 text-xs md:text-sm">
                                @php $entertainmentFacilities = $data->entertainment_facilities ?? []; @endphp
                                @forelse ($entertainmentFacilities as $item)
                                    <div class="flex items-center">
                                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5px"
                                                d="m7 12 3.333 3L17 9" stroke="#AAAAAA" fill="none"></path>
                                        </svg>
                                        <p>{{ $item }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500">امکاناتی ارائه نمیشود</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($data->important_notes)
            <div class="w-full mb-8 bg-blue-50 border border-blue-50 rounded-md transition duration-300 hover:border hover:border-blue-600 p-4">
                <h1 class="text-base text-gray-800 mb-4">نکات مهم {{ $data->title }}</h1>
                <p class="text-sm text-gray-500">نکته قابل توجه : {{ $data->important_notes }}</p>
            </div>
        @endif

        <div class="w-full">
            <h1 id="room" class="text-lg mb-4">لیست اتاق‌های اقامتگاه {{ $data->title }}</h1>
            
            @foreach ($data->rooms as $room)
                <div class="w-full grid grid-cols-4 p-4 border rounded-lg border-gray-300 mb-8">
                    <div class="col-span-full sm:col-span-3 border-b sm:border-b-0 sm:border-l border-gray-300 sm:pe-3">
                        <div class="flex flex-col sm:flex-row justify-between">
                            <div class="order-2 sm:order-1 pb-2 sm:pb-0">
                                <h1 class="text-base mb-2">{{ $room->title }}</h1>
                                <div class="flex items-center justify-start">
                                    <div class="flex items-center me-4">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-muted me-1">
                                            <path stroke="#AAAAAA" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1.5px" d="M7.736 6.874a2.25 2.25 0 1 0 .852 3.72" fill="none"></path>
                                            <path stroke="#AAAAAA" stroke-linecap="round" stroke-width="1.5px" d="M5.862 18.25H4a.25.25 0 0 1-.25-.25v-.5a3.25 3.25 0 0 1 3.823-3.2" fill="none"></path>
                                            <path stroke="#AAAAAA" stroke-miterlimit="10" stroke-width="1.5px" d="M14.75 10.75a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z" fill="none"></path>
                                            <path stroke="#AAAAAA" stroke-width="1.5px" d="M9.25 19.704c0-3.012 2.488-5.454 5.5-5.454s5.5 2.442 5.5 5.454a.545.545 0 0 1-.546.546H9.795a.545.545 0 0 1-.545-.546Z" fill="none"></path>
                                        </svg>
                                        <p class="text-xs text-gray-500">{{ $room->capacity }} نفر</p>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="me-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-muted">
                                            <path stroke="#AAAAAA" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5px"
                                                d="M4.75 11.25h14.5a2 2 0 0 1 2 2v4.5H2.75v-4.5a2 2 0 0 1 2-2m4-3.5h6.5a1 1 0 0 1 1 1v2.5h-8.5v-2.5a1 1 0 0 1 1-1M4.5 18v1.25m15-1.25v1.25"
                                                fill="none"></path>
                                            <path stroke="#AAAAAA" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5px"
                                                d="M6.75 4.75h10.5a2 2 0 0 1 2 2v4.5H4.75v-4.5a2 2 0 0 1 2-2" fill="none"></path>
                                        </svg>
                                        <p class="text-xs text-gray-500">{{ $room->beds }}</p>
                                    </div>
                                </div>
                            </div>
                            <img class="rounded-lg w-full order-1 sm:order-2 mb-2 sm:mb-0 lg:w-72 h-full object-cover"
                                 src="{{ asset('storage/uplouds/rooms/' . $room->image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-1 mt-3 sm:mt-0 sm:mr-3">
                        <div class="grid grid-rows-4 h-full">
                            <div class="row-span-1">
                                <div class="flex items-center justify-center">
                                    @if ($room->discount_price)
                                        <p class="text-sm text-gray-500 line-through me-2">{{ number_format($room->price) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row-span-1">
                                <div class="flex items-center justify-center">
                                    <p class="text-base">{{ number_format($room->discount_price ?? $room->price) }}<span>تومان</span></p>
                                    <span class="text-gray-500 text-xs">/ 1 شب</span>
                                </div>
                            </div>
                            <div class="row-span-1"></div>
                            <div class="w-full row-span-1">
                                <button class="w-full py-2 text-sm text-white bg-orange-500 rounded-lg">انتخاب تاریخ</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection