@extends('admin.Layout.master')
@section('Content')
    <div class="p-4 md:p-6">
        <div class="mb-6">
            <a href="{{ route('admin.users') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-right"></i>
                بازگشت به لیست کاربران
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b bg-gray-50">
                <h3 class="font-bold text-gray-800 text-lg">جزئیات کاربر</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- اطلاعات شخصی -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-gray-800 border-b pb-2">اطلاعات شخصی</h4>

                        <div class="flex items-center gap-3 pb-3 border-b">
                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-user text-indigo-600 text-base"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-lg">{{ $user->first_name ?? '' }}
                                    {{ $user->last_name ?? '' }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">نام:</span>
                            <span class="text-gray-800 font-medium">{{ $user->first_name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">نام خانوادگی:</span>
                            <span class="text-gray-800 font-medium">{{ $user->last_name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">ایمیل:</span>
                            <span class="text-gray-800 font-medium">{{ $user->email ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">شماره تماس:</span>
                            <span class="text-gray-800 font-medium">{{ $user->mobile ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">جنسیت:</span>
                            <span class="text-gray-800 font-medium">
                                @if ($user->gender == 'male')
                                    مرد
                                @elseif($user->gender == 'female')
                                    زن
                                @else
                                    {{ $user->gender ?? '-' }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">تاریخ تولد:</span>
                            <span class="text-gray-800 font-medium">{{ $user->birth_date ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- اطلاعات هویتی و حساب کاربری -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-gray-800 border-b pb-2">اطلاعات هویتی و حساب کاربری</h4>

                        <div class="flex justify-between">
                            <span class="text-gray-600">ملیت:</span>
                            <span class="text-gray-800 font-medium">{{ $user->nationality ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">کد ملی:</span>
                            <span class="text-gray-800 font-medium">{{ $user->national_id ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">کد پستی:</span>
                            <span class="text-gray-800 font-medium">{{ $user->postal_code ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">آدرس:</span>
                            <span class="text-gray-800 font-medium">{{ Str::limit($user->address ?? '-', 50) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">تاریخ ثبت‌نام:</span>
                            <span class="text-gray-800 font-medium">
                                {{ $user->created_at ? \Morilog\Jalali\Jalalian::fromCarbon($user->created_at)->format('Y/m/d') : '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">وضعیت:</span>
                            @if ($user->status == 'active')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">فعال</span>
                            @elseif($user->status == 'blocked')
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">مسدود</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">غیرفعال</span>
                            @endif
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">تایید ایمیل:</span>
                            @if ($user->email_verified_at)
                                <span class="text-green-600">تایید شده</span>
                            @else
                                <span class="text-red-600">تایید نشده</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- رزروهای کاربر -->
                <div class="mt-8">
                    <h4 class="font-bold text-gray-800 border-b pb-2 mb-4">رزروهای کاربر</h4>
                    @if ($reservations && $reservations->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">کد پیگیری</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">اقامتگاه</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">اتاق</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">تاریخ</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">مبلغ</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($reservations as $reservation)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2 whitespace-nowrap text-sm font-mono text-gray-600">
                                                {{ $reservation->tracking_code }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">
                                                {{ $reservation->accommodation->title ?? '-' }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">
                                                {{ $reservation->room->title ?? '-' }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-600">
                                                {{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->created_at)->format('Y/m/d') }}
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ number_format($reservation->total_price) }} تومان</td>
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                @if ($reservation->status == 'confirmed')
                                                    <span
                                                        class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">تایید
                                                        شده</span>
                                                @elseif($reservation->status == 'pending')
                                                    <span
                                                        class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">در
                                                        انتظار</span>
                                                @elseif($reservation->status == 'cancelled')
                                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">لغو
                                                        شده</span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">تکمیل
                                                        شده</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 bg-gray-50 rounded-lg">
                            <i class="fas fa-calendar-times text-gray-400 text-4xl mb-2 block"></i>
                            <p class="text-gray-500">این کاربر هیچ رزروی ندارد.</p>
                        </div>
                    @endif
                </div>

                <!-- دکمه‌های عملیات -->
                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.users') }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">بازگشت</a>
                    <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="px-6 py-2 {{ $user->status == 'active' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg transition">
                            {{ $user->status == 'active' ? 'مسدود کردن کاربر' : 'فعال کردن کاربر' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
