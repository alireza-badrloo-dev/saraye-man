<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class PaymentController extends Controller
{
    public function index($reservation_id)
    {
        // نمایش صفحه پرداخت
        $reservation = Reservation::with(['accommodation', 'room'])
            ->where('user_id', Auth::id())
            ->findOrFail($reservation_id);

        $checkInShamsi = Jalalian::fromCarbon($reservation->check_in)->format('Y/m/d');
        $checkOutShamsi = Jalalian::fromCarbon($reservation->check_out)->format('Y/m/d');

        return view('user.payment', compact('reservation', 'checkInShamsi', 'checkOutShamsi'));
    }

    // متد جدید برای شبیه‌سازی رفتن به درگاه
    public function process(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);
        // فقط برای رزروهایی که وضعیت آنها 'pending' است، اجازه پرداخت بده
        if ($reservation->status !== 'pending') {
            return redirect()->route('user.reserve')->with('error', 'این رزرو قبلاً پرداخت یا لغو شده است.');
        }
        // هدایت به صفحه شبیه‌سازی بانک
        return view('user.simulate-payment', compact('reservation'));
    }

    // متد تأیید نهایی پرداخت
    public function confirm($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        // بررسی می‌کند که آیا وضعیت هنوز 'pending' است یا خیر
        if ($reservation->status !== 'pending') {
            return redirect()->route('user.reserve')->with('error', 'این رزرو قبلاً پرداخت یا لغو شده است.');
        }

        // **نقطه کلیدی: در اینجا رزرو نهایی می‌شود**
        $reservation->status = 'confirmed';
        $reservation->save();

        // اینجا می‌توانید عملیات دیگری مانند ارسال ایمیل، کم کردن موجودی اتاق و ... را انجام دهید.

        return redirect()->route('user.reserve')
            ->with('success', 'پرداخت با موفقیت انجام شد. کد پیگیری: ' . $reservation->tracking_code);
    }
}