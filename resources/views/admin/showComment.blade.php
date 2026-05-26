@extends('admin.Layout.master')
@section('Content')
    <div class="p-4 md:p-6">
        <div class="mb-6">
            <a href="{{ route('admin.comments') }}"
                class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-right"></i>
                بازگشت به لیست نظرات
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b bg-gray-50">
                <h3 class="font-bold text-gray-800 text-lg">جزئیات نظر</h3>
            </div>

            <div class="p-6">
                <form action="{{ route('admin.comments.update-status', $comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- اطلاعات کاربر -->
                        <div class="flex items-center gap-3 pb-3 border-b">
                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-user text-indigo-600 text-base"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">{{ $comment->user->first_name ?? '' }}
                                    {{ $comment->user->last_name ?? '' }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->user->email ?? '' }}</p>
                            </div>
                        </div>

                        <!-- اقامتگاه -->
                        <div class="flex justify-between">
                            <span class="text-gray-600">اقامتگاه:</span>
                            <span class="text-gray-800 font-medium">{{ $comment->accommodation->title ?? 'نامشخص' }}</span>
                        </div>

                        <!-- امتیاز -->
                        <div class="flex justify-between">
                            <span class="text-gray-600">امتیاز:</span>
                            <span class="text-lg font-bold text-orange-500">{{ $comment->rating }} <span
                                    class="text-sm text-gray-500">/10</span></span>
                        </div>

                        <!-- نکات مثبت -->
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">نکات مثبت:</p>
                            <div class="bg-green-50 rounded-lg p-3">
                                <p class="text-gray-700">{{ $comment->positive_points ?? '—' }}</p>
                            </div>
                        </div>

                        <!-- نکات منفی -->
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">نکات منفی:</p>
                            <div class="bg-red-50 rounded-lg p-3">
                                <p class="text-gray-700">{{ $comment->negative_points ?? '—' }}</p>
                            </div>
                        </div>

                        <!-- تاریخ ثبت -->
                        <div class="flex justify-between pt-2 border-t">
                            <span class="text-gray-600">تاریخ ثبت:</span>
                            <span
                                class="text-gray-800">{{ \Morilog\Jalali\Jalalian::fromCarbon($comment->created_at)->format('Y/m/d') }}</span>
                        </div>

                        <!-- وضعیت با سلکت -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">وضعیت:</span>
                            <select name="status"
                                class="px-3 py-2 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500">
                                <option value="pending" {{ $comment->status == 'pending' ? 'selected' : '' }}>⏳ در انتظار
                                    تایید</option>
                                <option value="approved" {{ $comment->status == 'approved' ? 'selected' : '' }}>✅ تایید شده
                                </option>
                                <option value="rejected" {{ $comment->status == 'rejected' ? 'selected' : '' }}>❌ رد شده
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between gap-3">
                        <a href="{{ route('admin.comments') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">بازگشت</a>
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            ذخیره تغییرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
