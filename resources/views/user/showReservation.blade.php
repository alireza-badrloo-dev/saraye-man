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
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold text-gray-800">📄 جزئیات رزرو</h1>
            <a href="{{ route('user.reserve') }}" 
               class="text-orange-500 hover:text-orange-600 text-sm flex items-center gap-1">
                <i class="fas fa-arrow-right"></i>
                بازگشت به لیست
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- وضعیت -->
            <div class="p-6 border-b border-gray-100 flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500">وضعیت:</span>
                    @if ($reservation->status == 'confirmed')
                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                            <i class="fas fa-check-circle ml-1"></i> تایید شده
                        </span>
                    @elseif($reservation->status == 'pending')
                        <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">
                            <i class="fas fa-clock ml-1"></i> در انتظار
                        </span>
                    @elseif($reservation->status == 'cancelled')
                        <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-700">
                            <i class="fas fa-times-circle ml-1"></i> لغو شده
                        </span>
                    @elseif($reservation->status == 'completed')
                        <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-700">
                            <i class="fas fa-check-double ml-1"></i> تکمیل شده
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-700">
                            <i class="fas fa-question-circle ml-1"></i> نامشخص
                        </span>
                    @endif
                </div>

                @if($reservation->cancelled_at)
                    <span class="text-xs text-gray-400">
                        <i class="fas fa-clock ml-1"></i>
                        لغو در: {{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->cancelled_at)->format('Y/m/d H:i') }}
                    </span>
                @endif

                <div>
                    <p class="text-xs text-gray-400">کد پیگیری</p>
                    <p class="text-sm font-mono font-bold text-gray-700">{{ $reservation->tracking_code ?? 'نامشخص' }}</p>
                </div>
            </div>

            <div class="p-6">
                <!-- تصویر و اطلاعات اصلی -->
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- تصویر -->
                    <div class="md:w-64 h-48 md:h-auto">
                        @php
                            $images = is_string($reservation->accommodation->images)
                                ? json_decode($reservation->accommodation->images, true)
                                : $reservation->accommodation->images ?? [];
                            $firstImage = $images[0] ?? null;
                        @endphp
                        @if ($firstImage)
                            <img src="{{ asset('storage/uplouds/' . $firstImage) }}"
                                class="w-full h-full object-cover rounded-lg"
                                alt="{{ $reservation->accommodation->title }}">
                        @else
                            <div class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-5xl"></i>
                            </div>
                        @endif
                    </div>

                    <!-- اطلاعات اقامتگاه -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $reservation->accommodation->title }}</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-map-marker-alt ml-1 text-gray-400"></i>
                            {{ $reservation->accommodation->address }}
                        </p>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-city ml-1 text-gray-400"></i>
                            {{ $reservation->accommodation->city->name ?? 'نامشخص' }}
                        </p>

                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <p class="text-xs text-gray-400">اتاق</p>
                                <p class="text-sm font-medium">{{ $reservation->room->title ?? 'نامشخص' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <p class="text-xs text-gray-400">تعداد مهمان</p>
                                <p class="text-sm font-medium">{{ $reservation->guests }} نفر</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- اطلاعات تاریخ و قیمت -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 pt-6 border-t border-gray-100">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs text-gray-400">تاریخ ورود</p>
                        <p class="text-base font-medium text-gray-800">
                            <i class="fas fa-calendar-alt ml-2 text-orange-500"></i>
                            {{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->check_in)->format('Y/m/d') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            ساعت: ۱۴:۰۰ (قابل تغییر)
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs text-gray-400">تاریخ خروج</p>
                        <p class="text-base font-medium text-gray-800">
                            <i class="fas fa-calendar-alt ml-2 text-orange-500"></i>
                            {{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->check_out)->format('Y/m/d') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            ساعت: ۱۲:۰۰ (قابل تغییر)
                        </p>
                    </div>
                </div>

                <!-- جزئیات مالی -->
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="text-base font-semibold text-gray-800 mb-4">💳 جزئیات مالی</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs text-gray-400">قیمت هر شب</p>
                            <p class="text-base font-medium text-gray-800">
                                {{ number_format($reservation->price_per_night) }} تومان
                            </p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs text-gray-400">تعداد شب</p>
                            <p class="text-base font-medium text-gray-800">{{ $reservation->nights }} شب</p>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-4 border border-orange-200">
                            <p class="text-xs text-gray-400">مبلغ کل</p>
                            <p class="text-xl font-bold text-orange-500">
                                {{ number_format($reservation->total_price) }} تومان
                            </p>
                        </div>
                    </div>
                </div>

                <!-- همراهان -->
                @if(isset($reservation->companions) && $reservation->companions->count() > 0)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h3 class="text-base font-semibold text-gray-800 mb-4">👥 همراهان</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-right text-sm text-gray-600">#</th>
                                        <th class="px-4 py-2 text-right text-sm text-gray-600">نام و نام خانوادگی</th>
                                        <th class="px-4 py-2 text-right text-sm text-gray-600">کد ملی</th>
                                        <th class="px-4 py-2 text-right text-sm text-gray-600">شماره تماس</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservation->companions as $index => $companion)
                                        <tr class="border-b">
                                            <td class="px-4 py-2 text-sm">{{ $index + 1 }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $companion->full_name }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $companion->national_code ?? '-' }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $companion->phone ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- یادداشت‌ها -->
                @if($reservation->notes)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h3 class="text-base font-semibold text-gray-800 mb-2">📝 یادداشت</h3>
                        <p class="text-sm text-gray-600 bg-gray-50 p-4 rounded-lg">
                            {{ $reservation->notes }}
                        </p>
                    </div>
                @endif

                <!-- دکمه‌های عملیات -->
                <div class="mt-6 pt-6 border-t border-gray-100 flex flex-wrap gap-3">
                    @if ($reservation->status != 'cancelled' && $reservation->status != 'completed')
                        <form action="{{ route('user.reserve.cancel', $reservation->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-6 py-2.5 rounded-lg text-sm transition flex items-center gap-2"
                                onclick="return confirm('آیا از لغو این رزرو مطمئن هستید؟')">
                                <i class="fas fa-times"></i>
                                لغو رزرو
                            </button>
                        </form>
                    @elseif($reservation->status == 'cancelled')
                        <span class="bg-red-100 text-red-700 px-6 py-2.5 rounded-lg text-sm flex items-center gap-2">
                            <i class="fas fa-times-circle"></i>
                            این رزرو لغو شده است
                        </span>
                    @elseif($reservation->status == 'completed')
                        <span class="bg-blue-100 text-blue-700 px-6 py-2.5 rounded-lg text-sm flex items-center gap-2">
                            <i class="fas fa-check-double"></i>
                            این رزرو به پایان رسیده است
                        </span>
                    @endif

                    <a href="{{ route('user.reserve') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2.5 rounded-lg text-sm transition flex items-center gap-2">
                        <i class="fas fa-arrow-right"></i>
                        بازگشت
                    </a>

                    @if($reservation->status == 'pending')
                        <a href="{{ route('payment.index', $reservation->id) }}"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2.5 rounded-lg text-sm transition flex items-center gap-2">
                            <i class="fas fa-credit-card"></i>
                            پرداخت
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection