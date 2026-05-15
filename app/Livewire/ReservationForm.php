<?php

namespace App\Livewire;

use Livewire\Component;

class ReservationForm extends Component
{
    // متغیرهایی که تاریخ در اونها ذخیره میشه
    public $checkin_date;
    public $checkout_date;

    // متد برای ذخیره کردن اطلاعات
    public function save()
    {
        // اعتبارسنجی تاریخ‌ها
        $this->validate([
            'checkin_date' => 'required|date_format:Y/m/d',
            'checkout_date' => 'required|date_format:Y/m/d',
        ]);

        // اینجا می‌تونید تاریخ‌ها رو ذخیره کنید
        session()->flash('message', 'رزرو با موفقیت ثبت شد!');
        
        // یا برای تبدیل به میلادی (اگر نیاز دارید):
        // use Morilog\Jalali\Jalalian;
        // $gregorianDate = Jalalian::fromFormat('Y/m/d', $this->checkin_date)->toCarbon();
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
}