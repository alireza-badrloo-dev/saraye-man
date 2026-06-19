@extends('admin.Layout.master')

@section('Content')
    <div class="p-4 md:p-6">
        <!-- عنوان صفحه و دکمه افزودن شهر -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت شهرها</h1>
                <p class="text-gray-500 mt-1">لیست تمام شهرهای ثبت‌شده در سامانه</p>
            </div>
            <a href="{{ route('admin.cities.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                <i class="fas fa-plus"></i>
                <span>افزودن شهر جدید</span>
            </a>
        </div>

        <!-- کارت‌های آماری -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">کل شهرها</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $cities->total() }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-city text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">شهرهای فعال</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            {{ $cities->filter(function($city) { return $city->accommodations_count > 0; })->count() }}
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-yellow-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">بدون اقامتگاه</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            {{ $cities->filter(function($city) { return $city->accommodations_count == 0; })->count() }}
                        </p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-indigo-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">کل اقامتگاه‌ها</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            {{ $cities->sum('accommodations_count') }}
                        </p>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-full">
                        <i class="fas fa-building text-indigo-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- جدول شهرها -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نام شهر</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تعداد اقامتگاه</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ ثبت</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($cities as $city)
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $city->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        {{ $city->accommodations_count }} اقامتگاه
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Morilog\Jalali\Jalalian::fromCarbon($city->created_at)->format('Y/m/d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.cities.edit', $city->id) }}"
                                            class="text-green-600 hover:text-green-800 transition-colors" title="ویرایش">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('آیا از حذف شهر {{ $city->name }} مطمئن هستید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors"
                                                title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-city text-4xl mb-2 block"></i>
                                    <p>هیچ شهری ثبت نشده است</p>
                                    <a href="{{ route('admin.cities.create') }}"
                                        class="mt-2 inline-block text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-plus ml-1"></i>
                                        افزودن شهر جدید
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($cities->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $cities->links("vendor.pagination.admin-indigo") }}
                </div>
            @endif
        </div>
    </div>
@endsection