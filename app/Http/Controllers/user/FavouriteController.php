<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    public function toggle($id)
    {
        $user = Auth::user();

        
        $favourites = DB::table('users')->where('id', $user->id)->value('favourites');
        $favourites = $favourites ? json_decode($favourites, true) : [];

        if (in_array($id, $favourites)) {
            // حذف
            $favourites = array_values(array_diff($favourites, [$id]));
            DB::table('users')->where('id', $user->id)->update(['favourites' => json_encode($favourites)]);
            return back()->with('fail', 'از علاقه‌مندی‌ها حذف شد');
        } else {
            // اضافه
            $favourites[] = $id;
            DB::table('users')->where('id', $user->id)->update(['favourites' => json_encode($favourites)]);
            return back()->with('success', 'به علاقه‌مندی‌ها اضافه شد');
        }
    }

    public function index()
    {
        $favouritesJson = DB::table('users')->where('id', Auth::id())->value('favourites');
        $ids = $favouritesJson ? json_decode($favouritesJson, true) : [];

        $favourites = Accommodation::whereIn('id', $ids)
            ->withMin('rooms', 'price')
            ->get();

        return view('user.favorite', compact('favourites'));
    }
}
