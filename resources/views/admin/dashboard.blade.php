@extends('admin.Layout.master')
@section('Content')
    <div class="p-4 md:p-6">
       
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">داشبورد</h1>
            
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            
            <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">کل رزروها</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">۱,۲۴۸</p>
                        <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                            <i class="fas fa-arrow-up text-xs ml-1"></i> +۱۲٪
                        </span>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

           
            <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">درآمد کل (ماه جاری)</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">۲۴۵,۸۰۰,۰۰۰</p>
                        <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                            <i class="fas fa-arrow-up text-xs ml-1"></i> +۱۸٪
                        </span>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fa fa-dollar text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

           
            <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-purple-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">اقامتگاه‌های فعال</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">۳۲</p>
                        <span class="text-gray-500 text-xs mt-2 inline-block">از ۴۰ ثبت‌شده</span>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-building text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

           
            <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-orange-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">کاربران ثبت‌نام شده</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">۸۹۲</p>
                        <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                            <i class="fas fa-user-plus text-xs ml-1"></i> +۴۲ جدید
                        </span>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <i class="fas fa-users text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <div class="bg-white rounded-xl shadow-md p-5">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-800 text-lg">محبوب‌ترین اقامتگاه‌ها</h3>
                    <i class="fas fa-chart-line text-gray-400"></i>
                </div>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>کلبه جنگلی سحر</span>
                            <span class="font-semibold">۲۴۵ رزرو</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 95%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>ویلای لاکچری ساحلی</span>
                            <span class="font-semibold">۱۸۷ رزرو</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 72%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>خانه سنتی کاشان</span>
                            <span class="font-semibold">۱۶۳ رزرو</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 63%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>سوئیت مدرن الهیه</span>
                            <span class="font-semibold">۱۲۸ رزرو</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 49%"></div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-md p-5">
                <h3 class="font-bold text-gray-800 text-lg mb-4">خلاصه مالی ماه جاری</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center pb-2 border-b">
                        <span class="text-gray-600">مجموع درآمد</span>
                        <span class="font-bold text-gray-800">۲۴۵,۸۰۰,۰۰۰ تومان</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b">
                        <span class="text-gray-600">درآمد خالص (بعد از کمیسیون)</span>
                        <span class="font-bold text-green-600">۲۲۱,۲۲۰,۰۰۰ تومان</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b">
                        <span class="text-gray-600">کمیسیون سامانه (۱۰٪)</span>
                        <span class="font-bold text-red-500">۲۴,۵۸۰,۰۰۰ تومان</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-600">مقایسه با ماه قبل</span>
                        <span class="text-green-600 font-semibold"><i class="fas fa-arrow-up"></i> +۱۸.۵٪</span>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-5 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-800">آخرین رزروهای ثبت‌شده</h3>
                    <p class="text-gray-500 text-sm mt-1">۱۰ رزرو اخیر سیستم</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">مهمان</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">اقامتگاه</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">تاریخ</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">وضعیت</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600 text-sm"></i>
                                        </div>
                                        <span>سارا محمدی</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">کلبه جنگلی سحر</td>
                                <td class="px-6 py-4 text-sm">۱۴۰۳/۱۲/۱۰</td>
                                <td class="px-6 py-4"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">تایید شده</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                                            <i class="fas fa-user text-amber-600 text-sm"></i>
                                        </div>
                                        <span>رضا کریمی</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">ویلای لاکچری ساحلی</td>
                                <td class="px-6 py-4 text-sm">۱۴۰۳/۱۲/۱۵</td>
                                <td class="px-6 py-4"><span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">در انتظار</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                            <i class="fas fa-user text-emerald-600 text-sm"></i>
                                        </div>
                                        <span>مینا احمدی</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">خانه سنتی کاشان</td>
                                <td class="px-6 py-4 text-sm">۱۴۰۳/۱۲/۰۵</td>
                                <td class="px-6 py-4"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">تایید شده</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 text-center border-t">
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm">مشاهده همه رزروها <i class="fas fa-arrow-left mr-1"></i></a>
                </div>
            </div>

           
            <div class="bg-white rounded-xl shadow-md p-5">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-bell text-yellow-500"></i>
                    آخرین فعالیت‌ها
                </h3>
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    <div class="flex gap-3 text-sm pb-3 border-b">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <div>
                            <p><strong>رزرو جدید</strong> توسط سارا محمدی</p>
                            <p class="text-xs text-gray-400">۲ دقیقه پیش</p>
                        </div>
                    </div>
                    <div class="flex gap-3 text-sm pb-3 border-b">
                        <i class="fas fa-star text-yellow-500 mt-1"></i>
                        <div>
                            <p><strong>امتیاز ۵ ستاره</strong> برای ویلای ساحلی</p>
                            <p class="text-xs text-gray-400">۱ ساعت پیش</p>
                        </div>
                    </div>
                    <div class="flex gap-3 text-sm pb-3 border-b">
                        <i class="fas fa-home text-blue-500 mt-1"></i>
                        <div>
                            <p><strong>اقامتگاه جدید</strong> "خانه باغ بهار" اضافه شد</p>
                            <p class="text-xs text-gray-400">۳ ساعت پیش</p>
                        </div>
                    </div>
                    <div class="flex gap-3 text-sm pb-3 border-b">
                        <i class="fas fa-user-plus text-green-500 mt-1"></i>
                        <div>
                            <p><strong>کاربر جدید</strong> محمد حسینی ثبت‌نام کرد</p>
                            <p class="text-xs text-gray-400">۵ ساعت پیش</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
            <div class="bg-white rounded-xl shadow-md p-5">
                <h3 class="font-bold text-gray-800 mb-4">وضعیت تکمیل اطلاعات اقامتگاه‌ها</h3>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>تصاویر آپلود شده</span>
                            <span>۲۸/۳۲ اقامتگاه</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 87%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>قیمت‌گذاری کامل</span>
                            <span>۳۰/۳۲ اقامتگاه</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 94%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>توضیحات تکمیل شده</span>
                            <span>۲۶/۳۲ اقامتگاه</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 81%"></div>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="bg-white rounded-xl shadow-md p-5">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center justify-between">
                    <span><i class="fas fa-comment-dots text-blue-500 ml-2"></i> جدیدترین نظرات</span>
                    <a href="#" class="text-xs text-blue-600">مشاهده همه</a>
                </h3>
                <div class="space-y-3">
                    <div class="border-b pb-3">
                        <p class="text-sm text-gray-700">"اقامتگاه فوق‌العاده‌ای بود، قطعاً دوباره رزرو می‌کنم"</p>
                        <div class="flex justify-between mt-1">
                            <span class="text-xs text-gray-500">- علی رضایی</span>
                            <div class="text-yellow-500 text-xs">★★★★★</div>
                        </div>
                    </div>
                    <div class="border-b pb-3">
                        <p class="text-sm text-gray-700">"خانه بسیار تمیز و دکوراسیون عالی، پشتیبانی خوب"</p>
                        <div class="flex justify-between mt-1">
                            <span class="text-xs text-gray-500">- نرگس محمدی</span>
                            <div class="text-yellow-500 text-xs">★★★★☆</div>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">"موقعیت مکانی عالی، دسترسی به مراکز خرید"</p>
                        <div class="flex justify-between mt-1">
                            <span class="text-xs text-gray-500">- سعید احمدی</span>
                            <div class="text-yellow-500 text-xs">★★★★★</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="mt-8">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6">
                <h3 class="font-bold text-gray-800 text-lg mb-4">دسترسی سریع</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <a href="#" class="bg-white rounded-lg p-3 text-center hover:shadow-md transition group">
                        <i class="fas fa-plus-circle text-blue-600 text-2xl mb-2 block"></i>
                        <span class="text-sm text-gray-700">افزودن اقامتگاه جدید</span>
                    </a>
                    <a href="#" class="bg-white rounded-lg p-3 text-center hover:shadow-md transition group">
                        <i class="fas fa-calendar-alt text-green-600 text-2xl mb-2 block"></i>
                        <span class="text-sm text-gray-700">مدیریت رزروها</span>
                    </a>
                    <a href="#" class="bg-white rounded-lg p-3 text-center hover:shadow-md transition group">
                        <i class="fas fa-chart-bar text-purple-600 text-2xl mb-2 block"></i>
                        <span class="text-sm text-gray-700">گزارشات مالی</span>
                    </a>
                    <a href="#" class="bg-white rounded-lg p-3 text-center hover:shadow-md transition group">
                        <i class="fas fa-cog text-gray-600 text-2xl mb-2 block"></i>
                        <span class="text-sm text-gray-700">تنظیمات سامانه</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection