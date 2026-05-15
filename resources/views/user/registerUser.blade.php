<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ثبت نام</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="bg-slate-100" dir="rtl">
    <div class="w-full sm:w-2/3 lg:w-1/3 m-auto flex  h-svh items-center justify-center">
        <div class="w-full bg-white shadow-xl rounded-md p-4">
            <div class="px-4 py-8">
                <h1 class="text-2xl text-gray-800 text-center">
                    ورود / ثبت نام
                </h1>

                {{-- فرم ثبت نام --}}
                <form action="{{ route('user.register') }}" method="POST" class="mt-10">
                    @csrf

                    <div class="grid grid-cols-2 gap-4  ">
                        <div>
                            <label for="first_name" class="text-gray-500 text-sm">نام</label>
                            <input name="first_name" type="text"
                                class="w-full border my-2 border-gray-300 ring-0 ring-gray-300 hover:ring-1 p-2 rounded-md">
                            @error('first_name')
                                <div class="text-xs text-red-600 mb-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="last-name" class="text-gray-500 text-sm">نام خانوادگی</label>
                            <input name="last_name" type="text"
                                class="w-full border my-2 border-gray-300 ring-0 ring-gray-300 hover:ring-1 p-2 rounded-md">
                            @error('last_name')
                                <div class="text-xs text-red-600 mb-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <label for="email" class="text-gray-500 text-sm">پست الکترونیکی</label>
                    <input name="email" type="text"
                        class="w-full border my-2 border-gray-300 ring-0 ring-gray-300 hover:ring-1 p-2 rounded-md">
                    @error('email')
                        <div class="text-xs text-red-600 mb-2">{{ $message }}</div>
                    @enderror

                    <label for="password" class="text-gray-500 text-sm ">رمزعبور</label>
                    <input name="password" type="password"
                        class="w-full border my-2 border-gray-300 ring-0 ring-gray-300 hover:ring-1 p-2 rounded-md">
                    @error('password')
                        <div class="text-xs text-red-600 mb-2">{{ $message }}</div>
                    @enderror

                    <label for="mobile" class="text-gray-500 text-sm">شماره تلفن</label>
                    <input name="mobile" type="text"
                        class="w-full border my-2 border-gray-300 ring-0 ring-gray-300 hover:ring-1 p-2 rounded-md">
                    @error('mobile')
                        <div class="text-xs text-red-600 mb-2">{{ $message }}</div>
                    @enderror

                    <button name="submit" type="submit"
                        class="p-2 bg-orange-500 text-base w-full rounded-lg mt-8 text-white hover:bg-orange-600">
                        ثبت نام
                    </button>

                    <a href="{{ route('user.login.show') }}" class="mt-4 text-orange-500 text-base w-full text-center block">
                        ورود
                    </a>
                </form>

                
               

            </div>
        </div>
    </div>
</body>

</html>
