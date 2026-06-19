@extends('admin.Layout.master')



@section('Content')
<div class="bg-white rounded-xl border p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">جزئیات پیام</h2>
        <a href="{{ route('admin.contacts.index') }}" class="text-indigo-500 hover:text-indigo-600">← بازگشت</a>
    </div>
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <p class="text-sm text-gray-500">نام</p>
            <p class="font-medium">{{ $contact->name }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">ایمیل</p>
            <p class="font-medium">{{ $contact->email }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">شماره تماس</p>
            <p class="font-medium">{{ $contact->phone ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">موضوع</p>
            <p class="font-medium">{{ $contact->subject ?? '-' }}</p>
        </div>
        <div class="col-span-2">
            <p class="text-sm text-gray-500">تاریخ ارسال</p>
            <p class="font-medium">{{ $contact->created_at->format('Y/m/d H:i') }}</p>
        </div>
    </div>
    
    <div class="border-t pt-4">
        <p class="text-sm text-gray-500 mb-2">متن پیام</p>
        <p class="text-gray-700 leading-relaxed">{{ $contact->message }}</p>
    </div>
</div>
@endsection