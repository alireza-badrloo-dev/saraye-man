<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>سرای من</title>

    <!-- در بخش head -->
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    @vite(['resources/css/accommodations.css', 'resources/js/accomodations.js', 'resources/js/homeModal.js', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/modal.js'])
</head>


<body class="flex flex-col min-h-screen relative ">

    <header class="h-14">

        <div class=" mx-1  md:mx-20 xl:mx-40 flex items-center  justify-between h-full">
            <div class="flex">
                <!-- دکمه همبرگری (فقط موبایل) -->
                <button id="menu-open" class="md:hidden text-3xl me-2 text-gray-700 focus:outline-none">
                    ☰
                </button>
                <!-- Logo -->
                <a href="{{ route('home') }}" class=" text-lg flex items-center   lg:text-xl text-orange-500">
                    <img class="w-14" src="/image/Artboard 1.svg" alt="">
                    <h1>سرای من</h1>
                </a>
            </div>
            <div class="hidden  md:flex   w-3/5 lg:w-3/4">
                <a href="{{ route('accommodations') }}" class="hover:text-orange-500 me-3 text-gray-600">اقامتگاه</a>
                <a href="{{ route('blog.index') }}" class="hover:text-orange-500 me-3 text-gray-600">مجله</a>
                <a href="{{ route('about') }}" class="hover:text-orange-500 me-3 text-gray-600">درباره ما</a>
                <a href="{{ route('contact') }}" class="hover:text-orange-500 me-3 text-gray-600">تماس با ما</a>

            </div>
            <!-- منوی دسکتاپ -->
            <div class="flex items-center  text-sm  text-gray-600">

                <div class="relative z-10">

                    @guest
                        <a href="{{ route('user.login.show') }}" 
                            class="p-1 w-28 bg-orange-100 border text-center border-orange-500 rounded-3xl text-orange-500 px-4 py-1 hover:bg-orange-500 hover:text-white transition">
                            ورود / ثبت‌نام
                        </a>
                    @endguest

                    @auth
                        <button id="userMenuBtn"
                            class="p-1 bg-orange-100 border border-orange-500 rounded-3xl text-orange-500 px-4 py-1 hover:bg-orange-500 hover:text-white transition">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </button>

                        <!-- Dropdown -->
                        <div id="userDropdown"
                            class="hidden absolute left-0 mt-2 w-40 bg-white rounded-lg shadow-lg border">

                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 hover:bg-gray-100">
                                پروفایل
                            </a>

                            <a href="{{ route('user.reserve') }}" class="block px-4 py-2 hover:bg-gray-100">
                                رزروها
                            </a>

                            <a href="{{ route('user.logout') }}" class="block px-4 py-2 hover:bg-gray-100 text-red-500">
                                خروج
                            </a>


                        </div>
                    @endauth

                </div>

            </div>

        </div>


    </header>
    </div>

    <!-- منوی موبایل تمام‌صفحه -->
    <div id="mobile-menu" class="fixed inset-0 bg-white hidden p-6 z-50 animate-fadeIn shadow-2xl">
    <div class="flex flex-col justify-start items-start h-full">
        <!-- دکمه بستن -->
        <button id="menu-close" class="absolute top-5 left-5 text-3xl focus:outline-none text-gray-600 hover:text-orange-500 transition-colors duration-200">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- لوگو -->
        <div class="flex items-center gap-2 mb-8 mt-4">
            <img class="w-10" src="/image/Artboard 1.svg" alt="سرای من">
            <h1 class="text-2xl font-bold text-orange-500">سرای من</h1>
        </div>

        <!-- لینک‌های منو -->
        <nav class="flex flex-col w-full space-y-1">
            <a href="{{ route('accommodations') }}" 
                class="text-gray-700 hover:bg-orange-50 hover:text-orange-500 w-full p-4 rounded-xl transition-all duration-200 flex items-center gap-3 text-base font-medium border-b border-gray-100">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                اقامتگاه‌ها
            </a>

            <a href="{{ route('blog.index') }}" 
                class="text-gray-700 hover:bg-orange-50 hover:text-orange-500 w-full p-4 rounded-xl transition-all duration-200 flex items-center gap-3 text-base font-medium border-b border-gray-100">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                مجله
            </a>

            <a href="{{ route('about') }}" 
                class="text-gray-700 hover:bg-orange-50 hover:text-orange-500 w-full p-4 rounded-xl transition-all duration-200 flex items-center gap-3 text-base font-medium border-b border-gray-100">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                درباره ما
            </a>

            <a href="{{ route('contact') }}" 
                class="text-gray-700 hover:bg-orange-50 hover:text-orange-500 w-full p-4 rounded-xl transition-all duration-200 flex items-center gap-3 text-base font-medium border-b border-gray-100">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                تماس با ما
            </a>
        </nav>

        <!-- دکمه ورود/ثبت‌نام -->
        <a id="openUser" href="{{ route('user.login.show') }}"
            class="w-full mt-6 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl px-6 py-3.5 hover:shadow-lg hover:shadow-orange-200 transition-all duration-300 text-center font-medium text-base flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            ورود / ثبت‌نام
        </a>

       
    </div>
</div>



    




    @yield('Mycontent')


<footer class="mx-10 md:mx-20 xl:mx-40 border-t border-gray-200 pt-8">
    <div class="grid grid-rows-6 lg:grid-rows-1 lg:grid-cols-6 gap-3 lg:gap-8">
        
        <!-- بخش اول - لوگو و توضیحات -->
        <div class="lg:col-span-2">
            <div class="flex items-center">
                <img class="w-14" src="/image/Artboard 1.svg" alt="سرای من">
                <h1 class="text-2xl font-bold text-orange-500 mr-2">سرای من</h1>
            </div>
            <p class="text-sm text-gray-600 text-justify mt-4 leading-relaxed">
                سرای من به عنوان اولین مرجع تخصصی رزرو آنلاین اقامتگاه‌های بوم‌گردی و ویلا در ایران، 
                از سال ۱۳۹۵ فعالیت خود را آغاز کرده است.
            </p>
        </div>

        <!-- بخش دوم - دسترسی سریع -->
        <div>
            <p class="mb-4 text-base font-semibold text-gray-800 border-r-2 border-orange-500 pr-2">دسترسی سریع</p>
            <ul class="grid grid-cols-2 lg:grid-cols-1 gap-y-3">
                <li><a class="text-sm hover:text-orange-500 text-gray-600 transition" href="{{ route('about') }}">درباره ما</a></li>
                <li><a class="text-sm hover:text-orange-500 text-gray-600 transition" href="{{ route('contact') }}">تماس با ما</a></li>
                <li><a class="text-sm hover:text-orange-500 text-gray-600 transition" href="#">قوانین</a></li>
                <li><a class="text-sm hover:text-orange-500 text-gray-600 transition" href="#">سوالات متداول</a></li>
            </ul>
        </div>

        <!-- بخش سوم - شهرهای محبوب -->
        <div>
            <p class="mb-4 text-base font-semibold text-gray-800 border-r-2 border-orange-500 pr-2">شهرهای محبوب</p>
            <ul class="grid grid-cols-2 lg:grid-cols-1 gap-y-3">
                @php
                    $popularCities = App\Models\City::withCount('accommodations')
                        ->having('accommodations_count', '>', 0)
                        ->orderBy('accommodations_count', 'desc')
                        ->take(6)
                        ->get();
                @endphp
                @foreach($popularCities as $city)
                    <li>
                        <a class="text-sm hover:text-orange-500 text-gray-600 transition" 
                           href="{{ route('city', $city->id) }}">
                            {{ $city->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- بخش چهارم - اقامتگاه‌ها -->
        <div>
            <p class="mb-4 text-base font-semibold text-gray-800 border-r-2 border-orange-500 pr-2">اقامتگاه‌ها</p>
            <ul class="grid grid-cols-2 lg:grid-cols-1 gap-y-3">
                <li><a class="text-sm hover:text-orange-500 text-gray-600 transition" href="{{ route('accommodations') }}">همه اقامتگاه‌ها</a></li>
                <li><a class="text-sm hover:text-orange-500 text-gray-600 transition" href="{{ route('accommodations', ['sort' => 'rating_desc']) }}">محبوب‌ترین‌ها</a></li>
                <li><a class="text-sm hover:text-orange-500 text-gray-600 transition" href="{{ route('accommodations', ['sort' => 'price_asc']) }}">ارزان‌ترین‌ها</a></li>
                <li><a class="text-sm hover:text-orange-500 text-gray-600 transition" href="{{ route('accommodations', ['facilities' => 'wi-fi']) }}">دارای وای‌فای</a></li>
            </ul>
        </div>

        <!-- بخش پنجم - ارتباط با ما -->
        <div>
            <p class="mb-4 text-base font-semibold text-gray-800 border-r-2 border-orange-500 pr-2">ارتباط با ما</p>
            <ul class="grid grid-cols-2 lg:grid-cols-1 gap-y-3">
                <li class="flex items-center text-sm text-gray-600 hover:text-orange-500 transition">
                    <img src="/icons/instagram.svg" class="me-2" alt="">
                    <a href="#">اینستاگرام</a>
                </li>
                <li class="flex items-center text-sm text-gray-600 hover:text-orange-500 transition">
                    <img src="/icons/telegram.svg" class="me-2" alt="">
                    <a href="#">تلگرام</a>
                </li>
                <li class="flex items-center text-sm text-gray-600 hover:text-orange-500 transition">
                    <img src="/icons/aparat.svg" class="me-2" alt="">
                    <a href="#">آپارات</a>
                </li>
                <li class="flex items-center text-sm text-gray-600 hover:text-orange-500 transition">
                    <img src="/icons/twitter.svg" class="me-2" alt="">
                    <a href="#">توییتر</a>
                </li>
            </ul>
        </div>
    </div>

    <hr class="text-gray-300 my-6">

    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-2">
        <span class="text-gray-600 text-xs">سرای من |</span>
        <p class="text-xs text-gray-500 text-center">
            تمامی خدمات این وب سایت دارای مجوزهای لازم از مراجع مربوطه می باشد و
            فعالیت های این سایت تابع قوانین و مقررات جمهوری اسلامی ایران است.
        </p>
    </div>
</footer>

    <script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>

    <script>
        // فعال‌سازی تقویم روی همه input‌های دارای data-jdp
        jalaliDatepicker.startWatch();
    </script>
</body>

</html>
