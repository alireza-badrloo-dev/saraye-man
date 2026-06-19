@extends('admin.Layout.master')
@section('Content')
<div class="p-4 md:p-6">
    <div class="mb-6">
        <a href="{{ route('admin.reserve') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800">
            <i class="fas fa-arrow-right"></i>
            بازگشت به لیست رزروها
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b bg-gray-50">
            <h3 class="font-bold text-gray-800 text-lg">جزئیات رزرو</h3>
            <p class="text-sm text-gray-500 mt-1">کد پیگیری: {{ $reservation->tracking_code }}</p>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.reserve.update-status', $reservation->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- اطلاعات کاربر -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-gray-800 border-b pb-2">اطلاعات کاربر</h4>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-user text-indigo-600 text-base"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">{{ $reservation->user->first_name ?? '' }} {{ $reservation->user->last_name ?? '' }}</p>
                                <p class="text-sm text-gray-500">{{ $reservation->user->email ?? '' }}</p>
                                <p class="text-sm text-gray-500">{{ $reservation->user->mobile ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- اطلاعات اقامتگاه و اتاق -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-gray-800 border-b pb-2">اطلاعات اقامتگاه</h4>
                        <div class="flex justify-between">
                            <span class="text-gray-600">اقامتگاه:</span>
                            <span class="text-gray-800 font-medium">{{ $reservation->accommodation->title ?? 'نامشخص' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">اتاق:</span>
                            <span class="text-gray-800 font-medium">{{ $reservation->room->title ?? 'نامشخص' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">تعداد مهمان:</span>
                            <span class="text-gray-800 font-medium">{{ $reservation->guests }} نفر</span>
                        </div>
                    </div>

                    <!-- اطلاعات رزرو -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-gray-800 border-b pb-2">اطلاعات رزرو</h4>
                        <div class="flex justify-between">
                            <span class="text-gray-600">تاریخ ورود:</span>
                            <span class="text-gray-800">{{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->check_in)->format('Y/m/d') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">تاریخ خروج:</span>
                            <span class="text-gray-800">{{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->check_out)->format('Y/m/d') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">تعداد شب:</span>
                            <span class="text-gray-800">{{ $reservation->nights }} شب</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">قیمت هر شب:</span>
                            <span class="text-gray-800">{{ number_format($reservation->price_per_night) }} تومان</span>
                        </div>
                    </div>

                    <!-- اطلاعات مالی -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-gray-800 border-b pb-2">اطلاعات مالی</h4>
                        <div class="flex justify-between">
                            <span class="text-gray-600">مبلغ کل:</span>
                            <span class="text-lg font-bold text-green-600">{{ number_format($reservation->total_price) }} تومان</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">کد پیگیری:</span>
                            <span class="text-sm font-mono text-gray-600">{{ $reservation->tracking_code }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">تاریخ ثبت:</span>
                            <span class="text-gray-800">{{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->created_at)->format('Y/m/d') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">وضعیت:</span>
                            <select name="status" class="px-3 py-2 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500">
                                <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>⏳ در انتظار پرداخت</option>
                                <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>✅ تایید شده</option>
                                <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>❌ لغو شده</option>
                                <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>✔️ تکمیل شده</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- اطلاعات همراهان -->
                @if($reservation->companions && count($reservation->companions) > 0)
                <div class="mt-6">
                    <h4 class="font-bold text-gray-800 border-b pb-2 mb-3">اطلاعات همراهان</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">نام و نام خانوادگی</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">کد ملی</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">شماره تماس</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reservation->companions as $companion)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $companion->full_name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $companion->national_code ?? '-' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $companion->phone ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <!-- درخواست ویژه -->
                @if($reservation->notes)
                <div class="mt-6">
                    <h4 class="font-bold text-gray-800 border-b pb-2 mb-3">درخواست ویژه</h4>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-gray-700">{{ $reservation->notes }}</p>
                    </div>
                </div>
                @endif

                <div class="mt-6 flex justify-between gap-3">
                    <a href="{{ route('admin.reserve') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">بازگشت</a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        ذخیره تغییرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection