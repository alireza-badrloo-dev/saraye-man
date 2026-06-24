<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }


   

    public function comment()
    {
        $comments = Comment::where('user_id', Auth::id())
            ->with(['accommodation', 'room'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.comment', compact('comments'));
    }

    public function favorite()
    {
        $user = Auth::user(); 
        return view('user.favorite', compact('user'));
    }

    public function logout()
    {

        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}
