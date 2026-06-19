@extends('user.Layouts.master')
@section('Mycontent')
<div class="mx-4 md:mx-20 xl:mx-40 my-8">
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

    <!-- نمایش خطاهای اعتبارسنجی -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
            <div class="flex items-center gap-2 mb-2">
                <i class="fas fa-exclamation-triangle"></i>
                <strong class="font-bold">خطا!</strong>
                <span class="text-sm">لطفاً خطاهای زیر را بررسی کنید:</span>
            </div>
            <ul class="list-disc list-inside text-sm space-y-1 mr-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-orange-600 to-orange-500 px-6 py-5">
            <h1 class="text-2xl font-bold text-white">تکمیل اطلاعات رزرو</h1>
            <p class="text-orange-100 text-sm mt-1">{{ $room->accommodation->title }} - {{ $room->title }}</p>
        </div>

        <div class="p-6">
            <form action="{{ route('user.reserve.store') }}" method="POST" id="reservationForm">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">

                <!-- تاریخ ورود و خروج با تقویم شمسی -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">تاریخ ورود <span class="text-red-500">*</span></label>
                        <input type="text" name="check_in" id="check_in" data-jdp data-jdp-min-date="today"
                            placeholder="۱۴۰۳/۰۱/۰۱" value="{{ old('check_in') }}"
                            class="border-2 border-orange-200 rounded-xl px-4 py-3 w-full focus:border-orange-500 focus:ring-2 focus:ring-orange-200 bg-white @error('check_in') border-red-500 @enderror"
                            autocomplete="off" required>
                        @error('check_in')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">تاریخ خروج <span class="text-red-500">*</span></label>
                        <input type="text" name="check_out" id="check_out" data-jdp data-jdp-min-date="today"
                            placeholder="۱۴۰۳/۰۱/۰۱" value="{{ old('check_out') }}"
                            class="border-2 border-orange-200 rounded-xl px-4 py-3 w-full focus:border-orange-500 focus:ring-2 focus:ring-orange-200 bg-white @error('check_out') border-red-500 @enderror"
                            autocomplete="off" required>
                        @error('check_out')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- تعداد مهمان و قیمت -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <i class="fas fa-users text-orange-500 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-600 mb-1">تعداد مهمان</p>
                        <input type="number" name="guests" id="guests" min="1" max="{{ $room->capacity }}"
                            value="{{ old('guests', 1) }}"
                            class="w-full text-center text-xl font-bold text-orange-600 bg-transparent border-2 border-orange-200 rounded-lg py-2 @error('guests') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">حداکثر ظرفیت: {{ $room->capacity }} نفر</p>
                        @error('guests')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <i class="fas fa-tag text-orange-500 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-600 mb-1">قیمت هر شب</p>
                        <p class="text-xl font-bold text-gray-800">{{ number_format($room->price) }} <span class="text-sm">تومان</span></p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 text-center" id="totalPriceBox">
                        <i class="fas fa-receipt text-orange-500 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-600 mb-1">قیمت کل</p>
                        <p class="text-2xl font-bold text-orange-600">--- تومان</p>
                    </div>
                </div>

                <!-- اطلاعات تماس -->
                <div class="mt-8 border-t pt-6">
                    <h3 class="font-bold text-gray-800 text-lg mb-4">اطلاعات تماس</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">نام و نام خانوادگی <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name"
                                value="{{ old('full_name', Auth::user()->first_name . ' ' . Auth::user()->last_name) }}"
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500 @error('full_name') border-red-500 @enderror">
                            @error('full_name')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">شماره تماس <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->mobile) }}"
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500 @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ایمیل <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- اطلاعات همراهان (پویا بر اساس ظرفیت اتاق) -->
                <div class="border-t pt-6 mt-6">
                    <h3 class="font-bold text-gray-800 text-lg mb-3">اطلاعات همراهان</h3>
                    <p class="text-xs text-gray-500 mb-4">(به غیر از خودتان، اطلاعات همراهان را وارد کنید)</p>
                    
                    <div id="companions-container">
                        @for($i = 1; $i <= $room->capacity - 1; $i++)
                        <div class="companion-item border-b border-gray-100 pb-4 mb-4 last:border-0">
                            <p class="text-sm font-medium text-orange-600 mb-3">همراه {{ $i }}</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">نام و نام خانوادگی همراه</label>
                                    <input type="text" name="companions[{{ $i }}][full_name]" 
                                           value="{{ old('companions.' . $i . '.full_name') }}" 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500 @error('companions.' . $i . '.full_name') border-red-500 @enderror">
                                    @error('companions.' . $i . '.full_name')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">کد ملی همراه</label>
                                    <input type="text" name="companions[{{ $i }}][national_code]" 
                                           value="{{ old('companions.' . $i . '.national_code') }}" 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500 @error('companions.' . $i . '.national_code') border-red-500 @enderror">
                                    @error('companions.' . $i . '.national_code')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">شماره تماس همراه</label>
                                    <input type="tel" name="companions[{{ $i }}][phone]" 
                                           value="{{ old('companions.' . $i . '.phone') }}" 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500 @error('companions.' . $i . '.phone') border-red-500 @enderror">
                                    @error('companions.' . $i . '.phone')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    
                    @if($room->capacity > 1)
                        <p class="text-xs text-gray-400 mt-2">تعداد کل مهمانان شامل خود شما و {{ $room->capacity - 1 }} همراه می‌باشد.</p>
                    @endif
                </div>

                <!-- درخواست ویژه -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">درخواست ویژه</label>
                    <textarea name="special_request" rows="3" 
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500 @error('special_request') border-red-500 @enderror"
                        placeholder="درخواست خاصی دارید؟">{{ old('special_request') }}</textarea>
                    @error('special_request')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-8 flex justify-between gap-3">
                    <a href="{{ url()->previous() }}"
                        class="px-8 py-3 border-2 border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition">بازگشت</a>
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-orange-600 to-orange-500 text-white rounded-xl hover:from-orange-700 hover:to-orange-600 transition shadow-lg">ادامه
                        و پرداخت</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">

