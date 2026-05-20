<?php

namespace App\Exports;

use App\Models\Accommodation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AccommodationsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // دریافت داده‌ها با کمترین قیمت اتاق
        return Accommodation::where('status', 'active')
            ->with('city')
            ->withMin('rooms', 'price')  // اضافه کردن this line
            ->get();
    }

    public function headings(): array
    {
        return [
            'شناسه',
            'عنوان اقامتگاه',
            'شهر',
            'وضعیت',
            'حداقل قیمت (تومان)'
        ];
    }

    public function map($accommodation): array
    {
        // محاسبه قیمت با بررسی وجود rooms_min_price
        $minPrice = $accommodation->rooms_min_price ?? 0;
        
        return [
            $accommodation->id,
            $accommodation->title,
            $accommodation->city->name ?? 'نامشخص',
            $accommodation->status == 'active' ? 'فعال' : 'غیرفعال',
            number_format($minPrice) . ' تومان'
        ];
    }
}