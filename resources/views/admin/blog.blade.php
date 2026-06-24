@extends('admin.Layout.master')

@section('Content')
<div class="p-4 md:p-6">
    <!-- عنوان صفحه -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800"> مدیریت مقالات</h1>
            <p class="text-gray-500 mt-1">لیست تمام مقالات وبلاگ</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
            <i class="fas fa-plus"></i>
            <span>مقاله جدید</span>
        </a>
    </div>

    <!-- کارت‌های آماری -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-indigo-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کل مقالات</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalPosts }}</p>
                </div>
                <div class="bg-indigo-100 p-3 rounded-full">
                    <i class="fas fa-newspaper text-indigo-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">منتشر شده</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $publishedPosts }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">پیش‌نویس</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $draftPosts }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-pen-fancy text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- فیلتر و جستجو -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
        <form method="GET" action="{{ route('admin.blogs.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="جستجوی مقاله..." 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">همه وضعیت‌ها</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>پیش‌نویس</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منتشر شده</option>
                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>بایگانی</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-search ml-2"></i> جستجو
                </button>
            </div>
        </form>
    </div>

    <!-- جدول مقالات -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تصویر</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عنوان</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">دسته‌بندی</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ویژه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">بازدید</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($blogs as $blog)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" 
                                    class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $blog->title }}</p>
                                <p class="text-xs text-gray-500">{{ Str::limit($blog->summary, 50) }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                {{ $blog->category ?? 'بدون دسته' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($blog->status == 'published')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    <i class="fas fa-check-circle ml-1"></i> منتشر شده
                                </span>
                            @elseif($blog->status == 'draft')
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                    <i class="fas fa-pen-fancy ml-1"></i> پیش‌نویس
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                    <i class="fas fa-archive ml-1"></i> بایگانی
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($blog->is_featured)
                                <span class="text-orange-500"><i class="fas fa-star"></i></span>
                            @else
                                <span class="text-gray-300"><i class="far fa-star"></i></span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $blog->views }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                           {{ \Morilog\Jalali\Jalalian::fromCarbon($blog->created_at)->format('Y/m/d') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.blogs.show', $blog->id) }}" 
                                    class="text-blue-600 hover:text-blue-800" title="مشاهده">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" 
                                    class="text-green-600 hover:text-green-800" title="ویرایش">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.blogs.toggle-status', $blog->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-800" title="تغییر وضعیت">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.blogs.toggle-featured', $blog->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-orange-600 hover:text-orange-800" title="ویژه/غیرویژه">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('آیا از حذف این مقاله مطمئن هستید؟')">
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
                            <i class="fas fa-newspaper text-4xl mb-2 block"></i>
                            <p>هیچ مقاله‌ای یافت نشد.</p>
                            <a href="{{ route('admin.blogs.create') }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-plus ml-1"></i> اولین مقاله را بنویسید
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        
        @if($blogs->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $blogs->links("vendor.pagination.admin-indigo") }}
            </div>
        @endif
    </div>
</div>
@endsection