<script>
    // تنظیمات تقویم شمسی
    jalaliDatepicker.startWatch({
        minDate: "attr",
        maxDate: "today",
        hideAfterChange: true,
        persianDigits: true,
        autoShow: true,
        useDropDownYears: true
    });

    // محاسبه قیمت کل
    function calculateTotal() {
        const checkIn = document.getElementById('check_in').value;
        const checkOut = document.getElementById('check_out').value;
        const price = {{ $room->price }};

        if (checkIn && checkOut) {
            const inParts = checkIn.split('/').map(Number);
            const outParts = checkOut.split('/').map(Number);
            
            const inDate = new Date(inParts[0], inParts[1] - 1, inParts[2]);
            const outDate = new Date(outParts[0], outParts[1] - 1, outParts[2]);
            
            const diffTime = Math.abs(outDate - inDate);
            const nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (nights > 0 && !isNaN(nights)) {
                const total = price * nights;
                document.getElementById('totalPriceBox').innerHTML = `
                    <i class="fas fa-receipt text-orange-500 text-2xl mb-2"></i>
                    <p class="text-sm text-gray-600 mb-1">قیمت کل (${nights} شب)</p>
                    <p class="text-2xl font-bold text-orange-600">${total.toLocaleString()} <span class="text-sm">تومان</span></p>
                `;
            }
        }
    }

    // اضافه کردن رویدادها
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');

    if (checkInInput) {
        checkInInput.addEventListener('change', calculateTotal);
    }
    if (checkOutInput) {
        checkOutInput.addEventListener('change', calculateTotal);
    }

    // وقتی تاریخ ورود تغییر کرد، تاریخ خروج رو محدود کن
    if (checkInInput && checkOutInput) {
        checkInInput.addEventListener('change', function() {
            const checkInValue = this.value;
            if (checkInValue) {
                checkOutInput.setAttribute('data-jdp-min-date', checkInValue);
                if (checkOutInput.value && checkOutInput.value < checkInValue) {
                    checkOutInput.value = '';
                    calculateTotal();
                }
            }
        });
    }

    // محاسبه اولیه اگر مقادیری وجود داشته باشد
    calculateTotal();
</script>
@endsection