@extends('admin.Layout.master')

@section('Content')
    <div class="p-4 md:p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800"> ایجاد مقاله جدید</h1>
            <a href="{{ route('admin.blogs.index') }}"
                class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center gap-1">
                <i class="fas fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">عنوان مقاله <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 @error('title') border-red-500 @enderror"
                            placeholder="عنوان مقاله را وارد کنید">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">خلاصه مقاله</label>
                        <textarea name="summary" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 @error('summary') border-red-500 @enderror"
                            placeholder="خلاصه مقاله را وارد کنید">{{ old('summary') }}</textarea>
                        @error('summary')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">محتوای مقاله <span
                                class="text-red-500">*</span></label>
                        <textarea name="content" id="editor" rows="10"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 @error('content') border-red-500 @enderror"
                            placeholder="محتوای مقاله را وارد کنید">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">دسته‌بندی</label>
                        <input type="text" name="category" value="{{ old('category') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                            placeholder="مثال: راهنمای سفر">
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">نویسنده</label>
                        <input type="text" name="author" value="{{ old('author') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                            placeholder="نام نویسنده">
                        @error('author')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">اقامتگاه مرتبط</label>
                        <select name="accommodation_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                            <option value="">انتخاب اقامتگاه</option>
                            @foreach ($accommodations as $accommodation)
                                <option value="{{ $accommodation->id }}"
                                    {{ old('accommodation_id') == $accommodation->id ? 'selected' : '' }}>
                                    {{ $accommodation->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('accommodation_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">شهر مرتبط</label>
                        <select name="city_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                            <option value="">انتخاب شهر</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تصویر مقاله</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                        <p class="text-xs text-gray-500 mt-1">فرمت‌های مجاز: jpeg, png, jpg, webp - حداکثر ۵ مگابایت</p>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت <span
                                class="text-red-500">*</span></label>
                        <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 @error('status') border-red-500 @enderror">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>پیش‌نویس</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>منتشر شده
                            </option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>بایگانی</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center mt-2">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1"
                            {{ old('is_featured') ? 'checked' : '' }}
                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="is_featured" class="mr-2 text-sm text-gray-700">نمایش در بخش ویژه</label>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fas fa-save ml-2"></i> ذخیره مقاله
                    </button>
                    <a href="{{ route('admin.blogs.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        انصراف
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- ====== اضافه کردن CDN و اسکریپت مستقیم در پایین صفحه ====== --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editorElement = document.querySelector('#editor');
        if (editorElement) {
            ClassicEditor
                .create(editorElement, {
                    language: 'fa',
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'bulletedList', 'numberedList', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', '|',
                        'undo', 'redo'
                    ],
                    ckfinder: {
                        uploadUrl: "{{ route('admin.blogs.upload-image') }}?_token={{ csrf_token() }}"
                    }
                })
                .then(editor => {
                    window.editor = editor;
                    console.log('CKEditor initialized successfully!');
                })
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });
        } else {
            console.warn('Editor element not found');
        }
    });
</script>

<style>
    .ck-editor__editable {
        min-height: 300px !important;
        direction: rtl !important;
        text-align: right !important;
        font-family: 'IRANSans', Tahoma, sans-serif !important;
        font-size: 15px !important;
        line-height: 1.8 !important;
    }

    .ck-editor__editable img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px !important;
        margin: 10px 0 !important;
    }

    .ck-editor__editable h2,
    .ck-editor__editable h3 {
        margin-top: 20px !important;
        margin-bottom: 10px !important;
    }

    .ck-editor__editable blockquote {
        border-right: 4px solid #f97316 !important;
        padding-right: 15px !important;
        margin: 15px 0 !important;
        background: #fef3c7 !important;
        padding: 15px !important;
        border-radius: 8px !important;
    }

    .ck-toolbar {
        border-radius: 8px 8px 0 0 !important;
    }

    .ck-editor__top {
        border-radius: 8px 8px 0 0 !important;
    }

    .ck-editor__editable {
        border-radius: 0 0 8px 8px !important;
    }
</style>