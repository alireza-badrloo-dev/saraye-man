@extends('admin.Layout.master')



@section('Content')
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">🏙️ مدیریت شهرها</h2>
            <a href="{{ route('admin.cities.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                <i class="fa fa-plus"></i>
                افزودن شهر جدید
            </a>
        </div>

        @if (session('error'))
            <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($cities->isEmpty())
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🏙️</div>
                <p class="text-gray-400 text-lg">هیچ شهری ثبت نشده است</p>
                <p class="text-gray-400 text-sm">برای افزودن شهر جدید، دکمه بالا را کلیک کنید</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">#</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">نام شهر</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">تعداد اقامتگاه</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">تاریخ ثبت</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $city->name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="bg-blue-100 text-blue-700 p-1 rounded-md text-xs">
                                        {{ $city->accommodations_count }} اقامتگاه
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ \Morilog\Jalali\Jalalian::fromCarbon($city->created_at)->format('Y/m/d') }}</td>
                                <td class="px-4 py-3">
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('admin.cities.edit', $city->id) }}"
                                            class="text-green-600 hover:text-green-800 transition-colors" title="ویرایش">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('آیا از حذف این اقامتگاه مطمئن هستید؟')">
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
                {{ $cities->links() }}
            </div>
        @endif
    </div>
@endsection
