@extends('user.Layouts.master')
@section('Mycontent')
    <div>
        <picture class="city-banner">
            <img class="w-full object-cover" src="/image/home.jpg" alt="home" />
        </picture>
        <div class=" mx-1  md:mx-20 xl:mx-40 relative -mt-20">
            <h1 class="text-2xl  text-gray-800 mb-4"> اقامتگاه های {{ $city->name }}</h1>
            <div
                class="w-full mb-12  p-4 grid  md:grid-cols-2 xl:grid-cols-4  gap-4 border border-gray-300 rounded-md  bg-white items-center">
                <div class=" ">
                    <label class="text-xs  text-gray-600" htmlFor="نام شهر یا اقامتگاه">نام شهر یا
                        اقامتگاه</label>
                    <input class="border border-gray-300 rounded-md p-2 w-full " type="text" />

                </div>

                <div class="">
                    <label class="text-xs  text-gray-600" htmlFor="از تاریخ">از تاریخ</label>
                    <input class="border border-gray-300 rounded-md p-2 w-full" type="text" />

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
            <div class="grid grid-cols-12 gap-6 mb-12 ">


                <div class="col-span-full order-2 lg:-order-1 lg:col-span-3  ">
                    <div class="border p-3 rounded-b-none rounded-md border-gray-300 ">
                        <h1 class="text-md     text-gray-600">
                            فیلترهای اقامتگاه
                        </h1>
                    </div>

                    <div class="border p-3 rounded-md rounded-t-none  border-gray-300 border-t-0">
                        <p class="text-gray-600  text-sm  mb-3">نام اقامتگاه</p>
                        <div class="relative flex items-center  ">
                            <input type="text"
                                class=" border border-s-gray-200 bg-gray-100 text-xs  p-2 w-full rounded-md  hover:bg-white hover:border-gray-200 selection:bg-white focus:bg-white"
                                placeholder="جستجو">
                            <img src="/icons/svgexport-2.svg" alt="" class="absolute left-2">
                        </div>
                        <hr class="text-gray-300 my-3">

                        <p class="text-gray-600  text-sm  mb-3">محدوده قیمت</p>


                        <!-- اسلایدر اینجا قرار می‌گیرد -->



                        <!-- 1. المنت اصلی اسلایدر -->
                        <div id="price-slider" class="px-2"></div>

                        <!-- نمایش مقادیر -->
                        <div class="values flex justify-between mt-4 text-xs text-gray-500  ">
                            <span>حداکثر قیمت: <span id="val-max">1000000</span></span>
                            <span>حداقل قیمت: <span id="val-min">0</span></span>
                        </div>

                        <hr class="text-gray-300 my-3">

                        <p class="text-gray-600  text-sm  mb-3">نوع اقامتگاه</p>
                        <div class="flex flex-col space-y-3 items-start w-full">
                            <div class="flex">
                                <input type="checkbox" class="me-2">
                                <label for="" class="text-xs text-gray-500 font-medium ">مجتمع اقامتی</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" class="me-2">
                                <label for="" class="text-xs text-gray-500 font-medium ">اقامتگاه بومگردی</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" class="me-2">
                                <label for="" class="text-xs text-gray-500 font-medium ">خانه مسافر</label>
                            </div>
                        </div>

                        <hr class="text-gray-300 my-3">

                        <p class="text-gray-600  text-sm  mb-3">تعداد تخت</p>
                        <div class="flex flex-col space-y-3 items-start w-full">
                            <div class="flex">
                                <input type="checkbox" class="me-2">
                                <label for="" class="text-xs text-gray-500 font-medium ">1 تخته</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" class="me-2">
                                <label for="" class="text-xs text-gray-500 font-medium ">2 تخته</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" class="me-2">
                                <label for="" class="text-xs text-gray-500 font-medium ">3 تخته</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" class="me-2">
                                <label for="" class="text-xs text-gray-500 font-medium ">4 تخته</label>

                            </div>
                            <div class="flex">
                                <input type="checkbox" class="me-2">
                                <label for="" class="text-xs text-gray-500 font-medium ">5 تخته و بیشتر</label>
                            </div>
                        </div>

                        <hr class="text-gray-300 my-3">

                        <p class="text-gray-600  text-sm  mb-3">امتیاز کاربران</p>
                        <div class="flex flex-col space-y-3 items-start w-full">
                            <div class="flex justify-between items-center w-full">
                                <div>
                                    <input type="checkbox" class="me-2">
                                    <label for="" class="text-xs text-gray-500 font-medium ">عالی</label>
                                </div>
                                <p class="text-xs text-gray-500 font-medium ">8 به بالا</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <div>
                                    <input type="checkbox" class="me-2">
                                    <label for="" class="text-xs text-gray-500 font-medium ">خوب</label>
                                </div>
                                <p class="text-xs text-gray-500 font-medium ">6 تا 8</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <div>
                                    <input type="checkbox" class="me-2">
                                    <label for="" class="text-xs text-gray-500 font-medium ">متوسط</label>
                                </div>
                                <p class="text-xs text-gray-500 font-medium ">4 تا 6</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <div>
                                    <input type="checkbox" class="me-2">
                                    <label for="" class="text-xs text-gray-500 font-medium ">ضعیف</label>
                                </div>
                                <p class="text-xs text-gray-500 font-medium ">4 به پایین</p>
                            </div>

                        </div>

                    </div>
                </div>


                <div class=" col-span-full lg:col-span-9 ">

                    <div class="grid grid-cols-3 w-full gap-5 ">
                        <div class=" col-span-9 ">
                            <h1 class="text-xl  text-gray-800 mb-4">لیست اقامتگاه های {{ $city->name }}</h1>
                            <div class="flex justify-between sm:justify-start   sm:space-x-4 items-center w-full mb-4">
                                <p class=" hidden sm:flex text-sm  text-gray-800 me-3">نمایش بر اساس:</p>
                                <a class="text-sm font-normal  text-gray-800 p-1  sm:py-1 sm:px-2 rounded-md hover:bg-orange-500 hover:text-white  focus:bg-orange-500 focus:text-white"
                                    href="#">پیشفرض</a>


                                <a class="text-sm font-normal  text-gray-800 p-1 sm:py-1 sm:px-2 rounded-md hover:bg-orange-500 hover:text-white  focus:bg-orange-500 focus:text-white"
                                    href="#">کمترین
                                    قیمت</a>
                                <a class="text-sm font-normal  text-gray-800 p-1 sm:py-1 sm:px-2 rounded-md hover:bg-orange-500 hover:text-white  focus:bg-orange-500 focus:text-white"
                                    href="#">بیشترین
                                    قیمت</a>
                                <a class="text-sm font-normal  text-gray-800 p-1 sm:py-1 sm:px-2 rounded-md hover:bg-orange-500 hover:text-white  focus:bg-orange-500 focus:text-white"
                                    href="#">بالاترین امتیاز</a>
                            </div>

                            @if (count($city->accommodations) == 0)
                                <p class="w-full p-2  bg-red-100 border border-red-500 rounded-md text-center text-red-500">
                                    اقامتگاهی برای این شهر وجود ندارد</p>
                            @else
                                <div class="grid  grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 w-full gap-5 ">
                                    @foreach ($city->accommodations as $item)
                                        @php
                                            $images = $item->images ?? []; // آرایه واقعی
                                            $firstImage = $images[0] ?? null; // عکس اول
                                        @endphp
                                        <div>
                                            <a href="{{ route('details', ['id' => $item->id]) }}" class="space-y-3">
                                                <img class="w-full rounded-md" src="{{ asset('storage/uplouds/' . $firstImage) }}" alt="{{ $item->title }}">
                                                <h2 class="text-md  text-gray-800">{{ $item->title }}
                                                </h2>
                                                <div
                                                    class="text-xs  text-justify text-gray-600 w-48 2xl:64  whitespace-nowrap overflow-hidden overflow-ellipsis">
                                                    {{ $item->address }}
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <p class="text-gray-400 text-xs ">از <span
                                                            class="text-gray-600 text-sm">
                                                            {{ number_format($minPrice) }}
                                                            تومان </span>/ 1شب</p>
                                                    @php
                                                        $rating = $item->rating ; // یا هر نام متغیر دیگه
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
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif





                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
