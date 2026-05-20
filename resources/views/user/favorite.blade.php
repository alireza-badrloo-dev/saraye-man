@extends('user.dashboard')
@section('baseContent')
<div class="p-4 w-full">
    <h1 class="text-xl mb-8 text-gray-800">علاقه مندی ها</h1>
    
    <div class="w-full">
        @if(isset($favourites) && $favourites->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  gap-6">
                @foreach($favourites as $item)
                    <div class=" rounded-xl  ">
                        <a href="{{ route('details', ['id' => $item->id]) }}" class="block p-4 space-y-3">
                            @php
                                $images = is_string($item->images) ? json_decode($item->images, true) : ($item->images ?? []);
                                $firstImage = $images[0] ?? null;
                                $rating = $item->rating ?? 0;
                                $full = floor($rating);
                                $half = $rating - $full >= 0.5 ? 1 : 0;
                                $empty = 5 - $full - $half;
                            @endphp
                            
                            @if($firstImage)
                                <img class="w-full h-48 object-cover rounded-md" src="{{ asset('storage/uplouds/' . $firstImage) }}" alt="{{ $item->title }}">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-md flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                            
                            <h2 class="text-md font-bold text-gray-800">{{ $item->title }}</h2>
                            
                            <div class="text-xs text-justify text-gray-600 line-clamp-2">
                                {{ $item->address }}
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <p class="text-gray-400 text-xs">
                                    از <span class="text-gray-600 text-sm">{{ number_format($item->rooms_min_price ?? 0) }} تومان</span> / 1 شب
                                </p>
                                
                                <div class="flex items-center text-gray-400" dir="ltr">
                                    @for ($i = 0; $i < $full; $i++)
                                        <span class="text-yellow-400">★</span>
                                    @endfor
                                    @if ($half)
                                        <span class="text-yellow-400">☆</span>
                                    @endif
                                    @for ($i = 0; $i < $empty; $i++)
                                        <span class="text-gray-300">★</span>
                                    @endfor
                                </div>
                            </div>
                        </a>
                        
                        <div class="px-4 pb-4">
                            <form action="{{ route('favourite.toggle', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full mt-2 py-2 text-center border border-red-300 text-red-500 rounded-lg hover:bg-red-50 transition">
                                    <i class="fa-solid fa-heart ml-1"></i>
                                    حذف از علاقه‌مندی‌ها
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 ">
                <i class="fa-regular fa-heart text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">لیست علاقه‌مندی‌های شما خالی است</p>
                <p class="text-gray-400 text-sm mt-2">با کلیک روی قلب ❤️ اقامتگاه‌های مورد علاقه خود را ذخیره کنید</p>
                <a href="{{ route('home') }}" class="inline-block mt-4 bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                    مشاهده اقامتگاه‌ها
                </a>
            </div>
        @endif
    </div>
</div>
@endsection