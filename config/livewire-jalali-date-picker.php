<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    |
    | These are the default settings for the JalaliDatePicker component.
    | You can override these settings in your component instantiation.
    |
    */

    // Whether to use an input field for the year (true) or a dropdown (false)
    'year_input' => false,

    // Whether to default to today's date if no value is provided
    'default_today' => true,

    // Whether to display inputs in a row (true) or in columns (false)
    'inline_layout' => true,

    /*
    |--------------------------------------------------------------------------
    | Jalali Calendar Months
    |--------------------------------------------------------------------------
    |
    | These are the names of the months in the Jalali calendar.
    | You can customize these if needed.
    |
    */
    'months' => [
        1 => 'فروردین',
        2 => 'اردیبهشت',
        3 => 'خرداد',
        4 => 'تیر',
        5 => 'مرداد',
        6 => 'شهریور',
        7 => 'مهر',
        8 => 'آبان',
        9 => 'آذر',
        10 => 'دی',
        11 => 'بهمن',
        12 => 'اسفند',
    ],
];
