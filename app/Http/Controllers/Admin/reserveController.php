<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Accommodation;
use App\Models\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class reserveController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'accommodation', 'room']);
        
        // فیلتر بر اساس وضعیت
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // فیلتر بر اساس بازه زمانی
        if ($request->filled('date_range')) {
            switch ($request->date_range) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month);
                    break;
                case 'year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }
        
        // جستجو
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('tracking_code', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($user) use ($request) {
                      $user->where('first_name', 'like', '%' . $request->search . '%')
                           ->orWhere('last_name', 'like', '%' . $request->search . '%');
                  });
            });
        }
        
        $reservations = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // آمار
        $totalReservations = Reservation::count();
        $activeReservations = Reservation::where('status', 'confirmed')->count();
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $cancelledReservations = Reservation::where('status', 'cancelled')->count();
        
        return view('admin.reserve', compact(
            'reservations',
            'totalReservations',
            'activeReservations',
            'pendingReservations',
            'cancelledReservations'
        ));
    }
    
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'accommodation', 'room'])->findOrFail($id);
        return view('admin.showReserve', compact('reservation'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();
        
        return redirect()->back()->with('success', 'وضعیت رزرو با موفقیت تغییر کرد');
    }
    
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        
        return redirect()->back()->with('success', 'رزرو با موفقیت حذف شد');
    }
}