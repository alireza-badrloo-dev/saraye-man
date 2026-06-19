<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Companion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class reservationsController extends Controller
{

    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with(['accommodation', 'room', 'companions'])
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
                'check_in' => 'required|string',
                'check_out' => 'required|string',
                'guests' => 'required|integer|min:1',
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'special_request' => 'nullable|string',
            ]);

            // تبدیل تاریخ شمسی به میلادی
            $checkInGregorian = Jalalian::fromFormat('Y/m/d', $request->check_in)->toCarbon();
            $checkOutGregorian = Jalalian::fromFormat('Y/m/d', $request->check_out)->toCarbon();

            // محاسبه تعداد شب
            $nights = $checkInGregorian->diffInDays($checkOutGregorian);
            $room = Room::findOrFail($request->room_id);
            
            // بررسی ظرفیت اتاق
            if ($request->guests > $room->capacity) {
                return back()->with('error', 'ظرفیت اتاق ' . $room->capacity . ' نفر است. شما ' . $request->guests . ' نفر را وارد کرده‌اید.')->withInput();
            }
            
            // بررسی رزرو تکراری
            $existingReservation = Reservation::checkOverlap($room->id, $checkInGregorian, $checkOutGregorian)->first();
            
            if ($existingReservation) {
                return back()->with('error', 'این اتاق در تاریخ‌های انتخاب شده قبلاً رزرو شده است. لطفاً تاریخ دیگری را انتخاب کنید.')->withInput();
            }

            $totalPrice = $room->price * $nights;

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

            // ذخیره همراهان در جدول companions (جدول جدا)
            if ($request->has('companions')) {
                foreach ($request->companions as $companionData) {
                    if (!empty($companionData['full_name'])) {
                        Companion::create([
                            'reservation_id' => $reservation->id,
                            'full_name' => $companionData['full_name'],
                            'national_code' => $companionData['national_code'] ?? null,
                            'phone' => $companionData['phone'] ?? null,
                        ]);
                    }
                }
            }

            session([
                'reservation_id' => $reservation->id,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            return redirect()->route('payment.index', $reservation->id)->with('success', 'اطلاعات رزرو با موفقیت ثبت شد. در حال انتقال به صفحه پرداخت...');

        } catch (\Exception $e) {
            return back()->with('error', 'خطا در ثبت رزرو: ' . $e->getMessage())->withInput();
        }
    }
}