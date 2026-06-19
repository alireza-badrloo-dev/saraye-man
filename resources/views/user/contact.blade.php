@extends('user.Layouts.master')



@section('Mycontent')
<div class="container mx-auto px-4 md:px-8 py-8 max-w-4xl">
    
    <!-- هدر -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">تماس با <span class="text-orange-500">ما</span></h1>
        <div class="w-16 h-0.5 bg-orange-500 mx-auto mt-2"></div>
        <p class="text-gray-600 mt-3 text-sm">ما همواره پاسخگوی شما هستیم</p>
    </div>

    <!-- نمایش پیام موفقیت -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">
        
        <!-- اطلاعات تماس -->
        <div class="md:col-span-1 space-y-4">
            <div class="bg-white rounded-xl border p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">تلفن</p>
                        <p class="text-sm font-medium text-gray-800">۰۲۱-۱۲۳۴۵۶۷۸</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">ایمیل</p>
                        <p class="text-sm font-medium text-gray-800">info@sarayeman.com</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">آدرس</p>
                        <p class="text-sm font-medium text-gray-800">تهران، خیابان ولیعصر</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">ساعات کاری</p>
                        <p class="text-sm font-medium text-gray-800">شنبه تا پنجشنبه ۹-۲۰</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- فرم تماس -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">ارسال پیام</h3>
                
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">نام و نام خانوادگی <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition @error('name') border-red-500 @enderror"
                               placeholder="نام خود را وارد کنید">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ایمیل <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition @error('email') border-red-500 @enderror"
                               placeholder="ایمیل خود را وارد کنید">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">شماره تماس</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"
                               placeholder="شماره تماس خود را وارد کنید">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">موضوع</label>
                        <input type="text" name="subject" value="{{ old('subject') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"
                               placeholder="موضوع پیام">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">متن پیام <span class="text-red-500">*</span></label>
                        <textarea name="message" rows="5" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition resize-none @error('message') border-red-500 @enderror"
                                  placeholder="پیام خود را بنویسید...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors">
                        ارسال پیام
                    </button>
                </form>
            </div>
        </div>

    </div>

    <!-- لینک برگشت -->
    <div class="text-center mt-6">
        <a href="{{ route('home') }}" class="text-orange-500 hover:text-orange-600 text-sm flex items-center justify-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            بازگشت به صفحه اصلی
        </a>
    </div>

</div>
@endsection