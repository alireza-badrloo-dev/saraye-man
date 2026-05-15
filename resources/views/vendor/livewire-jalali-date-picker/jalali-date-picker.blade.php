<div
    x-data="{
        init() {
            this.$watch('year', value => {
                @this.set('year', value);
            });
            this.$watch('month', value => {
                @this.set('month', value);
            });
            this.$watch('day', value => {
                @this.set('day', value);
            });
        },
        year: @entangle('year'),
        month: @entangle('month'),
        day: @entangle('day'),
        monthDays: @entangle('monthDays'),
        jalaliMonths: @entangle('jalaliMonths'),
        yearInput: @entangle('yearInput'),
        inlineLayout: @entangle('inlineLayout')
    }"
    class="jalali-date-picker"
>
    <div :class="inlineLayout ? 'flex flex-row items-center justify-between space-x-2 rtl:space-x-reverse' : 'flex flex-col space-y-2'">
        <!-- Year Section -->
        <div class="relative">
            <template x-if="yearInput">
                <div class="flex items-center">
                    <input
                        type="number"
                        x-model="year"
                        class="block w-24 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        min="1300"
                        max="1500"
                    />
                </div>
            </template>
            <template x-if="!yearInput">
                <div class="flex items-center">
                    <button
                        type="button"
                        class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        wire:click="decrementYearBy10"
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <select
                        x-model="year"
                        class="block w-24 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                        <template x-for="y in Array.from({length: 101}, (_, i) => year - 50 + i)" :key="y">
                            <option :value="y" x-text="y"></option>
                        </template>
                    </select>
                    <button
                        type="button"
                        class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        wire:click="incrementYearBy10"
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </template>
        </div>

        <!-- Month Section -->
        <div class="relative">
            <select
                x-model="month"
                class="block w-32 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >
                <template x-for="(name, index) in jalaliMonths" :key="index">
                    <option :value="index" x-text="name"></option>
                </template>
            </select>
        </div>

        <!-- Day Section -->
        <div class="relative">
            <select
                x-model="day"
                class="block w-20 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >
                <template x-for="d in Array.from({length: monthDays}, (_, i) => i + 1)" :key="d">
                    <option :value="d" x-text="d"></option>
                </template>
            </select>
        </div>
    </div>

    <!-- Hidden input for form submission -->
    <input type="hidden" name="date" wire:model="value" />
</div>
