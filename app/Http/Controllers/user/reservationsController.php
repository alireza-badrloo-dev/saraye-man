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

    /**
     * نمایش جزئیات رزرو
     */
    public function show($id)
    {
        $reservation = Reservation::where('user_id', Auth::id())
            ->with(['accommodation', 'room', 'companions'])
            ->findOrFail($id);

        return view('user.showReservation', compact('reservation'));
    }

    /**
     * لغو رزرو
     */
    public function cancel($id)
    {
        try {
            $reservation = Reservation::where('user_id', Auth::id())->findOrFail($id);

            // بررسی اینکه رزرو قابل لغو هست یا نه
            if ($reservation->status == 'cancelled') {
                return back()->with('error', 'این رزرو قبلاً لغو شده است.');
            }

            if ($reservation->status == 'completed') {
                return back()->with('error', 'این رزرو به پایان رسیده و قابل لغو نیست.');
            }


            // بررسی تاریخ ورود (اختیاری - میتونی این رو هم برداری)
            $now = now();
            $checkIn = $reservation->check_in;
            $hoursDiff = $now->diffInHours($checkIn, false);

            // میتونی این شرط رو هم برداری تا هر زمانی قابل لغو باشه
            if ($hoursDiff <= 12 && $hoursDiff >= 0) {
                return back()->with('error', 'به دلیل نزدیک بودن به تاریخ ورود (کمتر از 12 ساعت)، امکان لغو آنلاین وجود ندارد. لطفاً با پشتیبانی تماس بگیرید.');
            }

            if ($hoursDiff < 0) {
                return back()->with('error', 'تاریخ ورود گذشته است و امکان لغو وجود ندارد.');
            }

            // لغو رزرو
            $reservation->update([
                'status' => 'cancelled',
                'cancelled_at' => now()
            ]);

            return redirect()->route('user.reserve')
                ->with('success', 'رزرو شما با موفقیت لغو شد.');
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در لغو رزرو: ' . $e->getMessage());
        }
    }

    /**
     * لغو رزرو توسط ادمین (برای استفاده در پنل ادمین)
     */
    public function adminCancel($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);

            if ($reservation->status == 'cancelled') {
                return back()->with('error', 'این رزرو قبلاً لغو شده است.');
            }

            if ($reservation->status == 'completed') {
                return back()->with('error', 'این رزرو به پایان رسیده و قابل لغو نیست.');
            }

            $reservation->update([
                'status' => 'cancelled',
                'cancelled_at' => now()
            ]);

            return back()->with('success', 'رزرو با موفقیت لغو شد.');
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در لغو رزرو: ' . $e->getMessage());
        }
    }

    /**
     * تغییر وضعیت رزرو توسط ادمین
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,confirmed,cancelled,completed'
            ]);

            $reservation = Reservation::findOrFail($id);
            $reservation->update(['status' => $request->status]);

            // اگر لغو شد، زمان لغو را ثبت کن
            if ($request->status == 'cancelled') {
                $reservation->update(['cancelled_at' => now()]);
            }

            return back()->with('success', 'وضعیت رزرو با موفقیت تغییر کرد.');
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در تغییر وضعیت: ' . $e->getMessage());
        }
    }
}
