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
                <button id="menu-toggle" class="md:hidden text-3xl me-2 text-gray-700 focus:outline-none">
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
                <a href="#" class="hover:text-orange-500 me-3 text-gray-600">مقاصد</a>
                <a href="{{ route('about') }}" class="hover:text-orange-500 me-3 text-gray-600">درباره ما</a>
                <a href="{{ route('contact') }}" class="hover:text-orange-500 me-3 text-gray-600">تماس با ما</a>

            </div>
            <!-- منوی دسکتاپ -->
            <div class="flex items-center  text-sm  text-gray-600">

                <div class="relative z-10">

                    @guest
                        <a href="{{ route('user.register.show') }}" id="openUser"
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
    <div id="mobile-menu" class="fixed inset-0 bg-orange-400 hidden p-3  z-10 animate-fadeIn">
        <div class="flex flex-col  justify-start items-start text-white space-x-6 text-lg">
            <button id="menu-close" class="absolute top-5 left-5 text-3xl focus:outline-none  text-gray-800">
                ✕
            </button>


            <a href="#" class="text-gray-800 hover:bg-orange-500 hover:text-white w-full p-3  ">اقامتگاه</a>
            <a href="#" class="text-gray-800 hover:bg-orange-500 hover:text-white w-full p-3  ">مقاصد</a>
            <a href="#" class="text-gray-800 hover:bg-orange-500 hover:text-white w-full p-3  ">محصولات</a>


            <a id="openUser" href="#"
                class="mt-5 bg-orange-500 text-white rounded-3xl px-5 py-2 hover:bg-orange-600 transition">
                ورود / ثبت‌نام
            </a>

            <div class="flex items-center mt-4 space-x-2 space-x-reverse">
                <p class="me-2">09120000000</p>
                <span><svg class="" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"
                        width="28" height="28" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8.754 5.63c-.197-.536-.85-.79-1.341-.514L5.398 6.252c-.297.168-.433.466-.389.738a14.402 14.402 0 0 0 3.98 7.803 15.095 15.095 0 0 0 7.832 4.192.801.801 0 0 0 .839-.38l1.23-2.076c.243-.41.061-1.011-.506-1.23a16.67 16.67 0 0 1-2.843-1.425c-.429-.27-.97-.132-1.191.23-.443.723-1.375.937-2.048.478a10.559 10.559 0 0 1-3.007-3.121c-.437-.7-.153-1.587.55-1.982a.744.744 0 0 0 .26-1.046c-.54-.891-.992-1.83-1.351-2.804ZM6.43 3.373c1.658-.935 3.616-.023 4.2 1.564.315.853.711 1.677 1.185 2.46.67 1.105.502 2.587-.503 3.478a8.56 8.56 0 0 0 1.675 1.732c.949-1.015 2.508-1.124 3.617-.428.79.495 1.628.915 2.502 1.253 1.536.594 2.475 2.48 1.505 4.116l-1.23 2.076a2.801 2.801 0 0 1-2.947 1.322 17.095 17.095 0 0 1-8.87-4.75 16.403 16.403 0 0 1-4.53-8.886c-.191-1.184.432-2.265 1.381-2.8L6.43 3.373Z"
                            clip-rule="evenodd" fill="#f97316"></path>
                    </svg></span>
            </div>
        </div>

    </div>

    {{-- @include('user.registeruser') --}}




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
