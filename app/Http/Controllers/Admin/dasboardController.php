<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Comment;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class dasboardController extends Controller
{
    public function index()
    {
        $totalReservations = Reservation::count();
        $monthlyIncome = Reservation::whereMonth('created_at', now()->month)->sum('total_price');
        $netIncome = $monthlyIncome * 0.9;
        $commission = $monthlyIncome * 0.1;
        $activeAccommodations = Accommodation::where('status', 'active')->count();
        $totalAccommodations = Accommodation::count();
        $totalUsers = User::count();
        $newUsers = User::whereMonth('created_at', now()->month)->count();

        $popularAccommodations = Accommodation::withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->limit(4)
            ->get();

        $recentReservations = Reservation::with(['user', 'accommodation', 'room'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentComments = Comment::with('user', 'accommodation')
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // ========== ساخت آخرین فعالیت‌ها ==========
        $activities = collect();

        // اضافه کردن رزروهای جدید
        foreach ($recentReservations as $reservation) {
            $activities->push([
                'icon' => 'fa-calendar-check',
                'icon_color' => 'text-green-500',
                'message' => 'رزرو جدید توسط ' . ($reservation->user->first_name ?? 'کاربر') . ' برای ' . ($reservation->accommodation->title ?? 'اقامتگاه'),
                'time' => Jalalian::fromCarbon($reservation->created_at)->format('H:i - Y/m/d'),
            ]);
        }

        // اضافه کردن نظرات جدید
        foreach ($recentComments as $comment) {
            $activities->push([
                'icon' => 'fa-comment',
                'icon_color' => 'text-blue-500',
                'message' => 'نظر جدید توسط ' . ($comment->user->first_name ?? 'کاربر') . ' برای ' . ($comment->accommodation->title ?? 'اقامتگاه'),
                'time' => Jalalian::fromCarbon($comment->created_at)->format('H:i - Y/m/d'),
            ]);
        }

        // اضافه کردن کاربران جدید
        $newUsersList = User::orderBy('created_at', 'desc')->limit(5)->get();
        foreach ($newUsersList as $user) {
            $activities->push([
                'icon' => 'fa-user-plus',
                'icon_color' => 'text-purple-500',
                'message' => 'کاربر جدید ثبت‌نام کرد: ' . ($user->first_name ?? '') . ' ' . ($user->last_name ?? ''),
                'time' => Jalalian::fromCarbon($user->created_at)->format('H:i - Y/m/d'),
            ]);
        }

        // مرتب‌سازی بر اساس زمان و گرفتن ۱۰ تا اول
        $recentActivities = $activities->sortByDesc('time')->take(10);

        return view('admin.dashboard', compact(
            'totalReservations',
            'monthlyIncome',
            'netIncome',
            'commission',
            'activeAccommodations',
            'totalAccommodations',
            'totalUsers',
            'newUsers',
            'popularAccommodations',
            'recentReservations',
            'recentComments',
            'recentActivities' 
        ));
    }
}