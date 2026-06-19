<form action="{{ route('search') }}" method="GET" class="w-full mb-12 p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 border border-gray-300 rounded-md bg-white shadow-sm">
    <div>
        <label class="text-xs text-gray-600 block mb-1">نام شهر یا اقامتگاه</label>
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="مثال: تهران، کلبه جنگلی سحر..."
            class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
    </div>

    <div>
        <label class="text-xs text-gray-600 block mb-1">از تاریخ</label>
        <input type="text" name="from_date" id="from_date" value="{{ request('from_date') }}"
            data-jdp
            data-jdp-max-date="today"
            placeholder="۱۴۰۳/۰۱/۰۱"
            class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"
            autocomplete="off">
    </div>

    <div>
        <label class="text-xs text-gray-600 block mb-1">تا تاریخ</label>
        <input type="text" name="to_date" id="to_date" value="{{ request('to_date') }}"
            data-jdp
            data-jdp-max-date="today"
            placeholder="۱۴۰۳/۰۱/۰۱"
            class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"
            autocomplete="off">
    </div>

    <div class="flex items-end">
        <button type="submit"
            class="bg-orange-500 hover:bg-orange-600 py-2 px-4 text-white rounded-md w-full transition duration-200 flex items-center justify-center gap-2">
            <i class="fas fa-search"></i>
            <span>جستجو</span>
        </button>
    </div>
</form>