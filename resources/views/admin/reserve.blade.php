@extends('admin.Layout.master')
@section('Content')
    <div class="p-4 md:p-6">
        <!-- نمایش پیام موفقیت/خطا -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- عنوان صفحه -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت رزروها</h1>
                <p class="text-gray-500 mt-1">لیست تمام رزروهای ثبت‌شده در سامانه</p>
            </div>
        </div>

        <!-- کارت‌های آماری رزروها -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">کل رزروها</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalReservations }}</p>
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
                        <p class="text-gray-500 text-sm">رزروهای فعال</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $activeReservations }}</p>
                        <span
                            class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                            <i class="fas fa-check-circle text-xs ml-1"></i> در حال انجام
                        </span>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-yellow-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">در انتظار پرداخت</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $pendingReservations }}</p>
                        <span
                            class="text-yellow-600 text-xs bg-yellow-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                            <i class="fas fa-clock text-xs ml-1"></i> نیاز به بررسی
                        </span>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-red-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">لغو شده</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $cancelledReservations }}</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- فیلترها و جستجو -->
        <form method="GET" action="{{ route('admin.reserve') }}" class="bg-white rounded-xl shadow-md p-5 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جستجو</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="کد پیگیری، نام کاربر..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        <option value="">همه</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>تایید شده
                        </option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>در انتظار</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>لغو شده</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>تکمیل شده
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">بازه زمانی</label>
                    <select name="date_range"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        <option value="">همه</option>
                        <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>امروز</option>
                        <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>این هفته</option>
                        <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>این ماه</option>
                        <option value="year" {{ request('date_range') == 'year' ? 'selected' : '' }}>سالیانه</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-all">
                        <i class="fas fa-search ml-2"></i> جستجو
                    </button>
                </div>
            </div>
        </form>

        <!-- جدول رزروها -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">شناسه</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">کد پیگیری</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">مهمان</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">اقامتگاه</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">اتاق</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">تاریخ شروع</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">تاریخ پایان</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">مبلغ</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">وضعیت</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reservations as $reservation)
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $reservation->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-600">
                                    {{ $reservation->tracking_code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-user text-indigo-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $reservation->user->first_name ?? '' }}
                                                {{ $reservation->user->last_name ?? '' }}</p>
                                            <p class="text-xs text-gray-500">{{ $reservation->user->email ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $reservation->accommodation->title ?? 'نامشخص' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $reservation->room->title ?? 'نامشخص' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->check_in)->format('Y/m/d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ \Morilog\Jalali\Jalalian::fromCarbon($reservation->check_out)->format('Y/m/d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ number_format($reservation->total_price) }} تومان</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'confirmed' => 'bg-green-100 text-green-700',
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                            'completed' => 'bg-blue-100 text-blue-700',
                                        ];
                                        $statusTexts = [
                                            'confirmed' => 'تایید شده',
                                            'pending' => 'در انتظار',
                                            'cancelled' => 'لغو شده',
                                            'completed' => 'تکمیل شده',
                                        ];
                                    @endphp
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $statusTexts[$reservation->status] ?? 'نامشخص' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.reserve.show', $reservation->id) }}"
                                            class="text-blue-600 hover:text-blue-800" title="مشاهده">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.reserve.destroy', $reservation->id) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('آیا از حذف این رزرو مطمئن هستید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800"
                                                title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-calendar-times text-4xl mb-2 block"></i>
                                    <p>هیچ رزروی یافت نشد.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if (method_exists($reservations, 'links'))
                <div class="px-6 py-4 border-t">
                    {{ $reservations->links("vendor.pagination.admin-indigo") }}
                </div>
            @endif
        </div>
    </div>
@endsection
