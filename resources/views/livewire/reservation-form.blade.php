<div>
    <form wire:submit="save">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">تاریخ ورود</label>
            <livewire:jalali-date-picker 
                wire:model="checkin_date"
                :year-input="false"
                :default-today="true"
                :inline-layout="true"
            />
            @error('checkin_date') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">تاریخ خروج</label>
            <livewire:jalali-date-picker 
                wire:model="checkout_date"
                :year-input="false"
                :default-today="true"
                :inline-layout="true"
            />
            @error('checkout_date') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg transition-all">
            ثبت رزرو
        </button>
    </form>
</div>