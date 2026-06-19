<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     
 <!-- توی هدر -->


    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/admin.css', 'resources/js/admin.js'])
  
</head>

<body class="">
    <div id="overlay" class="hidden w-full h-full fixed z-40 top0 right-0 bg-slate-900 bg-opacity-50"></div>

    <div class="hidden fixed w-64 md:flex h-full " id="sidebar">
        <button class="hidden absolute -left-8 top-2 " id="sidebar-close-icon">
            <i class="fa fa-close"></i>
        </button>
        <div class="bg-indigo-700 overflow-y-auto flex flex-col flex-grow text-white" id="sidebar-content-layout">
            <div class="px-4 my-6 flex items-center">
                <img class="w-16" src="/image/Artboard 2.svg" alt="">
                <h1 class="text-white text-xl">سرای من</h1>
            </div>
            <nav class="flex flex-col h-full justify-between px-4 space-y-1">
                <div class="">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 
       {{ request()->is('dashboard')
           ? 'bg-indigo-600 text-white shadow-md'
           : 'text-gray-400 hover:bg-indigo-500/10 hover:text-gray-300 hover:translate-x-0.5' }}">
                        <i class="fa-regular fa-home w-5 text-lg"></i>
                        <span class="text-sm font-medium">داشبورد</span>
                    </a>

                    <a href="{{ route('admin.reserve') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 
       {{ request()->is('admin/reserve**')
           ? 'bg-indigo-600 text-white shadow-md'
           : 'text-gray-400 hover:bg-indigo-500/10 hover:text-gray-300 hover:translate-x-0.5' }}">
                        <i class="fa-regular fa-file-lines w-5 text-lg"></i>
                        <span class="text-sm font-medium">رزرو ها</span>
                    </a>

                    <a href="{{ route('admin.accommodation') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 
       {{ request()->is('admin/accommodation**')
           ? 'bg-indigo-600 text-white shadow-md'
           : 'text-gray-400 hover:bg-indigo-500/10 hover:text-gray-300 hover:translate-x-0.5' }}">
                        <i class="fa-regular fa-building w-5 text-lg"></i>
                        <span class="text-sm font-medium">اقامتگاه ها</span>
                    </a>

                    <a href="{{ route('admin.cities.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 
       {{ request()->is('admin/cities**')
           ? 'bg-indigo-600 text-white shadow-md'
           : 'text-gray-400 hover:bg-indigo-500/10 hover:text-gray-300 hover:translate-x-0.5' }}">
                        <i class="fa fa-city w-5 text-lg"></i>
                        <span class="text-sm font-medium">شهر ها</span>
                    </a>

                    <a href="{{ route('admin.users') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 
       {{ request()->is('admin/users**')
           ? 'bg-indigo-600 text-white shadow-md'
           : 'text-gray-400 hover:bg-indigo-500/10 hover:text-gray-300 hover:translate-x-0.5' }}">
                        <i class="fa fa-users w-5 text-lg"></i>
                        <span class="text-sm font-medium">کاربران</span>
                    </a>

                    @php
                        $admin = Auth::guard('admin')->user();
                    @endphp

                    @if ($admin && $admin->role == 'super_admin')
                        <a href="{{ route('admin.admins') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 
    {{ request()->is('admin/admins*')
        ? 'bg-indigo-600 text-white shadow-md'
        : 'text-gray-400 hover:bg-indigo-500/10 hover:text-gray-300 hover:translate-x-0.5' }}">
                            <i class="fas fa-user-shield w-5 text-lg"></i>
                            <span class="text-sm font-medium">ادمین‌ها</span>
                        </a>
                    @endif

                    <a href="{{ route('admin.comments') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 
       {{ request()->is('admin/comments**')
           ? 'bg-indigo-600 text-white shadow-md'
           : 'text-gray-400 hover:bg-indigo-500/10 hover:text-gray-300 hover:translate-x-0.5' }}">
                        <i class="fa-regular fa-comments w-5 text-lg"></i>
                        <span class="text-sm font-medium">نظرات</span>
                    </a>

                    <a href="{{ route('admin.contacts.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 
       {{ request()->is('admin/contact**')
           ? 'bg-indigo-600 text-white shadow-md'
           : 'text-gray-400 hover:bg-indigo-500/10 hover:text-gray-300 hover:translate-x-0.5' }}">
                        <i class="fa-regular fa-envelope w-5 text-lg"></i>
                        <span class="text-sm font-medium">پیشنهادات</span>
                    </a>



                </div>
                <!-- فرم خروج از سیستم -->
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-auto pb-4">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 w-full text-gray-400 hover:bg-indigo-500/10 hover:text-gray-300 hover:translate-x-0.5">
                        <i class="fas fa-sign-out-alt w-5 text-lg"></i>
                        <span class="text-sm font-medium">خروج از سیستم</span>
                    </button>
                </form>
            </nav>
        </div>
    </div>


    <div class="flex flex-col md:pr-64">
        <div class="flex justify-between items-center shadow-md bg-white  h-16 px-4 md:sticky z-10 top-0">
            <div>
                <button class="text-gray-600 ml-4 md:hidden" id="sidebar-open-icon">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="w-full">
                <form action="" class="flex items-center w-full ">
                    <div class="text-gray-400">
                        <i class="fa fa-search"></i>
                    </div>
                    <input class="w-full h-14 pr-2 outline-none" type="text" placeholder="جستجو">
                </form>
            </div>
            <div class="flex items-center">
                <div class="text-gray-400 pl-4">
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="flex shrink-0">
                    <img class="w-8 h-8 rounded-full object-cover" src="/image/person.png" alt="profile">
                </div>

            </div>
        </div>

        <main class="px-10">
            <div class="max-w-7xl mx-auto py-4 ">
                @yield('Content')
            </div>
        </main>
    </div>
    


</body>

</html>
