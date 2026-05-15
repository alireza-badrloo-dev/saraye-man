@extends('admin.Layout.master')
@section('Content')
<div class="p-4 md:p-6">
    <!-- عنوان صفحه و دکمه افزودن کاربر -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت کاربران</h1>
            <p class="text-gray-500 mt-1">لیست تمام کاربران ثبت‌شده در سامانه</p>
        </div>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
            <i class="fas fa-plus"></i>
            <span>افزودن کاربر جدید</span>
        </button>
    </div>

    <!-- کارت‌های آماری کاربران -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کل کاربران</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۱,۲۴۸</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-arrow-up text-xs ml-1"></i> +۱۲٪
                    </span>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کاربران فعال</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۸۹۲</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-check-circle text-xs ml-1"></i> ۷۱٪
                    </span>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-user-check text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کاربران جدید (ماه)</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۱۴۲</p>
                    <span class="text-green-600 text-xs bg-green-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-user-plus text-xs ml-1"></i> +۱۸٪
                    </span>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-user-plus text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300 border-r-4 border-orange-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">کاربران مسدود</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">۲۴</p>
                    <span class="text-red-600 text-xs bg-red-100 px-2 py-1 rounded-full inline-flex items-center mt-2">
                        <i class="fas fa-ban text-xs ml-1"></i> -۵٪
                    </span>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <i class="fas fa-user-slash text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- فیلترها و جستجو -->
    <div class="bg-white rounded-xl shadow-md p-5 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">جستجو</label>
                <input type="text" placeholder="نام، ایمیل، شماره تماس..." 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">نقش کاربری</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option>همه</option>
                    <option>مدیر</option>
                    <option>کاربر عادی</option>
                    <option>مالک اقامتگاه</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option>همه</option>
                    <option>فعال</option>
                    <option>مسدود</option>
                    <option>در انتظار تایید</option>
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

    <!-- جدول کاربران -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شناسه</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کاربر</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نقش</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ایمیل</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شماره تماس</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ ثبت‌نام</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">رزروها</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- کاربر 1 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۰۰۱</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                                    س
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">سارا محمدی</p>
                                    <p class="text-xs text-gray-500">@sara.mohammadi</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">کاربر عادی</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">sara@gmail.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۰۹۱۲۱۲۳۴۵۶۷</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۲/۰۶/۱۵</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">۱۲</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">فعال</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <button class="text-blue-600 hover:text-blue-800 transition-colors" title="مشاهده">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors" title="ویرایش">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors" title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="text-orange-600 hover:text-orange-800 transition-colors" title="مسدود/فعال">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- کاربر 2 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۰۰۲</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center text-white font-bold">
                                    ر
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">رضا کریمی</p>
                                    <p class="text-xs text-gray-500">@reza.karimi</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700">مالک اقامتگاه</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">reza@gmail.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۰۹۱۲۳۳۴۴۵۵۶</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۲/۰۷/۲۰</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">۳۴</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">فعال</span>
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
                                <button class="text-orange-600 hover:text-orange-800 transition-colors">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- کاربر 3 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۰۰۳</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-amber-400 to-amber-600 flex items-center justify-center text-white font-bold">
                                    م
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">مینا احمدی</p>
                                    <p class="text-xs text-gray-500">@mina.ahmadi</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">مدیر</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">mina@admin.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۰۹۱۲۴۴۵۵۶۶۷</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۱/۱۲/۰۵</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">۵۶</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">فعال</span>
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
                                <button class="text-orange-600 hover:text-orange-800 transition-colors">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- کاربر 4 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۰۰۴</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-400 to-red-600 flex items-center justify-center text-white font-bold">
                                    ع
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">علی رضایی</p>
                                    <p class="text-xs text-gray-500">@ali.rezai</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">کاربر عادی</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">ali@gmail.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۰۹۱۲۵۵۶۶۷۷۸</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۲/۰۹/۱۰</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">۸</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">مسدود</span>
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
                                <button class="text-green-600 hover:text-green-800 transition-colors">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- کاربر 5 -->
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#۱۰۰۵</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold">
                                    ن
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">نازنین زهرا</p>
                                    <p class="text-xs text-gray-500">@nazanin.z</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700">مالک اقامتگاه</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">nazanin@gmail.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۰۹۱۲۶۶۷۷۸۸۹</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">۱۴۰۲/۱۰/۲۵</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">۲۳</td>
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
                                <button class="text-orange-600 hover:text-orange-800 transition-colors">
                                    <i class="fas fa-ban"></i>
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
            <h3 class="font-bold text-gray-800 text-lg mb-4">عملیات سریع کاربران</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-user-plus text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">کاربر جدید</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-user-tag text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">مدیریت نقش‌ها</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-chart-bar text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">آمار کاربران</span>
                </button>
                <button class="bg-white rounded-lg p-3 text-center hover:shadow-md transition-all group hover:translate-y-[-2px]">
                    <i class="fas fa-download text-indigo-600 text-2xl mb-2 block"></i>
                    <span class="text-sm text-gray-700">خروجی Excel</span>
                </button>
            </div>
        </div>
    </div>

    <!-- پیام Modal (برای نمایش اطلاعات بیشتر) -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" id="userModal">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">اطلاعات کاربر</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 pb-3 border-b">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-r from-indigo-400 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                            س
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">سارا محمدی</p>
                            <p class="text-sm text-gray-500">@sara.mohammadi</p>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">ایمیل:</span>
                        <span class="text-gray-800">sara@gmail.com</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">شماره تماس:</span>
                        <span class="text-gray-800">۰۹۱۲۱۲۳۴۵۶۷</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">تاریخ ثبت‌نام:</span>
                        <span class="text-gray-800">۱۴۰۲/۰۶/۱۵</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">وضعیت:</span>
                        <span class="text-green-600">فعال</span>
                    </div>
                </div>
                <div class="mt-6 flex gap-3">
                    <button class="flex-1 bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">ویرایش</button>
                    <button onclick="closeModal()" class="flex-1 border border-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-50 transition">بستن</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('userModal').classList.add('hidden');
        document.getElementById('userModal').classList.remove('flex');
    }
    
    
    document.querySelectorAll('.fa-eye').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('userModal').classList.remove('hidden');
            document.getElementById('userModal').classList.add('flex');
        });
    });
</script>
@endsection