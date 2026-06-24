<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class usersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // جستجو
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('mobile', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $newUsers = User::whereMonth('created_at', now()->month)->count();
        $blockedUsers = User::where('status', 'blocked')->count();

        
        foreach ($users as $user) {
            $user->reservations_count = Reservation::where('user_id', $user->id)->count();
        }

        return view('admin.users', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'newUsers',
            'blockedUsers'
        ));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $reservations = Reservation::where('user_id', $id)->with(['accommodation', 'room'])->get();
        return view('admin.showUsers', compact('user', 'reservations'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'کاربر با موفقیت حذف شد');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->status == 'active') {
            $user->status = 'blocked';
        } else {
            $user->status = 'active';
        }
        $user->save();

        return redirect()->back()->with('success', 'وضعیت کاربر با موفقیت تغییر کرد');
    }
}