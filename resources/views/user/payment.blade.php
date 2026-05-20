@extends('user.Layouts.master')
@section('Mycontent')
<div class="mx-4 md:mx-20 xl:mx-40 my-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-orange-600 to-orange-500 px-6 py-5">
            <h1 class="text-2xl font-bold text-white">تکمیل اطلاعات پرداخت</h1>
        </div>
        
        <div class="p-6">
            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">اقامتگاه:</span>
                        <p class="font-medium">{{ $reservation->accommodation->title }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">اتاق:</span>
                        <p class="font-medium">{{ $reservation->room->title }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">تاریخ ورود:</span>
                        <p class="font-medium">{{ $checkInShamsi }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">تاریخ خروج:</span>
                        <p class="font-medium">{{ $checkOutShamsi }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">تعداد شب:</span>
                        <p class="font-medium">{{ $reservation->nights }} شب</p>
                    </div>
                    <div>
                        <span class="text-gray-500">تعداد مهمان:</span>
                        <p class="font-medium">{{ $reservation->guests }} نفر</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">مبلغ قابل پرداخت:</span>
                    <span class="text-2xl font-bold text-green-600">{{ number_format($reservation->total_price) }} تومان</span>
                </div>
            </div>
            
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                <button type="submit" class="w-full py-3 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition text-lg font-bold">
                    پرداخت {{ number_format($reservation->total_price) }} تومان
                </button>
            </form>
        </div>
    </div>
</div>
@endsection