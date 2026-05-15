@extends('user.dashboard')
@section('baseContent')
    @session('success')
        <div class="w-full p-2 mb-4 bg-green-100 border border-green-500 text-green-500 rounded-lg">{{ $value }}</div>
    @endsession
    <div class="border border-gray-300 rounded-lg p-4">
        <div class="flex justify-between items-center w-full mb-8">
            <div>
                <h1 class="text-gray-800  text-xl">اطلاعات کاربری</h1>
            </div>
            <div
                class="px-2 py-1 border border-orange-500 text-orange-500 rounded-md hover:bg-orange-100 cursor-pointer flex items-center">
                <a class="text-sm" href="{{ route('user.edit', auth()->user()->id) }}">ویرایش</a>
                <svg xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" width="22"
                    height="22" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8 3C5.23858 3 3 5.23858 3 8V16.0021C3 18.7635 5.23858 21.0021 8 21.0021H16.0021C18.7635 21.0021 21.0021 18.7635 21.0021 16.0021V13C21.0021 12.4477 20.5544 12 20.0021 12C19.4498 12 19.0021 12.4477 19.0021 13V16.0021C19.0021 17.6589 17.6589 19.0021 16.0021 19.0021H8C6.34315 19.0021 5 17.6589 5 16.0021V8C5 6.34315 6.34315 5 8 5H11C11.5523 5 12 4.55228 12 4C12 3.44772 11.5523 3 11 3H8ZM20.0149 3.98484C18.7018 2.67172 16.5728 2.67172 15.2596 3.98484L14.2964 4.94804L10.1304 9.11405C9.13942 10.1051 8.47721 11.3769 8.23365 12.7571L8.02764 13.9245C7.81442 15.1327 8.86699 16.1853 10.0752 15.9721L11.2426 15.7661C12.6228 15.5225 13.8947 14.8603 14.8857 13.8693L19.0517 9.70329L20.0149 8.74009C21.328 7.42696 21.328 5.29797 20.0149 3.98484ZM16.6738 5.39906C17.2059 4.86698 18.0686 4.86698 18.6007 5.39906C19.1327 5.93113 19.1327 6.7938 18.6007 7.32587L18.3446 7.58197L16.4178 5.65515L16.6738 5.39906ZM15.0035 7.06936L16.9304 8.99618L13.4715 12.4551C12.7706 13.1559 11.8711 13.6243 10.895 13.7965L10.055 13.9448L10.2032 13.1047C10.3755 12.1286 10.8438 11.2291 11.5446 10.5283L15.0035 7.06936Z"
                        fill="#f97316"></path>
                </svg>
            </div>
        </div>
        <div class="p-4">

            <p class="text-base text-gray-800 ">حساب کاربری</p>
            <div class="grid grid-cols-2 p-6 ">
                <div class="col-span-1 space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-2">نام</p>
                        @if (auth()->user()->first_name)
                            <p class="text-xs text-gray-800">{{ auth()->user()->first_name }}</p>
                        @else
                            <p class="text-xs text-gray-800">-</p>
                        @endif

                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-2">ملیت</p>
                        @if (auth()->user()->nationality)
                            <p class="text-xs text-gray-800">{{ auth()->user()->nationality }}</p>
                        @else
                            <p class="text-xs text-gray-800">-</p>
                        @endif

                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-2">کد ملی</p>
                        @if (auth()->user()->national_id)
                            <p class="text-xs text-gray-800">{{ auth()->user()->national_id }}</p>
                        @else
                            <p class="text-xs text-gray-800">-</p>
                        @endif

                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-2">کد پستی</p>
                        @if (auth()->user()->postal_code)
                            <p class="text-xs text-gray-800">{{ auth()->user()->postal_code }}</p>
                        @else
                            <p class="text-xs text-gray-800">-</p>
                        @endif

                    </div>
                </div>
                <div class="col-span-1 space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-2">نام خانوادگی</p>
                        @if (auth()->user()->last_name)
                            <p class="text-xs text-gray-800">{{ auth()->user()->last_name }}</p>
                        @else
                            <p class="text-xs text-gray-800">-</p>
                        @endif

                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-2">جنسیت</p>
                        @if (auth()->user()->gender)
                            <p class="text-xs text-gray-800">{{ auth()->user()->gender }}</p>
                        @else
                            <p class="text-xs text-gray-800">-</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-2">تاریخ تولد</p>
                        @if (auth()->user()->birth_date)
                            <p class="text-xs text-gray-800">{{ auth()->user()->birth_date }}</p>
                        @else
                            <p class="text-xs text-gray-800">-</p>
                            
                        @endif
                        
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-2">آدرس</p>
                        @if (auth()->user()->address)
                        <p class="text-xs text-gray-800">{{ auth()->user()->address }}</p>
                            
                        @else
                        <p class="text-xs text-gray-800">-</p>
                            
                        @endif
                    </div>
                </div>

            </div>

        </div>

        <div class="p-4">

            <p class="text-base text-gray-800 mt-6"> راه های ارتباطی</p>
            <div class="grid grid-cols-2 p-6 ">
                <div class="col-span-1 space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-2">شماره همراه</p>
                        <p class="text-xs text-gray-800">{{ auth()->user()->mobile }}</p>
                    </div>

                </div>
                <div class="col-span-1 space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-2">پست الکترونیکی</p>
                        <p class="text-xs text-gray-800">{{ auth()->user()->email }}</p>
                    </div>

                </div>
            </div>
        </div>




    </div>
@endsection
