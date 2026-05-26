@extends('admin.Layout.master')
@section('Content')
<div class="p-4 md:p-6">
    <!-- عنوان صفحه -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت نظرات</h1>
        <p class="text-gray-500 mt-1">مشاهده و مدیریت نظرات کاربران</p>
    </div>

    <!-- کارت‌های آماری -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کل نظرات</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalComments }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-comments text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">تایید شده</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $approvedComments }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">در انتظار</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pendingComments }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">میانگین امتیاز</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($averageRating, 1) }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-star text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- فیلترها -->
    <form method="GET" action="{{ route('admin.comments') }}" class="bg-white rounded-xl shadow-md p-5 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">جستجو</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="نام کاربر..." 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">همه</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>تایید شده</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>در انتظار</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>رد شده</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">اقامتگاه</label>
                <select name="accommodation_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">همه اقامتگاه‌ها</option>
                    @foreach($accommodations as $accommodation)
                        <option value="{{ $accommodation->id }}" {{ request('accommodation_id') == $accommodation->id ? 'selected' : '' }}>
                            {{ $accommodation->title }}
                        </option>
                    @endforeach
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

    <!-- جدول نظرات -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b bg-gray-50">
            <h3 class="font-bold text-gray-800">لیست نظرات کاربران</h3>
            <p class="text-xs text-gray-500">آخرین نظرات ثبت‌شده در سامانه</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">کاربر</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">اقامتگاه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">نکات مثبت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">نکات منفی</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">امتیاز</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">تاریخ</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">وضعیت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">عملیات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($comments as $comment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <i class="fas fa-user text-indigo-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $comment->user->first_name ?? '' }} {{ $comment->user->last_name ?? '' }}</p>
                                    <p class="text-xs text-gray-500">{{ $comment->user->email ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $comment->accommodation->title ?? 'نامشخص' }}</td>
                        <td class="px-6 py-4 text-sm text-green-600">{{ Str::limit($comment->positive_points ?? '-', 50) }}</td>
                        <td class="px-6 py-4 text-sm text-red-600">{{ Str::limit($comment->negative_points ?? '-', 50) }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm  font-bold text-orange-500">{{ $comment->rating }}</span>
                            <span class="text-xs text-gray-500">/10</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ \Morilog\Jalali\Jalalian::fromCarbon($comment->created_at)->format('Y/m/d') }}</td>
                        <td class="px-6 py-4">
                            <span class=" text-xs 
                                {{ $comment->status == 'approved' ? ' text-green-700' : 
                                   ($comment->status == 'rejected' ?  'text-red-700' : 
                                   'bg-yellow-100 text-yellow-700') }}">
                                {{ $comment->status == 'approved' ? 'تایید شده' : 
                                   ($comment->status == 'rejected' ? 'رد شده' : 'در انتظار') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.comments.show', $comment->id) }}" class="text-blue-600 hover:text-blue-800" title="مشاهده">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="inline" onsubmit="return confirm('آیا از حذف این نظر مطمئن هستید؟')">
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
                            <i class="fas fa-comment-slash text-4xl mb-2 block"></i>
                            هیچ نظری یافت نشد.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($comments, 'links'))
        <div class="px-6 py-4 border-t">
            {{ $comments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection