@extends('user.dashboard')
@section('baseContent')
    <form action= "{{ route('user.update') }}"  method="POST">
        @csrf

        <div class="border border-gray-300 rounded-lg p-4">
            <div class="flex justify-between items-center w-full mb-8">
                <div>
                    <h1 class="text-gray-800 text-xl">حساب کاربری</h1>
                </div>
                 <div class="flex items-center p-4">
                <button
                    class="me-3 px-2 py-1 border bg-orange-500 text-white rounded-md hover:bg-orange-600 cursor-pointer flex items-center"
                    name="submit" type="submit">ذخیره</button>

                <a href="{{ route('user.profile') }}"
                    class=" px-2 py-1 border border-orange-500 text-orange-500 rounded-md hover:bg-orange-100 cursor-pointer flex items-center">
                    انصراف
                </a>
            </div>
            </div>

            <div class="p-4">
                <p class="text-base text-gray-800">حساب کاربری</p>

                <div class="grid grid-cols-2 p-6">
                    <div class="col-span-1 space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-2">نام</p>
                            <input type="text" name="first_name"
                                value="{{ old('first_name', auth()->user()->first_name) }}"
                                class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md">
                            @error('first_name')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-2">ملیت</p>
                            <input type="text" name="nationality"
                                value="{{ old('nationality', auth()->user()->nationality) }}"
                                class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md">
                            @error('nationality')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-2">کد ملی</p>
                            <input type="text" name="national_id"
                                value="{{ old('national_id', auth()->user()->national_id) }}"
                                class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md">
                            @error('national_id')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-2">کد پستی</p>
                            <input type="text" name="postal_code"
                                value="{{ old('postal_code', auth()->user()->postal_code) }}"
                                class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md">
                            @error('postal_code')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-1 space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-2">نام خانوادگی</p>
                            <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}"
                                class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md">
                            @error('last_name')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-2">جنسیت</p>
                            <select class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md"
                                name="gender" id="gender">
                                <option value="اقا"
                                    {{ old('gender', auth()->user()->gender) == 'اقا' ? 'selected' : '' }}>اقا</option>
                                <option value="خانم"
                                    {{ old('gender', auth()->user()->gender) == 'خانم' ? 'selected' : '' }}>خانم</option>
                            </select>
                            @error('gender')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-2">تاریخ تولد</p>
                            <input type="text" name="birth_date"
                                value="{{ old('birth_date', auth()->user()->birth_date) }}" placeholder="مثال: 1403/01/15"
                                class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md" />
                                @error('birth_date')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-2">آدرس</p>
                            <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}"
                                class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md">
                                  @error('address')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <p class="text-base text-gray-800 mt-6">راه های ارتباطی</p>

                <div class="grid grid-cols-2 p-6">
                    <div class="col-span-1 space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-2">شماره همراه</p>
                            <input type="text" disabled
                                class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md"
                                value="{{ auth()->user()->mobile }}">
                                  @error('mobile')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-1 space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-2">پست الکترونیکی</p>
                            <input type="text" disabled
                                class="p-1 text-xs text-gray-800 w-3/4 border border-gray-300 rounded-md"
                                value="{{ auth()->user()->email }}">
                                  @error('email')
                                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center p-4">
                <button
                    class="me-3 px-2 py-1 border bg-orange-500 text-white rounded-md hover:bg-orange-600 cursor-pointer flex items-center"
                    name="submit" type="submit">ذخیره</button>

                <a href="{{ route('user.profile') }}"
                    class="me-3 px-2 py-1 border border-orange-500 text-orange-500 rounded-md hover:bg-orange-100 cursor-pointer flex items-center">
                    انصراف
                </a>
            </div>
        </div>
    </form>
@endsection
