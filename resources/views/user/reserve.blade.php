@extends('user.dashboard')
@section('baseContent')
    <div class="w-full p-4">
        <div class="w-full flex justify-between items-center mb-8">
            <h1 class="text-xl text-gray-800">رزرو های من</h1>
            <div class="relative flex items-center ">
                <input type="text"
                    class=" border border-s-gray-200 hover:ring-1 ring-gray-200  text-xs  py-2 pe-10 ps-2 w-full rounded-md  "
                    placeholder="کد پیگیری را وارد کنید">
                <img src="/icons/svgexport-2.svg" alt="" class="absolute left-2">
            </div>
        </div>
        <div class="w-full flex">
            <a class="text-xs text-gray-800 me-4" href="">سفر های جاری</a>
            <a class="text-xs text-gray-800 me-4" href="">سفر های گذشته</a>
            <a class="text-xs text-gray-800 me-4" href="">رزرو های منقضی شده</a>
        </div>
        <hr class="text-gray-300 w-full my-3">
        <div class="text-red-500 text-sm p-1 bg-red-50 border border-red-500 rounded-lg">فعلا رزروی انجام ندادید</div>
    </div>
@endsection
