@extends('admin.Layout.master')
@section('Content')
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

    <div class="p-4 md:p-6">
        <!-- عنوان صفحه و دکمه افزودن اقامتگاه -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت اقامتگاه‌ها</h1>
                <p class="text-gray-500 mt-1">لیست تمام اقامتگاه‌های ثبت‌شده در سامانه</p>
            </div>
            <a href="{{ route('admin.accommodation.add') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                <i class="fas fa-plus"></i>
                <span>افزودن اقامتگاه جدید</span>
            </a>
        </div>

        <!-- کارت‌های آماری اقامتگاه‌ها (از دیتابیس) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">کل اقامتگاه‌ها</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalAccommodations ?? 0 }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-building text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">فعال</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $activeCount ?? 0 }}</p>
                        @if (($totalAccommodations ?? 0) > 0)
                            <span
                                class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                                <i class="fas fa-check-circle text-xs ml-1"></i>
                                {{ round(($activeCount / $totalAccommodations) * 100) }}%
                            </span>
                        @endif
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
                        <p class="text-gray-500 text-sm">در انتظار تایید</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $pendingCount ?? 0 }}</p>
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
                class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-gray-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">غیرفعال/مسدود</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $inactiveCount ?? 0 }}</p>
                    </div>
                    <div class="bg-gray-100 p-3 rounded-full">
                        <i class="fas fa-times-circle text-gray-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- فیلترها و جستجو -->
        <form method="GET" action="{{ route('admin.accommodation') }}" class="bg-white rounded-xl shadow-md p-5 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جستجو</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="نام اقامتگاه، شهر..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        <option value="">همه</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>فعال</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>در انتظار تایید
                        </option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                        <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>مسدود</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">شهر</label>
                    <select name="city_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        <option value="">همه شهرها</option>
                        @foreach ($cities ?? [] as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
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

        <!-- جدول اقامتگاه‌ها -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        اقامتگاه</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        شهر</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        تعداد اتاق</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        امتیاز</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        وضعیت</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        عملیات</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($accommodations ?? [] as $accommodation)
                                    <tr class="hover:bg-gray-50 transition-all duration-200">
                                        <!-- ستون اقامتگاه -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @php
                                                    $images = is_string($accommodation->images)
                                                        ? json_decode($accommodation->images, true)
                                                        : $accommodation->images ?? [];
                                                    $firstImage = $images[0] ?? null;
                                                    $cleanImage = $firstImage
                                                        ? str_replace(['uplouds/', 'uploads/'], '', $firstImage)
                                                        : null;
                                                @endphp

                                                @if ($cleanImage && file_exists(storage_path('app/public/uplouds/' . $cleanImage)))
                                                    <img src="{{ asset('storage/uplouds/' . $cleanImage) }}"
                                                        class="w-10 h-10 rounded-lg object-cover"
                                                        onerror="this.src='{{ asset('images/default.jpg') }}'">
                                                @else
                                                    <div
                                                        class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <i class="fas fa-image text-gray-400"></i>
                                                    </div>
                                                @endif

                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ $accommodation->title }}</p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ Str::limit($accommodation->address, 40) }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- ستون شهر -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $accommodation->city->name ?? 'نامشخص' }}
                                        </td>

                                        <!-- ستون تعداد اتاق -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $accommodation->rooms_count ?? '-' }}
                                        </td>

                                        <!-- ستون امتیاز -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-1">
                                                @php
                                                    $rating = $accommodation->rating ?? 0;
                                                    $fullStars = floor($rating);
                                                    $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                                                    $emptyStars = 5 - $fullStars - $halfStar;
                                                @endphp

                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                                @endfor

                                                @if ($halfStar)
                                                    <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                                                @endif

                                                @for ($i = 0; $i < $emptyStars; $i++)
                                                    <i class="far fa-star text-yellow-400 text-sm"></i>
                                                @endfor

                                                <span
                                                    class="text-sm font-medium text-gray-700 mr-1">{{ number_format($rating, 1) }}</span>
                                                @if ($accommodation->rating_count > 0)
                                                    <span
                                                        class="text-xs text-gray-400">({{ $accommodation->rating_count }})</span>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- ستون وضعیت -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'active' => 'bg-green-100 text-green-700',
                                                    'inactive' => 'bg-gray-100 text-gray-700',
                                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                                    'blocked' => 'bg-red-100 text-red-700',
                                                ];
                                                $statusTexts = [
                                                    'active' => 'فعال',
                                                    'inactive' => 'غیرفعال',
                                                    'pending' => 'در انتظار',
                                                    'blocked' => 'مسدود',
                                                ];
                                                $color =
                                                    $statusColors[$accommodation->status] ??
                                                    'bg-gray-100 text-gray-700';
                                                $text = $statusTexts[$accommodation->status] ?? 'نامشخص';
                                            @endphp
                                            <span
                                                class="px-2 py-1 text-xs rounded-full {{ $color }}">{{ $text }}</span>
                                        </td>

                                        <!-- ستون عملیات -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.accommodation.show', $accommodation->id) }}"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors"
                                                    title="مشاهده">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.accommodation.edit', $accommodation->id) }}"
                                                    class="text-green-600 hover:text-green-800 transition-colors"
                                                    title="ویرایش">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin.accommodation.destroy', $accommodation->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('آیا از حذف این اقامتگاه مطمئن هستید؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-800 transition-colors"
                                                        title="حذف">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            <i class="fas fa-building text-4xl mb-2 block"></i>
                                            <p>هیچ اقامتگاهی یافت نشد.</p>
                                            <a href="{{ route('admin.accommodation.add') }}"
                                                class="mt-2 inline-block text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-plus ml-1"></i>
                                                افزودن اقامتگاه جدید
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if (isset($accommodations) && method_exists($accommodations, 'links'))
                        <div class="px-6 py-4 border-t">
                            {{ $accommodations->links() }}
                        </div>
                    @endif
                </div>
            </div>


        </div>

        <!-- بخش دسترسی سریع -->
        <div class="mt-8">
            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-6">
                <h3 class="font-bold text-gray-800 text-lg mb-4">عملیات سریع اقامتگاه‌ها</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <a href="{{ route('admin.accommodation.add') }}"
                        class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                        <i class="fas fa-plus-circle text-indigo-600 text-2xl mb-2 block"></i>
                        <span class="text-sm text-gray-700">اقامتگاه جدید</span>
                    </a>

                    
                    <a href=""
                        class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                        <i class="fas fa-download text-indigo-600 text-2xl mb-2 block"></i>
                        <span class="text-sm text-gray-700">خروجی Excel</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

