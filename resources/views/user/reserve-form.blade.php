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
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-orange-600 to-orange-500 px-6 py-5">
                <h1 class="text-2xl font-bold text-white">تکمیل اطلاعات رزرو</h1>
                <p class="text-orange-100 text-sm mt-1">{{ $room->accommodation->title }} - {{ $room->title }}</p>
            </div>

            <div class="p-6">
                <form action="{{ route('user.reserve.store') }}" method="POST" id="reservationForm">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    <!-- تاریخ ورود و خروج با select شمسی -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- تاریخ ورود -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">تاریخ ورود <span
                                    class="text-red-500">*</span></label>
                            <div class="grid grid-cols-3 gap-2">
                                <select name="check_in_year" id="check_in_year"
                                    class="border-2 border-orange-200 rounded-xl px-3 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                                    required>
                                    <option value="">سال</option>
                                    @for ($i = 1403; $i <= 1410; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="check_in_month" id="check_in_month"
                                    class="border-2 border-orange-200 rounded-xl px-3 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                                    required>
                                    <option value="">ماه</option>
                                    @foreach (['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'] as $key => $month)
                                        <option value="{{ $key + 1 }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select name="check_in_day" id="check_in_day"
                                    class="border-2 border-orange-200 rounded-xl px-3 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                                    required>
                                    <option value="">روز</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- تاریخ خروج -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">تاریخ خروج <span
                                    class="text-red-500">*</span></label>
                            <div class="grid grid-cols-3 gap-2">
                                <select name="check_out_year" id="check_out_year"
                                    class="border-2 border-orange-200 rounded-xl px-3 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                                    required>
                                    <option value="">سال</option>
                                    @for ($i = 1403; $i <= 1411; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="check_out_month" id="check_out_month"
                                    class="border-2 border-orange-200 rounded-xl px-3 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                                    required>
                                    <option value="">ماه</option>
                                    @foreach (['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'] as $key => $month)
                                        <option value="{{ $key + 1 }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select name="check_out_day" id="check_out_day"
                                    class="border-2 border-orange-200 rounded-xl px-3 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                                    required>
                                    <option value="">روز</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- تعداد مهمان و قیمت -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <i class="fas fa-users text-orange-500 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-600 mb-1">تعداد مهمان</p>
                            <input type="number" name="guests" id="guests" min="1" max="{{ $room->capacity }}"
                                value="1"
                                class="w-full text-center text-xl font-bold text-orange-600 bg-transparent border-2 border-orange-200 rounded-lg py-2">
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <i class="fas fa-tag text-orange-500 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-600 mb-1">قیمت هر شب</p>
                            <p class="text-xl font-bold text-gray-800">{{ number_format($room->price) }} <span
                                    class="text-sm">تومان</span></p>
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">نام و نام خانوادگی <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="full_name"
                                    value="{{ old('full_name', Auth::user()->first_name . ' ' . Auth::user()->last_name) }}"
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">شماره تماس <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" name="phone" value="{{ old('phone', Auth::user()->mobile) }}"
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ایمیل <span
                                        class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500">
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">درخواست ویژه</label>
                            <textarea name="special_request" rows="3" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3"
                                placeholder="درخواست خاصی دارید؟">{{ old('special_request') }}</textarea>
                        </div>
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

    <script>
        // محاسبه قیمت کل
        function calculateTotal() {
            const yearIn = document.getElementById('check_in_year').value;
            const monthIn = document.getElementById('check_in_month').value;
            const dayIn = document.getElementById('check_in_day').value;
            const yearOut = document.getElementById('check_out_year').value;
            const monthOut = document.getElementById('check_out_month').value;
            const dayOut = document.getElementById('check_out_day').value;
            const price = {{ $room->price }};

            if (yearIn && monthIn && dayIn && yearOut && monthOut && dayOut) {
                const inDate = new Date(yearIn, monthIn - 1, dayIn);
                const outDate = new Date(yearOut, monthOut - 1, dayOut);
                const nights = Math.ceil((outDate - inDate) / (1000 * 60 * 60 * 24));

                if (nights > 0) {
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
        document.getElementById('check_in_year').addEventListener('change', calculateTotal);
        document.getElementById('check_in_month').addEventListener('change', calculateTotal);
        document.getElementById('check_in_day').addEventListener('change', calculateTotal);
        document.getElementById('check_out_year').addEventListener('change', calculateTotal);
        document.getElementById('check_out_month').addEventListener('change', calculateTotal);
        document.getElementById('check_out_day').addEventListener('change', calculateTotal);
        document.getElementById('guests').addEventListener('input', calculateTotal);
    </script>
@endsection
