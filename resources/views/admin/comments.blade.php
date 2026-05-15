@extends('admin.Layout.master')
@section('Content')
<div class="p-4 md:p-6">
    <!-- عنوان صفحه -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت نظرات و پیشنهادات</h1>
        <p class="text-gray-500 mt-1">مشاهده، پاسخ و مدیریت نظرات کاربران درباره اقامتگاه‌ها</p>
    </div>

    <!-- کارت‌های آماری نظرات -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کل نظرات</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۱,۲۴۸</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-arrow-up text-xs ml-1"></i> +۱۲٪
                    </span>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-comments text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">تایید شده</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۸۹۲</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-check-circle text-xs ml-1"></i> ۷۱٪
                    </span>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">در انتظار تایید</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۲۴۵</p>
                    <span class="text-yellow-600 text-xs bg-yellow-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-clock text-xs ml-1"></i> نیاز به بررسی
                    </span>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">میانگین امتیاز</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۴.۸</p>
                    <span class="text-yellow-600 text-xs bg-yellow-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-star text-xs ml-1"></i> از ۵
                    </span>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-star text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- فیلترها و جستجو -->
    <div class="bg-white rounded-xl shadow-md p-5 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">جستجو</label>
                <input type="text" placeholder="نام کاربر، متن نظر..." 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option>همه</option>
                    <option>تایید شده</option>
                    <option>در انتظار تایید</option>
                    <option>رد شده</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">امتیاز</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option>همه</option>
                    <option>۵ ستاره</option>
                    <option>۴ ستاره</option>
                    <option>۳ ستاره</option>
                    <option>۲ ستاره</option>
                    <option>۱ ستاره</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">اقامتگاه</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option>همه اقامتگاه‌ها</option>
                    <option>کلبه جنگلی سحر</option>
                    <option>ویلای لاکچری ساحلی</option>
                    <option>خانه سنتی کاشان</option>
                    <option>سوئیت مدرن الهیه</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-all">
                    <i class="fas fa-search ml-2"></i> جستجو
                </button>
            </div>
        </div>
    </div>

    <!-- جدول نظرات -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800">لیست نظرات کاربران</h3>
                <p class="text-xs text-gray-500">آخرین نظرات ثبت‌شده در سامانه</p>
            </div>
            <div class="flex gap-2">
                <button class="text-green-600 hover:text-green-700 text-sm">
                    <i class="fas fa-check-double ml-1"></i> تایید همه
                </button>
                <button class="text-red-600 hover:text-red-700 text-sm">
                    <i class="fas fa-trash-alt ml-1"></i> حذف انتخاب‌شده‌ها
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" class="rounded border-gray-300">
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کاربر</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">اقامتگاه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نظر</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">امتیاز</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- نظر 1 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">سارا محمدی</p>
                                    <p class="text-xs text-gray-500">sara@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">کلبه جنگلی سحر</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                            <p class="truncate">اقامتگاه فوق‌العاده‌ای بود، طبیعت بی‌نظیر و امکانات عالی. حتماً دوباره سفر می‌کنم...</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-0.5">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۱۰</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">تایید شده</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button onclick="showCommentDetail(1)" class="text-blue-600 hover:text-blue-800 transition-colors" title="مشاهده">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors" title="پاسخ">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors" title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- نظر 2 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                                    <i class="fas fa-user text-amber-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">رضا کریمی</p>
                                    <p class="text-xs text-gray-500">reza@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">ویلای لاکچری ساحلی</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                            <p class="truncate">خوب بود ولی امکانات می‌تونست بهتر باشه. استخر خیلی کوچیک بود...</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-0.5">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="far fa-star text-gray-300 text-sm"></i>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۰۸</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">در انتظار</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button onclick="showCommentDetail(2)" class="text-blue-600 hover:text-blue-800 transition-colors" title="مشاهده">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors" title="پاسخ">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors" title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- نظر 3 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-user text-emerald-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">مینا احمدی</p>
                                    <p class="text-xs text-gray-500">mina@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">خانه سنتی کاشان</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                            <p class="truncate">معماری بی‌نظیر، حس و حال سنتی فوق‌العاده. حتماً به دوستانم پیشنهاد می‌کنم...</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-0.5">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۰۵</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">تایید شده</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button onclick="showCommentDetail(3)" class="text-blue-600 hover:text-blue-800 transition-colors" title="مشاهده">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors" title="پاسخ">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors" title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- نظر 4 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                    <i class="fas fa-user text-red-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">علی رضایی</p>
                                    <p class="text-xs text-gray-500">ali@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">سوئیت مدرن الهیه</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                            <p class="truncate">قیمت بالا نسبت به امکانات، اتاق‌ها کوچیک بودن. ارزش این قیمت رو نداره...</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-0.5">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="far fa-star text-gray-300 text-sm"></i>
                                <i class="far fa-star text-gray-300 text-sm"></i>
                                <i class="far fa-star text-gray-300 text-sm"></i>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۰۳</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">رد شده</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button onclick="showCommentDetail(4)" class="text-blue-600 hover:text-blue-800 transition-colors" title="مشاهده">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors" title="پاسخ">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors" title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- نظر 5 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-user text-purple-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">نازنین زهرا</p>
                                    <p class="text-xs text-gray-500">nazanin@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">اقامتگاه بوم‌گردی</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                            <p class="truncate">تجربه متفاوت و جذاب، غذاهای محلی عالی، کادر پذیرایی بسیار خوش‌برخورد...</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-0.5">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۰۱</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">تایید شده</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button onclick="showCommentDetail(5)" class="text-blue-600 hover:text-blue-800 transition-colors" title="مشاهده">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors" title="پاسخ">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors" title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-500">
                نمایش <span class="font-medium">۱</span> تا <span class="font-medium">۵</span> از <span class="font-medium">۱,۲۴۸</span> نظر
            </div>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-all">قبلی</button>
                <button class="px-3 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all">۱</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-all">۲</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-all">۳</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-all">بعدی</button>
            </div>
        </div>
    </div>

    <!-- دسترسی سریع -->
    <div class="mt-8">
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4">عملیات سریع</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-envelope text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">ارسال خبرنامه</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-chart-bar text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">گزارش نظرات</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-download text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">خروجی Excel</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-cog text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">تنظیمات نظرات</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal نمایش جزئیات نظر -->
<div id="commentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">جزئیات نظر</h3>
                <button onclick="closeCommentModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center gap-3 pb-3 border-b">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                        <i class="fas fa-user text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800">سارا محمدی</p>
                        <p class="text-sm text-gray-500">sara@gmail.com</p>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">اقامتگاه:</p>
                    <p class="text-gray-800">کلبه جنگلی سحر</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">امتیاز:</p>
                    <div class="flex items-center gap-0.5 mt-1">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">متن نظر:</p>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg mt-1">
                        اقامتگاه فوق‌العاده‌ای بود، طبیعت بی‌نظیر و امکانات عالی. 
                        کادر پذیرایی بسیار خوش‌برخورد و محیط کاملاً تمیز و مرتب. 
                        حتماً دوباره به این مکان سفر خواهم کرد و به دوستانم نیز پیشنهاد می‌کنم.
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">پاسخ ادمین:</p>
                    <textarea rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500" 
                              placeholder="پاسخ خود را بنویسید..."></textarea>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button class="flex-1 bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">ارسال پاسخ</button>
                <button onclick="closeCommentModal()" class="flex-1 border border-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-50 transition">بستن</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showCommentDetail(id) {
        document.getElementById('commentModal').classList.remove('hidden');
        document.getElementById('commentModal').classList.add('flex');
    }
    
    function closeCommentModal() {
        document.getElementById('commentModal').classList.add('hidden');
        document.getElementById('commentModal').classList.remove('flex');
    }
    
    
    document.getElementById('commentModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCommentModal();
        }
    });
</script>
@endsection