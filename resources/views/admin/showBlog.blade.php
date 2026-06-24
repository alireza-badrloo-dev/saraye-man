@extends('admin.Layout.master')

@section('Content')
<div class="p-4 md:p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">📄 {{ $blog->title }}</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.blogs.edit', $blog->id) }}" 
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition text-sm">
                <i class="fas fa-edit ml-1"></i> ویرایش
            </a>
            <a href="{{ route('admin.blogs.index') }}" 
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition text-sm">
                <i class="fas fa-arrow-right ml-1"></i> بازگشت
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" 
                class="w-full h-64 object-cover" alt="{{ $blog->title }}">
        @endif

        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-500">وضعیت</p>
                    @if($blog->status == 'published')
                        <span class="text-green-600 font-medium"><i class="fas fa-check-circle ml-1"></i> منتشر شده</span>
                    @elseif($blog->status == 'draft')
                        <span class="text-yellow-600 font-medium"><i class="fas fa-pen-fancy ml-1"></i> پیش‌نویس</span>
                    @else
                        <span class="text-gray-600 font-medium"><i class="fas fa-archive ml-1"></i> بایگانی</span>
                    @endif
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-500">دسته‌بندی</p>
                    <p class="font-medium">{{ $blog->category ?? 'بدون دسته' }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-500">بازدید</p>
                    <p class="font-medium">{{ $blog->views }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-500">تاریخ انتشار</p>
                    <p class="font-medium"> {{ \Morilog\Jalali\Jalalian::fromCarbon($blog->created_at)->format('Y/m/d') }}</p>
                </div>
            </div>

            @if($blog->summary)
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-gray-700 mb-2">خلاصه</h3>
                    <p class="text-gray-600">{{ $blog->summary }}</p>
                </div>
            @endif

            <div class="mb-6">
                <h3 class="text-sm font-bold text-gray-700 mb-2">محتوا</h3>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! $blog->content !!}
                </div>
            </div>

            @if($blog->accommodation)
                <div class="mt-6 p-4 bg-indigo-50 rounded-xl border border-indigo-200">
                    <h3 class="text-sm font-bold text-gray-700 mb-2"> اقامتگاه مرتبط</h3>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">{{ $blog->accommodation->title }}</p>
                            <p class="text-sm text-gray-500">{{ $blog->accommodation->address }}</p>
                            @if($blog->accommodation->city)
                                <p class="text-sm text-gray-500">شهر: {{ $blog->accommodation->city->name }}</p>
                            @endif
                        </div>
                        <a href="{{ route('admin.accommodation.show', $blog->accommodation->id) }}" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                            <i class="fas fa-eye ml-1"></i> مشاهده اقامتگاه
                        </a>
                    </div>
                </div>
            @endif

            @if($blog->city)
                <div class="mt-4 p-4 bg-green-50 rounded-xl border border-green-200">
                    <h3 class="text-sm font-bold text-gray-700 mb-2"> شهر مرتبط</h3>
                    <div class="flex items-center justify-between">
                        <p class="font-medium text-gray-800">{{ $blog->city->name }}</p>
                        <a href="{{ route('admin.cities.edit', $blog->city->id) }}" 
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition">
                            <i class="fas fa-eye ml-1"></i> مشاهده شهر
                        </a>
                    </div>
                </div>
            @endif

            @if($blog->author)
                <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <h3 class="text-sm font-bold text-gray-700 mb-2"> نویسنده</h3>
                    <p class="font-medium text-gray-800">{{ $blog->author }}</p>
                </div>
            @endif

            @if($blog->is_featured)
                <div class="mt-4 p-4 bg-orange-50 rounded-xl border border-orange-200">
                    <p class="text-orange-600 font-medium"><i class="fas fa-star ml-1"></i> این مقاله در بخش ویژه نمایش داده می‌شود</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection