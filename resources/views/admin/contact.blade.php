@extends('admin.Layout.master')



@section('Content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">📩 پیام‌های کاربران</h2>
            <span class="text-sm text-gray-500">تعداد کل: {{ $contacts->total() }}</span>
        </div>

        <!-- فیلتر وضعیت -->
        <div class="flex gap-2 mb-4">
            <a href="{{ route('admin.contacts.index') }}"
                class="text-sm px-3 py-1 rounded-lg {{ !request('status') ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                همه
            </a>
            <a href="{{ route('admin.contacts.index', ['status' => 'unread']) }}"
                class="text-sm px-3 py-1 rounded-lg {{ request('status') == 'unread' ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                خوانده نشده
            </a>
            <a href="{{ route('admin.contacts.index', ['status' => 'read']) }}"
                class="text-sm px-3 py-1 rounded-lg {{ request('status') == 'read' ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                خوانده شده
            </a>
        </div>

        @if ($contacts->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-400 text-lg">📭 هیچ پیامی وجود ندارد</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">وضعیت</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">نام</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">ایمیل</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">موضوع</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">تاریخ</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr class="border-b hover:bg-gray-50 transition {{ !$contact->is_read ? 'bg-gray-50' : '' }}">
                                <td class="px-4 py-3">
                                    @if (!$contact->is_read)
                                        <span class="bg-orange-500 text-white text-xs px-2 py-1 rounded-full">جدید</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">خوانده
                                            شده</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $contact->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $contact->email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $contact->subject ?? 'بدون موضوع' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $contact->created_at->format('Y/m/d H:i') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                            class="text-blue-600 hover:text-blue-800 transition-colors" title="مشاهده">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <form action="{{ route('admin.contacts.toggle-read', $contact->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="text-sm {{ $contact->is_read ? 'text-green-500 hover:text-green-700' : 'text-orange-500 hover:text-orange-700' }}">
                                                {{ $contact->is_read ? 'خوانده شد' : 'نخوانده' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('آیا از حذف این پیشنهاد مطمئن هستید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors"
                                                title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
@endsection
