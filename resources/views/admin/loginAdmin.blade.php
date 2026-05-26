<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود به پنل مدیریت</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="bg-slate-100" dir="rtl">
    <div class="w-full sm:w-2/3 lg:w-1/3 m-auto flex h-svh items-center justify-center">
        <div class="w-full bg-white shadow-xl rounded-md p-4">
            <div class="px-4 py-8">
                <div class="text-center mb-4">
                    <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-shield text-white text-2xl"></i>
                    </div>
                    <h1 class="text-2xl text-gray-800 text-center">
                        ورود به پنل مدیریت
                    </h1>
                    <p class="text-gray-500 text-sm mt-2">لطفاً اطلاعات خود را وارد کنید</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST" class="mt-10">
                    @csrf

                    <label for="email" class="text-gray-500 text-sm">پست الکترونیکی</label>
                    <input name="email" type="email" value="{{ old('email') }}"
                        class="w-full border my-2 border-gray-300 ring-0 ring-gray-300 hover:ring-1 focus:ring-1 focus:ring-indigo-500 p-2 rounded-md">
                    <p class="error-text text-red-500 text-sm" data-error="email"></p>

                    <label for="password" class="text-gray-500 text-sm">رمزعبور</label>
                    <input name="password" type="password"
                        class="w-full border my-2 border-gray-300 ring-0 ring-gray-300 hover:ring-1 focus:ring-1 focus:ring-indigo-500 p-2 rounded-md">
                    <p class="error-text text-red-500 text-sm" data-error="password"></p>

                    <div class="flex items-center justify-between my-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="mr-2 text-sm text-gray-600">مرا به خاطر بسپار</span>
                        </label>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">
                            فراموشی رمز عبور؟
                        </a>
                    </div>

                    <button type="submit"
                        class="p-2 bg-indigo-600 text-base w-full rounded-lg mt-4 text-white hover:bg-indigo-700 transition">
                        ورود به پنل مدیریت
                    </button>

                    <div class="mt-6 text-center">
                        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700">
                            <i class="fas fa-arrow-right ml-1"></i>
                            بازگشت به سایت اصلی
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>