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
            <h3 class="font-bold text-gray-800 text-lg">ویرایش ادمین</h3>
        </div>

        <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نام <span class="text-red-500">*</span></label>
                    <input type="text" name="first_name" value="{{ old('first_name', $admin->first_name) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @error('first_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نام خانوادگی <span class="text-red-500">*</span></label>
                    <input type="text" name="last_name" value="{{ old('last_name', $admin->last_name) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @error('last_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">ایمیل <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">شماره تماس</label>
                    <input type="tel" name="mobile" value="{{ old('mobile', $admin->mobile) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @error('mobile') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رمز عبور (برای تغییر وارد کنید)</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تکرار رمز عبور</label>
                    <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نقش <span class="text-red-500">*</span></label>
                    <select name="role" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="admin" {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>ادمین</option>
                        <option value="moderator" {{ old('role', $admin->role) == 'moderator' ? 'selected' : '' }}>مدیر محتوا</option>
                        <option value="super_admin" {{ old('role', $admin->role) == 'super_admin' ? 'selected' : '' }}>سوپر ادمین</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جنسیت</label>
                    <select name="gender" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="">انتخاب کنید</option>
                        <option value="male" {{ old('gender', $admin->gender) == 'male' ? 'selected' : '' }}>مرد</option>
                        <option value="female" {{ old('gender', $admin->gender) == 'female' ? 'selected' : '' }}>زن</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">کد ملی</label>
                    <input type="text" name="national_code" value="{{ old('national_code', $admin->national_code) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تاریخ تولد</label>
                    <input type="text" name="birth_date" class="datepicker w-full border border-gray-300 rounded-lg px-4 py-2" value="{{ $admin->birth_date ? \Morilog\Jalali\Jalalian::fromCarbon($admin->birth_date)->format('Y/m/d') : '' }}">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">آدرس</label>
                    <textarea name="address" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('address', $admin->address) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تصویر پروفایل</label>
                    @if($admin->profile_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/admins/' . $admin->profile_image) }}" class="w-16 h-16 rounded-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="profile_image" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="active" {{ old('status', $admin->status) == 'active' ? 'selected' : '' }}>فعال</option>
                        <option value="inactive" {{ old('status', $admin->status) == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                        <option value="blocked" {{ old('status', $admin->status) == 'blocked' ? 'selected' : '' }}>مسدود</option>
                    </select>
                </div>
            </div>

            <div class="p-6 border-t flex justify-end gap-3">
                <a href="{{ route('admin.admins') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">انصراف</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">بروزرسانی</button>
            </div>
        </form>
    </div>
</div>

<script>
    flatpickr(".datepicker", {
        locale: "fa",
        dateFormat: "Y/m/d",
        maxDate: "today"
    });
</script>
@endsection