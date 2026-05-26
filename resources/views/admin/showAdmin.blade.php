@extends('admin.Layout.master')
@section('Content')
<div class="p-4 md:p-6">
    <div class="mb-6">
        <a href="{{ route('admin.admins') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800">
            <i class="fas fa-arrow-right"></i>
            بازگشت به لیست ادمین‌ها
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b bg-gray-50">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-gray-800 text-lg">جزئیات ادمین</h3>
                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-edit"></i> ویرایش
                </a>
            </div>
        </div>

        <div class="p-6">
            <div class="flex items-center gap-4 mb-6 pb-4 border-b">
                @if($admin->profile_image)
                    <img src="{{ asset('storage/admins/' . $admin->profile_image) }}" class="w-20 h-20 rounded-full object-cover">
                @else
                    <div class="w-20 h-20 rounded-full bg-gradient-to-r from-indigo-500 to-indigo-600 flex items-center justify-center text-white text-3xl font-bold">
                        {{ substr($admin->first_name ?? 'ک', 0, 1) }}
                    </div>
                @endif
                <div>
                    <p class="text-xl font-bold text-gray-800">{{ $admin->first_name }} {{ $admin->last_name }}</p>
                    <p class="text-gray-500">{{ $admin->email }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">نام:</span>
                        <span class="text-gray-800">{{ $admin->first_name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">نام خانوادگی:</span>
                        <span class="text-gray-800">{{ $admin->last_name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">ایمیل:</span>
                        <span class="text-gray-800">{{ $admin->email ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">شماره تماس:</span>
                        <span class="text-gray-800">{{ $admin->mobile ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">جنسیت:</span>
                        <span class="text-gray-800">{{ $admin->gender == 'male' ? 'مرد' : ($admin->gender == 'female' ? 'زن' : '-') }}</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">کد ملی:</span>
                        <span class="text-gray-800">{{ $admin->national_code ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">تاریخ تولد:</span>
                        <span class="text-gray-800">{{ $admin->birth_date ? \Morilog\Jalali\Jalalian::fromCarbon($admin->birth_date)->format('Y/m/d') : '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">نقش:</span>
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $admin->role == 'super_admin' ? 'bg-red-100 text-red-700' : ($admin->role == 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ $admin->role == 'super_admin' ? 'سوپر ادمین' : ($admin->role == 'admin' ? 'ادمین' : 'مدیر محتوا') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">وضعیت:</span>
                        <span class="px-2 py-1 text-xs rounded-full {{ $admin->status == 'active' ? 'bg-green-100 text-green-700' : ($admin->status == 'blocked' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ $admin->status == 'active' ? 'فعال' : ($admin->status == 'blocked' ? 'مسدود' : 'غیرفعال') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">آخرین ورود:</span>
                        <span class="text-gray-800">{{ $admin->last_login_at ? \Morilog\Jalali\Jalalian::fromCarbon($admin->last_login_at)->format('Y/m/d H:i') : '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">تاریخ ثبت:</span>
                        <span class="text-gray-800">{{ $admin->created_at ? \Morilog\Jalali\Jalalian::fromCarbon($admin->created_at)->format('Y/m/d') : '-' }}</span>
                    </div>
                </div>

                @if($admin->address)
                <div class="md:col-span-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">آدرس:</span>
                        <span class="text-gray-800">{{ $admin->address }}</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection