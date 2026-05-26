@extends('admin.Layout.master')
@section('Content')
    <div class="p-4 md:p-6">
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">داشبورد مدیریت</h1>
            <p class="text-gray-500 mt-1">خوش آمدید! آمار و اطلاعات کلی سیستم را مشاهده می‌کنید</p>
        </div>

        <!-- کارت‌های آماری کلیدی (از دیتابیس) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">کل رزروها</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalReservations ?? 0 }}</p>
                        @if (($totalReservations ?? 0) > 0)
                            <span
                                class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                                <i class="fas fa-arrow-up text-xs ml-1"></i> +۱۲٪
                            </span>
                        @endif
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">درآمد کل (ماه جاری)</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($monthlyIncome ?? 0) }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-purple-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">اقامتگاه‌های فعال</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $activeAccommodations ?? 0 }}</p>
                        <span class="text-gray-500 text-xs mt-2 inline-block">از {{ $totalAccommodations ?? 0 }}
                            ثبت‌شده</span>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-building text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-orange-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">کاربران ثبت‌نام شده</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalUsers ?? 0 }}</p>
                        <span
                            class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                            <i class="fas fa-user-plus text-xs ml-1"></i> +{{ $newUsers ?? 0 }} جدید
                        </span>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <i class="fas fa-users text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ردیف دوم: نمودارها و آمار پیشرفته -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- محبوب‌ترین اقامتگاه‌ها -->
            <div class="bg-white rounded-xl shadow-md p-5">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-800 text-lg">محبوب‌ترین اقامتگاه‌ها</h3>
                    <i class="fas fa-chart-line text-gray-400"></i>
                </div>
                <div class="space-y-4">
                    @forelse($popularAccommodations ?? [] as $acc)
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>{{ $acc->title }}</span>
                                <span class="font-semibold">{{ $acc->reservations_count }} رزرو</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                @php
                                    $maxReservations = $popularAccommodations->max('reservations_count') ?? 1;
                                    $percentage = ($acc->reservations_count / $maxReservations) * 100;
                                @endphp
                                <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">هیچ داده‌ای موجود نیست</p>
                    @endforelse
                </div>
            </div>

            <!-- خلاصه مالی ماه جاری -->
            <div class="bg-white rounded-xl shadow-md p-5">
                <h3 class="font-bold text-gray-800 text-lg mb-4">خلاصه مالی ماه جاری</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center pb-2 border-b">
                        <span class="text-gray-600">مجموع درآمد</span>
                        <span class="font-bold text-gray-800">{{ number_format($monthlyIncome ?? 0) }} تومان</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b">
                        <span class="text-gray-600">درآمد خالص (بعد از کمیسیون)</span>
                        <span class="font-bold text-green-600">{{ number_format($netIncome ?? 0) }} تومان</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b">
                        <span class="text-gray-600">کمیسیون سامانه (۱۰٪)</span>
                        <span class="font-bold text-red-500">{{ number_format($commission ?? 0) }} تومان</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-600">مقایسه با ماه قبل</span>
                        <span class="text-green-600 font-semibold"><i class="fas fa-arrow-up"></i>
                            +{{ $growthPercentage ?? 0 }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ردیف سوم: رزروهای اخیر و فعالیت‌ها -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- لیست آخرین رزروها -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-5 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800">آخرین رزروهای ثبت‌شده</h3>
                    <p class="text-gray-500 text-sm mt-1">۱۰ رزرو اخیر سیستم</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">مهمان</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">اقامتگاه</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">اتاق</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">تاریخ</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">وضعیت</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentReservations ?? [] as $reservation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-user text-blue-600 text-sm"></i>
                                            </div>
                                            <span>{{ $reservation->user->first_name ?? '' }}
                                                {{ $reservation->user->last_name ?? '' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->accommodation->title ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->room->title ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->created_at)->format('Y/m/d') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($reservation->status == 'confirmed')
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">تایید
                                                شده</span>
                                        @elseif($reservation->status == 'pending')
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">در
                                                انتظار</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">لغو
                                                شده</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">هیچ رزروی یافت نشد</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 text-center border-t">
                    <a href="{{ route('admin.reserve') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">مشاهده همه
                        رزروها <i class="fas fa-arrow-left mr-1"></i></a>
                </div>
            </div>

            <!-- آخرین فعالیت‌ها -->
            <div class="bg-white rounded-xl shadow-md p-5">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-bell text-yellow-500"></i>
                    آخرین فعالیت‌ها
                </h3>
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @forelse($recentActivities ?? [] as $activity)
                        <div class="flex gap-3 text-sm pb-3 border-b">
                            <i class="fas {{ $activity['icon'] }} {{ $activity['icon_color'] }} mt-1"></i>
                            <div>
                                <p>{!! $activity['message'] !!}</p>
                                <p class="text-xs text-gray-400">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">هیچ فعالیتی یافت نشد</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ردیف چهارم: ویجت‌های تکمیلی -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- وضعیت تکمیل اطلاعات اقامتگاه‌ها -->
            <div class="bg-white rounded-xl shadow-md p-5">
                <h3 class="font-bold text-gray-800 mb-4">وضعیت تکمیل اطلاعات اقامتگاه‌ها</h3>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>اقامتگاه‌های فعال</span>
                            <span>{{ $activeAccommodations ?? 0 }}/{{ $totalAccommodations ?? 0 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            @php $activePercentage = ($totalAccommodations ?? 0) > 0 ? (($activeAccommodations ?? 0) / ($totalAccommodations ?? 0)) * 100 : 0; @endphp
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $activePercentage }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- جدیدترین نظرات -->
<div class="bg-white rounded-xl shadow-md p-5">
    <h3 class="font-bold text-gray-800 mb-4 flex items-center justify-between">
        <span><i class="fas fa-comment-dots text-blue-500 ml-2"></i> جدیدترین نظرات</span>
        <a href="{{ route('admin.comments') }}" class="text-xs text-indigo-600">مشاهده همه</a>
    </h3>
    <div class="space-y-3">
        @forelse($recentComments ?? [] as $comment)
        <div class="border-b pb-3 last:border-0">
            <p class="text-sm text-gray-700 line-clamp-2">"{{ Str::limit($comment->comment, 60) }}"</p>
            <div class="flex justify-between items-center mt-2">
                <div class="flex flex-col gap-1">
                    <span class="text-xs text-gray-500">
                        <i class="fas fa-user ml-1"></i>
                        {{ $comment->user->first_name ?? '' }} {{ $comment->user->last_name ?? '' }}
                    </span>
                    <a href="{{ route('admin.comments.show', $comment->id) }}" 
                       class="text-xs text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-1 group">
                        <i class="fas fa-building text-indigo-400 group-hover:text-indigo-600"></i>
                        {{ Str::limit($comment->accommodation->title ?? 'اقامتگاه نامشخص', 30) }}
                        <i class="fas fa-arrow-left text-[10px] group-hover:translate-x-1 transition"></i>
                    </a>
                </div>
                <div class="flex flex-col items-end gap-1">
                    <span class="text-xs font-bold {{ $comment->rating >= 7 ? 'text-green-600' : ($comment->rating >= 4 ? 'text-orange-500' : 'text-red-500') }}">
                        {{ $comment->rating }} / 10
                    </span>
                    <span class="text-[10px] text-gray-400">
                        {{ \Morilog\Jalali\Jalalian::fromCarbon($comment->created_at)->format('Y/m/d') }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-4">
            <i class="fas fa-comment-slash text-gray-300 text-3xl mb-2 block"></i>
            <p class="text-gray-500 text-sm">هیچ نظری یافت نشد</p>
        </div>
        @endforelse
    </div>
</div>
        </div>

        <!-- دسترسی سریع -->
       
    </div>
@endsection
