@extends('user.Layouts.master')
@section('Mycontent')
<div class="mx-1 md:mx-20 xl:mx-40 py-8">
    
    <!-- مسیر راهنما -->
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-orange-500">خانه</a>
        <span class="mx-2">/</span>
        <a href="{{ route('blog.index') }}" class="hover:text-orange-500">وبلاگ</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700">{{ $post->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- محتوای اصلی -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl  overflow-hidden">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" 
                        class="w-full h-96 object-cover"
                        alt="{{ $post->title }}">
                @endif
                
                <div class="p-6">
                    <div class="flex items-center gap-3 text-sm text-gray-500 mb-4">
                        <span>{{ \Morilog\Jalali\Jalalian::fromCarbon($post->created_at)->format('Y/m/d') }}</span>
                        <span>|</span>
                        <span><i class="far fa-eye ml-1"></i> {{ $post->views }}</span>
                        @if($post->category)
                            <span>|</span>
                            <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded-full text-xs">{{ $post->category }}</span>
                        @endif
                    </div>

                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
                    
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! $post->content !!}
                    </div>

                    @if($post->accommodation)
                        <div class="mt-8 p-4 bg-orange-50 rounded-xl border border-orange-200">
                            <h3 class="text-md font-bold text-gray-800 mb-2">🏠 معرفی اقامتگاه</h3>
                            <a href="{{ route('details', $post->accommodation->id) }}" class="text-orange-500 hover:text-orange-600">
                                {{ $post->accommodation->title }}
                            </a>
                            <p class="text-sm text-gray-500 mt-1">{{ $post->accommodation->address }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- سایدبار -->
        <div class="space-y-6">
            <!-- مقالات مرتبط -->
            @if($relatedPosts->count() > 0)
            <div class="bg-white  border-2 border-gray-300 p-4">
                <h3 class="text-md font-bold text-gray-800 mb-4"> مقالات مرتبط</h3>
                <div class="space-y-4">
                    @foreach($relatedPosts as $related)
                    <a href="{{ route('blog.show', $related->slug) }}" class="flex items-center gap-3 hover:bg-gray-50 p-2 rounded-lg transition">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" 
                                    class="w-full h-full object-cover" alt="">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-800 line-clamp-2">{{ $related->title }}</h4>
                            <p class="text-xs text-gray-400">{{ $related->published_at ? $related->published_at->format('Y/m/d') : '' }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection