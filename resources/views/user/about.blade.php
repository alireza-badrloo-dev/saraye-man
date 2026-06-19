@extends('user.Layouts.master')
@section('Mycontent')
 
<div class="container mx-auto px-4 md:px-8 py-8 max-w-3xl">
    
    <!-- هدر -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">درباره <span class="text-orange-500">سرای من</span></h1>
        <div class="w-16 h-0.5 bg-orange-500 mx-auto mt-2"></div>
    </div>

    <!-- محتوای اصلی -->
    <div class="bg-white rounded-xl  p-6 md:p-8">
        
        <div class="space-y-5 text-gray-700 leading-relaxed">
            
            <p>
                <span class="font-bold text-orange-500">سرای من</span> در سال ۱۳۹۵ با هدف ارائه بهترین تجربه اقامت برای مسافران در سراسر ایران شروع به کار کرد. 
                ما معتقدیم هر سفر باید خاطره‌ای ماندگار باشد و اقامتگاه مناسب، قلب این خاطره است.
            </p>

            <p>
                امروز پس از سال‌ها تلاش، با جمع‌آوری بهترین اقامتگاه‌های بوم‌گردی، ویلاها و سوئیت‌های مدرن در سراسر کشور، 
                میزبان هزاران مسافر از اقشار مختلف جامعه بوده‌ایم و همواره سعی کرده‌ایم تا سطح کیفی خدمات خود را ارتقا دهیم.
            </p>

            <p>
                هدف ما در <span class="font-bold text-orange-500">سرای من</span> ایجاد بستری امن و شفاف برای مسافران است تا بتوانند با خیال راحت، 
                بهترین اقامتگاه را مطابق با سلیقه و بودجه خود انتخاب کنند و سفری بی‌دغدغه را تجربه نمایند.
            </p>

            <div class="border-r-4 border-orange-500 pr-4 my-6 bg-orange-50 p-4 rounded-lg">
                <p class="text-gray-700 italic">
                    "ما معتقدیم که مهمان‌نوازی ایرانی، همواره یکی از افتخارات ما بوده و هست. 
                    <span class="font-bold text-orange-500">سرای من</span> تلاش می‌کند تا این فرهنگ را در قالب خدمات مدرن به مسافران ارائه دهد."
                </p>
            </div>

            <p>
                با <span class="font-bold text-orange-500">سرای من</span> سفر را آسان‌تر و خاطره‌انگیزتر کنید. 
                ما در تمام مراحل سفر، از انتخاب اقامتگاه تا پایان سفر، همراه شما هستیم.
            </p>

            <div class="mt-6 pt-4 border-t border-gray-200">
                <div class="flex flex-wrap gap-6 text-sm">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>۰۲۱-۱۲۳۴۵۶۷۸</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>info@sarayeman.com</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>تهران، خیابان ولیعصر</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

   
    

</div>


@endsection


