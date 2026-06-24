@extends('user.Layouts.master')
@section('Mycontent')
<div class="mx-1 md:mx-20 xl:mx-40 py-8">
    
    <!-- هدر وبلاگ -->
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800"> وبلاگ <span class="text-orange-500">سرای من</span></h1>
        <p class="text-gray-500 mt-2">راهنمای سفر، معرفی اقامتگاه‌ها و نکات گردشگری</p>
        <div class="w-20 h-1 bg-orange-500 mx-auto mt-4 rounded-full"></div>
    </div>

    <!-- جستجو -->
    <div class="mb-8">
        <form action="{{ route('blog.search') }}" method="GET" class="max-w-2xl mx-auto">
            <div class="relative">
                <input type="text" name="search" placeholder="جستجو در وبلاگ..." 
                    class="w-full border border-gray-300 rounded-full px-6 py-3 pr-12 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2  text-gray-300 hover:text-orange-500 p-2 rounded-full transition">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- آخرین مقالات (نمایش اسلایدی) -->
    @if($latestPosts->count() > 0)
    <div class="mb-12">
        <h2 class="text-xl font-bold text-gray-800 mb-4"> آخرین مقالات</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestPosts as $post)
            <div class="bg-white rounded-xl  overflow-hidden  transition group">
                <a href="{{ route('blog.show', $post->slug) }}">
                    <div class="relative h-48">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                alt="{{ $post->title }}">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 bg-orange-500 text-white text-xs px-3 py-1 rounded-full">
                            جدید
                        </span>
                    </div>
                    <div class="p-4">
                        <h3 class="text-md font-bold text-gray-800 line-clamp-2">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $post->summary }}</p>
                        <div class="flex items-center justify-between mt-3 text-xs text-gray-400">
                            <span>{{ \Morilog\Jalali\Jalalian::fromCarbon($post->created_at)->format('Y/m/d') }}</span>
                            <span><i class="far fa-eye ml-1"></i> {{ $post->views }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- همه مقالات -->
    <div>
        <h2 class="text-xl font-bold text-gray-800 mb-4"> همه مقالات</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($posts as $post)
            <div class="bg-white rounded-xl  overflow-hidden  transition group">
                <a href="{{ route('blog.show', $post->slug) }}">
                    <div class="relative h-48">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                alt="{{ $post->title }}">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        @if($post->category)
                            <span class="absolute bottom-3 right-3 bg-gray-800/75 text-white text-xs px-3 py-1 rounded-full">
                                {{ $post->category }}
                            </span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-md font-bold text-gray-800 line-clamp-2">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $post->summary }}</p>
                        <div class="flex items-center justify-between mt-3 text-xs text-gray-400">
                            <span>{{ \Morilog\Jalali\Jalalian::fromCarbon($post->created_at)->format('Y/m/d') }}</span>
                            <span><i class="far fa-eye ml-1"></i> {{ $post->views }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">هیچ مقاله‌ای یافت نشد.</p>
            </div>
            @endforelse
        </div>

        <!-- صفحه‌بندی -->
        @if($posts->hasPages())
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection