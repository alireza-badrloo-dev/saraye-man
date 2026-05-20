@extends('user.dashboard')
@section('baseContent')
<div class="p-4 w-full">
    <h1 class="text-xl mb-8 text-gray-800">دیدگاه های من</h1>
    
    <div class="w-full">
        @if($comments && $comments->count() > 0)
            <div class="space-y-4">
                @foreach($comments as $comment)
                    <div class=" rounded-xl  n border border-gray-300">
                        <div class="p-5">
                            <!-- هدر نظر -->
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <a href="/detailaccmmodation/{{ $comment->accommodation_id }}" class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                            {{ $comment->accommodation->title ?? 'اقامتگاه نامشخص' }}
                                        </a>
                                        @if($comment->room)
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                                                {{ $comment->room->title }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <span class="text-sm font-bold text-orange-500">{{ $comment->rating }}</span>
                                        <span class="text-xs text-gray-500">از 10</span>
                                    </div>
                                </div>
                                <div class="text-left">
                                    @if($comment->status == 'approved')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            <i class="fas fa-check-circle ml-1"></i> تایید شده
                                        </span>
                                    @elseif($comment->status == 'rejected')
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                            <i class="fas fa-times-circle ml-1"></i> رد شده
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                            <i class="fas fa-clock ml-1"></i> در انتظار تایید
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- عنوان نظر -->
                            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $comment->title }}</h3>
                            
                            <!-- متن نظر -->
                            <p class="text-gray-600 text-sm leading-relaxed mb-3">{{ $comment->comment }}</p>
                            
                            <!-- نکات مثبت -->
                            @if($comment->positive_points)
                                <div class="bg-green-50 rounded-lg p-3 mb-2">
                                    <p class="text-xs text-green-600 font-medium mb-1">
                                        <i class="fas fa-smile ml-1"></i> نکات مثبت:
                                    </p>
                                    <p class="text-sm text-gray-700">{{ $comment->positive_points }}</p>
                                </div>
                            @endif
                            
                            <!-- نکات منفی -->
                            @if($comment->negative_points)
                                <div class="bg-red-50 rounded-lg p-3">
                                    <p class="text-xs text-red-600 font-medium mb-1">
                                        <i class="fas fa-frown ml-1"></i> نکات منفی:
                                    </p>
                                    <p class="text-sm text-gray-700">{{ $comment->negative_points }}</p>
                                </div>
                            @endif
                            
                            <!-- تاریخ نظر -->
                            <div class="mt-3 pt-2 border-t border-gray-100">
                                <p class="text-xs text-gray-400">
                                    <i class="fas fa-calendar-alt ml-1"></i>
                                    تاریخ ثبت: {{ \Morilog\Jalali\Jalalian::fromCarbon($comment->created_at)->format('Y/m/d') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if(method_exists($comments, 'links'))
                <div class="mt-6">
                    {{ $comments->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12>
                <i class="fas fa-comment-slash text-gray-300 text-6xl mb-4 block"></i>
                <p class="text-gray-500 text-lg">شما هنوز نظری ثبت نکرده‌اید</p>
                <p class="text-gray-400 text-sm mt-2">با ثبت نظر، به دیگران در انتخاب بهتر کمک کنید</p>
                <a href="{{ route('home') }}" class="inline-block mt-4 bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg transition">
                    <i class="fas fa-search ml-2"></i>
                    مشاهده اقامتگاه‌ها
                </a>
            </div>
        @endif
    </div>
</div>
@endsection