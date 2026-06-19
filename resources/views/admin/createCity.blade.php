@extends('admin.Layout.master')

@section('Content')
<div class="bg-white rounded-xl shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">➕ افزودن شهر جدید</h2>
        <a href="{{ route('admin.cities.index') }}" 
           class="text-indigo-500 hover:text-indigo-600 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            بازگشت
        </a>
    </div>

    <form action="{{ route('admin.cities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">نام شهر <span class="text-red-500">*</span></label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name') }}"
                   class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-purple-500 outline-none transition @error('name') border-red-500 @enderror"
                   placeholder="مثال: تهران، اصفهان، شیراز">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">عکس شهر</label>
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <input type="file" 
                           name="image" 
                           accept="image/*"
                           class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('image') border-red-500 @enderror"
                           onchange="previewImage(event)">
                    <p class="text-xs text-gray-500 mt-1">فرمت‌های مجاز: jpeg, png, jpg, gif, webp - حداکثر ۲ مگابایت</p>
                </div>
                <div id="imagePreview" class="hidden">
                    <img id="preview" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                </div>
            </div>
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" 
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg transition">
                ذخیره شهر
            </button>
            <a href="{{ route('admin.cities.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                انصراف
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection