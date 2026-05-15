@extends('admin.Layout.master')
@section('Content')
<div class="p-4 md:p-6">
    <!-- عنوان صفحه -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">گزارشات مالی</h1>
        <p class="text-gray-500 mt-1">مشاهده و تحلیل درآمدها، تراکنش‌ها و عملکرد مالی سامانه</p>
    </div>

    <!-- کارت‌های آماری مالی -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کل درآمد</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۱,۲۴۸,۵۰۰,۰۰۰</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-arrow-up text-xs ml-1"></i> +۱۸٪
                    </span>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-chart-line text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">درآمد ماه جاری</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۲۴۵,۸۰۰,۰۰۰</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-arrow-up text-xs ml-1"></i> +۱۲٪
                    </span>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کمیسیون سامانه</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۱۲۴,۸۵۰,۰۰۰</p>
                    <span class="text-yellow-600 text-xs bg-yellow-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-percent text-xs ml-1"></i> ۱۰٪
                    </span>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-hand-holding-usd text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-orange-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">تعداد تراکنش‌ها</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۳,۸۴۲</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-arrow-up text-xs ml-1"></i> +۲۳٪
                    </span>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <i class="fas fa-exchange-alt text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- فیلترهای گزارش -->
    <div class="bg-white rounded-xl shadow-md p-5 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">نوع گزارش</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option>همه تراکنش‌ها</option>
                    <option>رزروهای تکمیل شده</option>
                    <option>پرداخت‌های موفق</option>
                    <option>لغو و عودتی</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">بازه زمانی</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option>امروز</option>
                    <option>دیروز</option>
                    <option>این هفته</option>
                    <option>این ماه</option>
                    <option>سه ماه اخیر</option>
                    <option>سالیانه</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">از تاریخ</label>
                <input type="date" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">تا تاریخ</label>
                <input type="date" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-all">
                    <i class="fas fa-chart-line ml-2"></i> نمایش گزارش
                </button>
            </div>
        </div>
    </div>

    <!-- نمودار درآمد (نمودار خطی ساده با CSS) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-5">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="font-bold text-gray-800">روند درآمد ماهیانه</h3>
                    <p class="text-xs text-gray-500">مقایسه درآمد ۶ ماه اخیر</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-lg">هفتگی</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-lg">ماهیانه</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-lg">سالیانه</button>
                </div>
            </div>
            <div class="relative h-64 mt-6">
                <div class="absolute bottom-0 left-0 right-0 flex items-end justify-between gap-2 h-48">
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500 rounded-t-md transition-all duration-500 hover:bg-indigo-600" style="height: 120px;"></div>
                        <span class="text-xs text-gray-600 mt-2">مهر</span>
                        <span class="text-xs font-bold">۱۸۰M</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500 rounded-t-md transition-all duration-500 hover:bg-indigo-600" style="height: 95px;"></div>
                        <span class="text-xs text-gray-600 mt-2">آبان</span>
                        <span class="text-xs font-bold">۱۴۲M</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500 rounded-t-md transition-all duration-500 hover:bg-indigo-600" style="height: 145px;"></div>
                        <span class="text-xs text-gray-600 mt-2">آذر</span>
                        <span class="text-xs font-bold">۲۱۸M</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500 rounded-t-md transition-all duration-500 hover:bg-indigo-600" style="height: 200px;"></div>
                        <span class="text-xs text-gray-600 mt-2">دی</span>
                        <span class="text-xs font-bold">۳۰۰M</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500 rounded-t-md transition-all duration-500 hover:bg-indigo-600" style="height: 170px;"></div>
                        <span class="text-xs text-gray-600 mt-2">بهمن</span>
                        <span class="text-xs font-bold">۲۵۵M</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-600 rounded-t-md transition-all duration-500 hover:bg-indigo-700" style="height: 230px;"></div>
                        <span class="text-xs text-gray-600 mt-2">اسفند</span>
                        <span class="text-xs font-bold">۳۴۵M</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- توزیع درآمد بر اساس نوع اقامتگاه -->
        <div class="bg-white rounded-xl shadow-md p-5">
            <h3 class="font-bold text-gray-800 mb-4">توزیع درآمد بر اساس اقامتگاه</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>ویلای لاکچری</span>
                        <span class="font-semibold">۳۵٪</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 35%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>کلبه جنگلی</span>
                        <span class="font-semibold">۲۸٪</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 28%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>خانه سنتی</span>
                        <span class="font-semibold">۲۰٪</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: 20%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>سوئیت مدرن</span>
                        <span class="font-semibold">۱۲٪</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: 12%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>بوم‌گردی</span>
                        <span class="font-semibold">۵٪</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-500 h-2 rounded-full" style="width: 5%"></div>
                    </div>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">میانگین قیمت هر رزرو:</span>
                    <span class="font-bold text-gray-800">۱,۲۵۰,۰۰۰ تومان</span>
                </div>
            </div>
        </div>
    </div>

    <!-- جدول تراکنش‌های مالی -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800">لیست تراکنش‌های مالی</h3>
                <p class="text-xs text-gray-500">آخرین تراکنش‌های ثبت‌شده در سامانه</p>
            </div>
            <button class="text-indigo-600 hover:text-indigo-700 text-sm">
                <i class="fas fa-download ml-1"></i> خروجی Excel
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شناسه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کاربر</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">اقامتگاه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">مبلغ</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کمیسیون</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نوع</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#TR-۱۲۳۴۵</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۱۰</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-900">سارا محمدی</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">کلبه جنگلی سحر</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">۱۲,۸۰۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱,۲۸۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">پرداخت مستقیم</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">موفق</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#TR-۱۲۳۴۶</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۰۸</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                                    <i class="fas fa-user text-amber-600 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-900">رضا کریمی</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">ویلای لاکچری ساحلی</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">۳۲,۵۰۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۳,۲۵۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">کارت اعتباری</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">موفق</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#TR-۱۲۳۴۷</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۰۵</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-user text-emerald-600 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-900">مینا احمدی</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">خانه سنتی کاشان</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">۷,۲۰۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۷۲۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">پرداخت مستقیم</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">موفق</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#TR-۱۲۳۴۸</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۰۳</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                    <i class="fas fa-user text-red-600 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-900">علی رضایی</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">سوئیت مدرن الهیه</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-600">۲۱,۴۰۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۲,۱۴۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">در انتظار</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">در حال بررسی</span>
                        </td>
                     </tr>
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#TR-۱۲۳۴۹</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۳/۱۲/۰۱</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-user text-purple-600 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-900">نازنین زهرا</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">اقامتگاه بوم‌گردی</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">۳,۹۰۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۳۹۰,۰۰۰</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">پرداخت مستقیم</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">موفق</span>
                        </td>
                     </tr>
                </tbody>
             </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-500">
                نمایش <span class="font-medium">۱</span> تا <span class="font-medium">۵</span> از <span class="font-medium">۳,۸۴۲</span> تراکنش
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

    <!-- خلاصه مالی و بودجه -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl shadow-md p-6 text-white">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-indigo-100 text-sm">سهم سامانه از درآمدها</p>
                    <p class="text-3xl font-bold mt-1">۱۲۴,۸۵۰,۰۰۰</p>
                    <p class="text-indigo-200 text-xs mt-1">۱۰٪ کمیسیون از کل فروش</p>
                </div>
                <i class="fas fa-chart-pie text-4xl text-indigo-300"></i>
            </div>
            <div class="mt-4">
                <div class="flex justify-between text-sm">
                    <span>درآمد خالص مالکان:</span>
                    <span class="font-bold">۱,۱۲۳,۶۵۰,۰۰۰</span>
                </div>
                <div class="w-full bg-indigo-400 rounded-full h-1.5 mt-2">
                    <div class="bg-white h-1.5 rounded-full" style="width: 90%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="font-bold text-gray-800 mb-4">پیش‌بینی درآمد ماه آینده</h3>
            <div class="flex items-end gap-2 mb-4">
                <span class="text-3xl font-bold text-gray-800">۲۸۰,۰۰۰,۰۰۰</span>
                <span class="text-green-600 text-sm mb-1">+۱۵٪ نسبت به ماه جاری</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-indigo-600 h-2 rounded-full" style="width: 78%"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4 pt-4 border-t">
                <div>
                    <p class="text-xs text-gray-500">بهترین روز هفته</p>
                    <p class="font-semibold text-gray-800">پنجشنبه‌ها <i class="fas fa-chart-line text-green-500"></i></p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">میانگین روزانه</p>
                    <p class="font-semibold text-gray-800">۸,۲۰۰,۰۰۰ تومان</p>
                </div>
            </div>
        </div>
    </div>

    <!-- دسترسی سریع به گزارشات -->
    <div class="mt-6">
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4">گزارشات پیشرفته</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-file-pdf text-red-500 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">گزارش PDF</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-file-excel text-green-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">خروجی Excel</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-chart-bar text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">گزارش تحلیلی</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-print text-gray-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">چاپ گزارش</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection