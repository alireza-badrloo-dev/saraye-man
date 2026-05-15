<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="bg-slate-100" dir="rtl">
    <div class="w-full sm:w-2/3 lg:w-1/3 m-auto flex  h-svh items-center justify-center">
        <div class="w-full bg-white shadow-xl rounded-md p-4">
            <div class="px-4 py-8">
                <h1 class="text-2xl text-gray-800 text-center">
                    ورود / ثبت نام
                </h1>

                <form action="{{ route('user.login') }}" method="POST" class="mt-10 ">
                    @csrf

                    <label for="email" class="text-gray-500 text-sm">پست الکترونیکی</label>
                    <input name="email" type="text"
                        class="w-full border my-2 border-gray-300 ring-0 ring-gray-300 hover:ring-1 p-2 rounded-md">
                    <p class="error-text text-red-500 text-sm" data-error="email"></p>
                    @error('email')
                        <div class="text-xs text-red-600 mb-2">{{ $message }}</div>
                    @enderror

                    <label for="password" class="text-gray-500 text-sm">رمزعبور</label>
                    <input name="password" type="password"
                        class="w-full border my-2 border-gray-300 ring-0 ring-gray-300 hover:ring-1 p-2 rounded-md">
                    <p class="error-text text-red-500 text-sm" data-error="password"></p>
                    @error('password')
                        <div class="text-xs text-red-600 mb-2">{{ $message }}</div>
                    @enderror


                    <button type="submit" name="submit"
                        class="p-2 bg-orange-500 text-base w-full rounded-lg mt-8 text-white hover:bg-orange-600">
                        ورود
                    </button>

                    <a href="{{ route('user.register.show') }}"
                        class="mt-4 text-orange-500 text-base w-full text-center block">
                        ثبت نام
                    </a>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
