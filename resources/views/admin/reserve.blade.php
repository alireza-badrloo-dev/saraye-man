@extends('admin.Layout.master')
@section('Content')
<div class="p-4 md:p-6">
    <!-- عنوان صفحه و دکمه افزودن رزرو -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت رزروها</h1>
            <p class="text-gray-500 mt-1">لیست تمام رزروهای ثبت‌شده در سامانه</p>
        </div>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
            <i class="fas fa-plus"></i>
            <span>رزرو جدید</span>
        </button>
    </div>

    <!-- کارت‌های آماری رزروها -->
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
                    <p class="text-gray-500 text-sm">رزروهای فعال</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۸۹۲</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-check-circle text-xs ml-1"></i> در حال انجام
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
                    <p class="text-gray-500 text-sm">در انتظار پرداخت</p>
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

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-red-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">لغو شده</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۱۱۱</p>
                    <span class="text-red-600 text-xs bg-red-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-times-circle text-xs ml-1"></i> -۸٪ نسبت به قبل
                    </span>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-times-circle text-red-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- فیلترها و جستجو -->
    <div class="bg-white rounded-xl shadow-md p-5 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">جستجو</label>
                <input type="text" placeholder="نام مهمان، اقامتگاه..." 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option>همه</option>
                    <option>تایید شده</option>
                    <option>در انتظار</option>
                    <option>لغو شده</option>
                    <option>تکمیل شده</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">بازه زمانی</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option>امروز</option>
                    <option>این هفته</option>
                    <option>این ماه</option>
                    <option>سالیانه</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition-all">
                    <i class="fas fa-search ml-2"></i> جستجو
                </button>
            </div>
        </div>
    </div>

    <!-- جدول رزروها -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شناسه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">مهمان</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">اقامتگاه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ شروع</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ پایان</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">مبلغ</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۲۳۴۵</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۱۰</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۱۲</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">۱۲,۸۰۰,۰۰۰ تومان</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">تایید شده</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۲۳۴۶</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۱۵</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۱۸</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">۳۲,۵۰۰,۰۰۰ تومان</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">در انتظار</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۲۳۴۷</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۰۵</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۰۷</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">۷,۲۰۰,۰۰۰ تومان</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">تایید شده</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۲۳۴۸</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۲۰</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۲۵</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">۲۱,۴۰۰,۰۰۰ تومان</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">لغو شده</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۲۳۴۹</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۰۸</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">۱۴۰۳/۱۲/۰۹</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">۳,۹۰۰,۰۰۰ تومان</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">تکمیل شده</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors">
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
                نمایش <span class="font-medium">۱</span> تا <span class="font-medium">۵</span> از <span class="font-medium">۱,۲۴۸</span> نتیجه
            </div>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-all">قبلی</button>
                <button class="px-3 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all">۱</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-all">۲</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-all">۳</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-all">۴</button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition-all">بعدی</button>
            </div>
        </div>
    </div>

    <!-- بخش دسترسی سریع -->
    <div class="mt-8">
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4">عملیات سریع رزروها</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-plus-circle text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">رزرو جدید</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-print text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">چاپ فاکتور</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-download text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">خروجی Excel</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-chart-bar text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">گزارش رزروها</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection