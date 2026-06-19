@extends('admin.Layout.master')
@section('Content')
<div class="p-4 md:p-6">
     <!-- عنوان صفحه و دکمه افزودن ادمین -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت ادمین‌ها</h1>
            <p class="text-gray-500 mt-1">لیست تمام مدیران سیستم</p>
        </div>
        
        <!-- دکمه افزودن ادمین جدید -->
        <a href="{{ route('admin.admins.create') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
            <i class="fas fa-plus"></i>
            <span>افزودن ادمین جدید</span>
        </a>
    </div>

    <!-- کارت‌های آماری -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کل ادمین‌ها</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalAdmins ?? $admins->total() }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-user-shield text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">ادمین‌های فعال</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $activeAdmins ?? 0 }}</p>
                    @php
                        $total = $admins->total();
                    @endphp
                    @if($total > 0)
                        <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                            <i class="fas fa-check-circle text-xs ml-1"></i> {{ round(($activeAdmins / $total) * 100) }}%
                        </span>
                    @endif
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-user-check text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">سوپر ادمین‌ها</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $superAdmins ?? 0 }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-crown text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-red-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">ادمین‌های مسدود</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $blockedAdmins ?? 0 }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-ban text-red-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- فیلترها و جستجو -->
    <form method="GET" action="{{ route('admin.admins') }}" class="bg-white rounded-xl shadow-md p-5 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">جستجو</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="نام، ایمیل، شماره تماس..." 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">نقش</label>
                <select name="role" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">همه</option>
                    <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>سوپر ادمین</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>ادمین</option>
                    <option value="moderator" {{ request('role') == 'moderator' ? 'selected' : '' }}>مدیر محتوا</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">همه</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                    <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>مسدود</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-all">
                    <i class="fas fa-search ml-2"></i> جستجو
                </button>
            </div>
        </div>
    </form>

    <!-- جدول ادمین‌ها -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b bg-gray-50">
            <h3 class="font-bold text-gray-800">لیست ادمین‌ها</h3>
            <p class="text-xs text-gray-500">مدیران سیستم</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">شناسه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">نام و نام خانوادگی</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">ایمیل</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">شماره تماس</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">نقش</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">وضعیت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">آخرین ورود</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">عملیات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $admin->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                @if($admin->profile_image)
                                    <img src="{{ asset('storage/admins/' . $admin->profile_image) }}" class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <i class="fas fa-user-shield text-indigo-600 text-sm"></i>
                                    </div>
                                @endif
                                <span class="text-sm text-gray-900">{{ $admin->first_name }} {{ $admin->last_name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $admin->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $admin->mobile ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($admin->role == 'super_admin')
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">سوپر ادمین</span>
                            @elseif($admin->role == 'admin')
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">ادمین</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">مدیر محتوا</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($admin->status == 'active')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">فعال</span>
                            @elseif($admin->status == 'blocked')
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">مسدود</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">غیرفعال</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $admin->last_login_at ? \Morilog\Jalali\Jalalian::fromCarbon($admin->last_login_at)->format('Y/m/d') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.admins.show', $admin->id) }}" class="text-blue-600 hover:text-blue-800" title="مشاهده">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="text-green-600 hover:text-green-800" title="ویرایش">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.admins.toggle-status', $admin->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-orange-600 hover:text-orange-800" title="تغییر وضعیت">
                                        <i class="fas {{ $admin->status == 'active' ? 'fa-ban' : 'fa-check-circle' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" class="inline" onsubmit="return confirm('آیا از حذف این ادمین مطمئن هستید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="حذف">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-user-shield text-4xl mb-2 block"></i>
                            <p>هیچ ادمینی یافت نشد.</p>
                            @php
                                $admin = Auth::guard('admin')->user();
                            @endphp
                            @if($admin && $admin->role == 'super_admin')
                            <a href="{{ route('admin.admins.create') }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-plus ml-1"></i> افزودن ادمین جدید
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($admins, 'links'))
            <div class="px-6 py-4 border-t">
                {{ $admins->links("vendor.pagination.admin-indigo") }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    flatpickr(".datepicker", {
        locale: "fa",
        dateFormat: "Y/m/d",
        maxDate: "today"
    });
</script>
@endpush
@endsection