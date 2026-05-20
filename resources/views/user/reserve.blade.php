@extends('user.dashboard')
@section('baseContent')
    <!-- نمایش پیام موفقیت -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- نمایش پیام خطا -->
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="w-full p-4">
        <div class="w-full flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <h1 class="text-xl font-bold text-gray-800">رزرو های من</h1>
            <div class="relative w-full sm:w-64">
                <input type="text"
                    class="border border-gray-200 focus:ring-1 focus:ring-orange-500 text-sm py-2 pe-10 ps-3 w-full rounded-lg"
                    placeholder="کد پیگیری را وارد کنید">
                <img src="/icons/svgexport-2.svg" alt="" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4">
            </div>
        </div>

        <div class="w-full flex flex-wrap gap-4 border-b border-gray-200 pb-3">
            <a href="#"
                class="text-sm text-gray-600 hover:text-orange-500 pb-2 border-b-2 border-transparent hover:border-orange-500 transition">سفر
                های جاری</a>
            <a href="#"
                class="text-sm text-gray-600 hover:text-orange-500 pb-2 border-b-2 border-transparent hover:border-orange-500 transition">سفر
                های گذشته</a>
            <a href="#"
                class="text-sm text-gray-600 hover:text-orange-500 pb-2 border-b-2 border-transparent hover:border-orange-500 transition">رزرو
                های منقضی شده</a>
        </div>

        @if (isset($reservations) && $reservations->count() > 0)
            <div class="mt-6 space-y-4">
                @foreach ($reservations as $reservation)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition border border-gray-100">
                        <div class="flex flex-col md:flex-row">
                            <!-- تصویر اقامتگاه -->
                            <div class="md:w-48 h-48 md:h-auto">
                                @php
                                    $images = is_string($reservation->accommodation->images)
                                        ? json_decode($reservation->accommodation->images, true)
                                        : $reservation->accommodation->images ?? [];
                                    $firstImage = $images[0] ?? null;
                                @endphp
                                @if ($firstImage)
                                    <img src="{{ asset('storage/uplouds/' . $firstImage) }}"
                                        class="w-full h-full object-cover" alt="{{ $reservation->accommodation->title }}">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- اطلاعات رزرو -->
                            <div class="flex-1 p-5">
                                <div class="flex flex-col sm:flex-row justify-between items-start gap-3">
                                    <div>
                                        <h2 class="text-lg font-bold text-gray-800">{{ $reservation->accommodation->title }}
                                        </h2>
                                        <p class="text-sm text-gray-500 mt-1">{{ $reservation->accommodation->address }}</p>
                                        <p class="text-sm text-gray-600 mt-2">
                                            <i class="fas fa-bed ml-1 text-gray-400"></i> اتاق:
                                            {{ $reservation->room->title ?? 'نامشخص' }}
                                        </p>
                                    </div>
                                    <<div class="text-left">
                                        @if ($reservation->status == 'confirmed')
                                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                                <i class="fas fa-check-circle ml-1"></i> تایید شده
                                            </span>
                                        @elseif($reservation->status == 'pending')
                                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                                <i class="fas fa-clock ml-1"></i> در انتظار پرداخت
                                            </span>
                                        @elseif($reservation->status == 'cancelled')
                                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                                <i class="fas fa-times-circle ml-1"></i> لغو شده
                                            </span>
                                        @elseif($reservation->status == 'completed')
                                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                                <i class="fas fa-check-double ml-1"></i> تکمیل شده
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                                <i class="fas fa-question-circle ml-1"></i> نامشخص
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4 pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-400">تاریخ ورود</p>
                                    <p class="text-sm font-medium text-gray-700">
                                        {{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->check_in)->format('Y/m/d') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">تاریخ خروج</p>
                                    <p class="text-sm font-medium text-gray-700">
                                        {{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->check_out)->format('Y/m/d') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">تعداد شب</p>
                                    <p class="text-sm font-medium text-gray-700">{{ $reservation->nights }} شب</p>
                                </div>
                            </div>

                            <div
                                class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4 pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-400">کد پیگیری</p>
                                    <p class="text-sm font-mono text-gray-600">
                                        {{ $reservation->tracking_code ?? 'نامشخص' }}</p>
                                </div>
                                <div class="text-left sm:text-right mt-3 sm:mt-0">
                                    <p class="text-xs text-gray-400">مبلغ پرداختی</p>
                                    <p class="text-xl font-bold text-orange-500">
                                        {{ number_format($reservation->total_price) }} <span class="text-sm">تومان</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if (method_exists($reservations, 'links'))
        <div class="mt-6">
            {{ $reservations->links() }}
        </div>
    @endif
@else
    <div class="text-center py-12 mt-6  ">
        <i class="fa-regular fa-calendar-xmark text-gray-300 text-6xl mb-4"></i>
        <p class="text-gray-500 text-lg">فعلا رزروی انجام ندادید</p>
        <p class="text-gray-400 text-sm mt-2">برای رزرو اقامتگاه، به صفحه اقامتگاه‌ها بروید</p>
        <a href="{{ route('home') }}"
            class="inline-block mt-4 bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
            مشاهده اقامتگاه‌ها
        </a>
    </div>
    @endif
    </div>
@endsection
