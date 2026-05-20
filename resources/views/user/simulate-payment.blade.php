@extends('user.Layouts.master')
@section('Mycontent')
<div class="mx-4 md:mx-20 xl:mx-40 my-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-5 text-center">
            <i class="fas fa-credit-card text-white text-5xl mb-3"></i>
            <h1 class="text-2xl font-bold text-white">درگاه پرداخت آزمایشی</h1>
            <p class="text-blue-100 text-sm mt-1">شبیه‌سازی درگاه بانکی</p>
        </div>
        
        <div class="p-6">
            <!-- اطلاعات کارت بانکی آزمایشی -->
            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                <h3 class="font-bold text-gray-700 mb-3 text-center">اطلاعات کارت بانکی آزمایشی</h3>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div class="bg-white p-2 rounded border">
                        <span class="text-gray-500">شماره کارت:</span>
                        <span class="font-mono text-green-600 block">5022-2910-6000-1523</span>
                    </div>
                    <div class="bg-white p-2 rounded border">
                        <span class="text-gray-500">رمز دوم:</span>
                        <span class="font-mono text-green-600 block">123456</span>
                    </div>
                    <div class="bg-white p-2 rounded border">
                        <span class="text-gray-500">CVV2:</span>
                        <span class="font-mono text-green-600 block">123</span>
                    </div>
                    <div class="bg-white p-2 rounded border">
                        <span class="text-gray-500">تاریخ انقضا:</span>
                        <span class="font-mono text-green-600 block">1404/12</span>
                    </div>
                </div>
            </div>
            
            <!-- اطلاعات پرداخت -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">مبلغ قابل پرداخت:</span>
                        <p class="font-bold text-green-600 text-lg">{{ number_format($reservation->total_price) }} تومان</p>
                    </div>
                    <div>
                        <span class="text-gray-500">کد رزرو:</span>
                        <p class="font-mono">{{ $reservation->tracking_code }}</p>
                    </div>
                </div>
            </div>
            
            <!-- دکمه پرداخت نهایی -->
            <form action="{{ route('payment.confirm', $reservation->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-xl hover:from-green-700 hover:to-green-600 transition shadow-lg text-lg font-bold">
                    تأیید و پرداخت {{ number_format($reservation->total_price) }} تومان
                </button>
            </form>
            
            <div class="flex justify-between gap-3 mt-4">
                <a href="{{ route('payment.index', $reservation->id) }}" class="flex-1 text-center py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition">
                    انصراف از پرداخت
                </a>
            </div>
            
            <p class="text-center text-xs text-gray-400 mt-4">
                این یک محیط تست است. با کلیک روی دکمه تأیید، رزرو شما نهایی می‌شود.
            </p>
        </div>
    </div>
</div>
@endsection