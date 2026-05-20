<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class reservationsController extends Controller
{

    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with(['accommodation', 'room'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.reserve', compact('reservations'));
    }

    public function create($room_id)
    {
        $room = Room::with('accommodation')->findOrFail($room_id);
        return view('user.reserve-form', compact('room'));
    }

    public function store(Request $request)
    {
        try {
            // اعتبارسنجی
            $request->validate([
                'room_id' => 'required|exists:rooms,id',
                'check_in_year' => 'required|numeric',
                'check_in_month' => 'required|numeric',
                'check_in_day' => 'required|numeric',
                'check_out_year' => 'required|numeric',
                'check_out_month' => 'required|numeric',
                'check_out_day' => 'required|numeric',
                'guests' => 'required|integer|min:1',
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'special_request' => 'nullable|string',
            ]);

            // ساخت تاریخ شمسی
            $checkInJalali = sprintf('%04d/%02d/%02d', $request->check_in_year, $request->check_in_month, $request->check_in_day);
            $checkOutJalali = sprintf('%04d/%02d/%02d', $request->check_out_year, $request->check_out_month, $request->check_out_day);

            // تبدیل به میلادی
            $checkInGregorian = Jalalian::fromFormat('Y/m/d', $checkInJalali)->toCarbon();
            $checkOutGregorian = Jalalian::fromFormat('Y/m/d', $checkOutJalali)->toCarbon();

            // محاسبه تعداد شب
            $nights = $checkInGregorian->diffInDays($checkOutGregorian);
            $room = Room::findOrFail($request->room_id);
            $totalPrice = $room->price * $nights;

            // ========== چک کردن رزرو تکراری با scope ==========
            $existingReservation = Reservation::checkOverlap($room->id, $checkInGregorian, $checkOutGregorian)->first();

            if ($existingReservation) {
                return back()->with('error', 'این اتاق در تاریخ‌های انتخاب شده قبلاً رزرو شده است. لطفاً تاریخ دیگری را انتخاب کنید.')->withInput();
            }
            // =================================================

            // ایجاد رزرو
            $reservation = new Reservation();
            $reservation->user_id = Auth::id();
            $reservation->accommodation_id = $room->accommodation_id;
            $reservation->room_id = $room->id;
            $reservation->check_in = $checkInGregorian;
            $reservation->check_out = $checkOutGregorian;
            $reservation->nights = $nights;
            $reservation->guests = $request->guests;
            $reservation->price_per_night = $room->price;
            $reservation->total_price = $totalPrice;
            $reservation->tracking_code = Reservation::generateTrackingCode();
            $reservation->status = 'pending';
            $reservation->notes = $request->special_request;
            $reservation->save();

            session([
                'reservation_id' => $reservation->id,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            return redirect()->route('payment.index', $reservation->id);

        } catch (\Exception $e) {
            return back()->with('error', 'خطا: ' . $e->getMessage())->withInput();
        }
    }
}