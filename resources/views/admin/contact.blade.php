@extends('admin.Layout.master')

@section('Content')
    <div class="p-4 md:p-6">
        <!-- عنوان صفحه -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800"> پیشنهادات کاربران</h1>
                <p class="text-gray-500 mt-1">مدیریت و بررسی پیام‌های ارسال شده توسط کاربران</p>
            </div>
            <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg text-sm font-medium">
                کل پیام‌ها: {{ $contacts->total() }}
            </span>
        </div>

        <!-- کارت‌های آماری -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-indigo-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">کل پیام‌ها</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $contacts->total() }}</p>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-full">
                        <i class="fas fa-envelope text-indigo-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-orange-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">خوانده نشده</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            {{ $contacts->where('is_read', false)->count() }}
                        </p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <i class="fas fa-envelope text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-5 border-r-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">خوانده شده</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            {{ $contacts->where('is_read', true)->count() }}
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-double text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- فیلتر وضعیت -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-6">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.contacts.index') }}"
                    class="text-sm px-4 py-2 rounded-lg transition-all duration-200 {{ !request('status') ? 'bg-indigo-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    همه
                </a>
                <a href="{{ route('admin.contacts.index', ['status' => 'unread']) }}"
                    class="text-sm px-4 py-2 rounded-lg transition-all duration-200 {{ request('status') == 'unread' ? 'bg-orange-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-envelope ml-1"></i>
                    خوانده نشده
                </a>
                <a href="{{ route('admin.contacts.index', ['status' => 'read']) }}"
                    class="text-sm px-4 py-2 rounded-lg transition-all duration-200 {{ request('status') == 'read' ? 'bg-green-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-check-double ml-1"></i>
                    خوانده شده
                </a>
            </div>
        </div>

        <!-- جدول پیام‌ها -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نام</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ایمیل</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">موضوع</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($contacts as $contact)
                            <tr class="hover:bg-gray-50 transition-all duration-200 {{ !$contact->is_read ? 'bg-indigo-50/30' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if (!$contact->is_read)
                                        <span class="px-2 py-1 text-xs rounded-full bg-orange-500 text-white">
                                            <i class="fas fa-circle text-[8px] ml-1"></i>
                                            جدید
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            <i class="fas fa-check-circle ml-1"></i>
                                            خوانده شده
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $contact->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $contact->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $contact->subject ?? 'بدون موضوع' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Morilog\Jalali\Jalalian::fromCarbon($contact->created_at)->format('Y/m/d H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                            class="text-blue-600 hover:text-blue-800 transition-colors" title="مشاهده">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <form action="{{ route('admin.contacts.toggle-read', $contact->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="transition-colors {{ $contact->is_read ? 'text-gray-400 hover:text-green-600' : 'text-orange-500 hover:text-orange-700' }}"
                                                title="{{ $contact->is_read ? 'علامت‌گذاری به عنوان نخوانده' : 'علامت‌گذاری به عنوان خوانده شده' }}">
                                                <i class="fas {{ $contact->is_read ? 'fa-envelope-open' : 'fa-envelope' }}"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('آیا از حذف این پیام مطمئن هستید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-2 block"></i>
                                    <p>هیچ پیامی وجود ندارد</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($contacts->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $contacts->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection