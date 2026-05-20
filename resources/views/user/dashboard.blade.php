@extends('user.Layouts.master')
@section('Mycontent')
    <div class=" mx-1  md:mx-20 xl:mx-40 relative my-12">
        <div class="grid grid-cols-12 lg:gap-16">
            <div class=" col-span-full p-4 md:p-0 md:col-span-3 ">
                <div class="w-full border p-4 border-gray-300 rounded-xl flex items-center justify-start mb-4">
                    <div class="me-4">
                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="18" viewBox="0 0 24 18"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.5 6.287a6.93 6.93 0 0 0-3.577-3.7 6.669 6.669 0 0 0-3.943-.477 7.452 7.452 0 0 0-3.502 1.728 7.31 7.31 0 0 0-1.461 1.841l-.009.017a6.7 6.7 0 0 0-.32.653L3 15.957h.004L3 15.964c.44 0 5.453.006 6.87.01 1.673.057 3.349.02 5.018-.108a6.987 6.987 0 0 0 4.267-2.06 6.615 6.615 0 0 0 1.663-3.265 7.202 7.202 0 0 0-.317-4.246l-.002-.008Zm-3.16 3.889a3.39 3.39 0 0 1-.805 1.31 3.337 3.337 0 0 1-1.296.813c-.667.22-1.38.246-2.061.075-.68-.17-1.3-.53-1.788-1.04a3.477 3.477 0 0 1-.711-3.033 3.683 3.683 0 0 1 1.008-1.762 3.613 3.613 0 0 1 1.78-.948 3.332 3.332 0 0 1 2.124.237c.664.31 1.21.83 1.557 1.483a3.764 3.764 0 0 1 .195 2.866l-.003-.001Z"
                                stroke="#333333" stroke-width="1.5px" fill="none"></path>
                        </svg>
                    </div>
                    <div class="space-y-2 text-gray-800">
                        <p class="text-sm">{{auth()->user()->first_name}} {{ auth()->user()->last_name }} </p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->mobile }} </p>
                    </div>

                </div>



                <div class=" w-full flex flex-col  py-3 border border-gray-300 rounded-xl">
                    <a href="{{ route('user.profile')}}" 
                        class=" {{ request()->is('user/profile') || request()->is('user/profile/*') ? 'border-e-2  border-e-orange-500 text-orange-500 bg-orange-50 px-4' : 'hover:bg-orange-50 cursor-pointer hover:text-orange-500  text-gray-800 transition duration-300 w-full  px-4' }}  ">
                        <div class="py-4 flex items-center justify-start">
                            <div class="me-4">
                                {{-- <svg xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 10.75a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z" stroke="#333333"
                                        stroke-width="1.5px" stroke-miterlimit="10" fill="none"></path>
                                    <path
                                        d="M6.5 19.704c0-3.012 2.488-5.454 5.5-5.454s5.5 2.442 5.5 5.454a.545.545 0 0 1-.546.546H7.045a.545.545 0 0 1-.545-.546Z"
                                        stroke="#333333" stroke-width="1.5px" fill="none"></path>
                                </svg> --}}
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <div>
                                <p class="  text-sm w-full ">اطلاعات کاربری</p>
                                <p class="text-gray-500 text-xs mt-2">اطلاعات شخصی بانکی بانکی و رمزعبور</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('user.reserve') }}"
                        class="{{ request()->is('user/reservation') ? 'border-e-2 border-e-orange-500 text-orange-500 bg-orange-50 px-4' : 'hover:bg-orange-50 cursor-pointer hover:text-orange-500  text-gray-800 transition duration-300 w-full  px-4' }} ">
                        <div class="py-4 flex items-center justify-start">
                            <div class="me-4">
                                <i class="fa-regular fa-file-lines"></i>
                               
                            </div>
                            <div>
                                <p class="  text-sm w-full ">رزرو های من</p>
                                <p class="text-gray-500 text-xs mt-2">وضعیت، تاییدیه و تاریخچه رزرو ها</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('user.comment') }}"
                        class="{{ request()->is('user/comment') ? 'border-e-2 border-e-orange-500 text-orange-500 bg-orange-50 px-4' : 'hover:bg-orange-50 cursor-pointer hover:text-orange-500  text-gray-800 transition duration-300 w-full  px-4' }}  ">
                        <div class="py-4 flex items-center justify-start">
                            <div class="me-4">
                               <i class="fa-regular fa-comments"></i>
                            </div>
                            <div>
                                <p class="  text-sm w-full " href="">دیدگاه</p>
                                <p class="text-gray-500 text-xs mt-2">امتیاز، نظرات و پرسش ها</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('user.favourite') }}"
                        class="{{ request()->is('user/favourites') ? 'border-e-2 border-e-orange-500 text-orange-500 bg-orange-50 px-4' : 'hover:bg-orange-50 cursor-pointer hover:text-orange-500  text-gray-800 transition duration-300 w-full  px-4' }}">
                        <div class="py-4 flex items-center justify-start">
                            <div class="me-4">
                               <i class="fa-regular fa-heart"></i>
                            </div>
                            <div>
                                <p class="  text-sm w-full " href="">علاقه مندی ها</p>
                                <p class="text-gray-500 text-xs mt-2">هتل های نشان شده</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('user.logout') }}"
                        class="hover:bg-orange-50 cursor-pointer hover:text-orange-500 transition duration-300 w-full  px-4  ">
                        <div class="py-4 flex items-center justify-start">
                            <div class="me-4">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </div>
                            <div>
                                <p class="  text-sm w-full " href="">خروج</p>
                                <p class="text-gray-500 text-xs mt-2"></p>
                            </div>
                        </div>
                    </a>



                </div>
            </div>
            <div class="col-span-full md:col-span-9 " id="item">
                @yield('baseContent')
            </div>


        </div>
    </div>
@endsection
