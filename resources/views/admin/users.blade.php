@extends('admin.Layout.master')
@section('Content')
<div class="p-4 md:p-6">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت کاربران</h1>
            <p class="text-gray-500 mt-1">لیست تمام کاربران ثبت‌شده در سامانه</p>
        </div>
    </div>

    <!-- کارت‌های آماری -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کل کاربران</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کاربران فعال</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $activeUsers }}</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-check-circle text-xs ml-1"></i>
                        {{ $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100) : 0 }}%
                    </span>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-user-check text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کاربران جدید (ماه)</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $newUsers }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-user-plus text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-red-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کاربران مسدود</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $blockedUsers }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-user-slash text-red-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- فیلترها و جستجو -->
    <form method="GET" action="{{ route('admin.users') }}" class="bg-white rounded-xl shadow-md p-5 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">جستجو</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="نام، ایمیل، شماره تماس..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">همه</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>مسدود</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
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

    <!-- جدول کاربران -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">شناسه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">کاربر</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">ایمیل</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">شماره تماس</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">تاریخ ثبت‌نام</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">رزروها</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">وضعیت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">عملیات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-all duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $user->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-user text-indigo-600 text-sm"></i>
                                        </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->mobile ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $user->created_at ? \Morilog\Jalali\Jalalian::fromCarbon($user->created_at)->format('Y/m/d') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                {{ $user->reservations_count ?? 0 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->status == 'active')
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">فعال</span>
                                @elseif($user->status == 'blocked')
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">مسدود</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">غیرفعال</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600 hover:text-blue-800" title="مشاهده">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-orange-600 hover:text-orange-800" title="تغییر وضعیت">
                                            <i class="fas {{ $user->status == 'active' ? 'fa-ban' : 'fa-check-circle' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('آیا از حذف این کاربر مطمئن هستید؟')">
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
                                <i class="fas fa-users text-4xl mb-2 block"></i>
                                <p>هیچ کاربری یافت نشد.</p>
                            </table>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (method_exists($users, 'links'))
            <div class="px-6 py-4 border-t">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection