<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class detailAccommodationController extends Controller
{
    public function index($id)
    {
        $data = Accommodation::with(['comments.room', 'comments.user'])->findOrFail($id);
        
        $averageRating = Comment::where('accommodation_id', $data->id)
            ->where('status', 'approved')
            ->avg('rating');
        return view('user.detailAccommodation', compact('data','averageRating'));
    }
    public function storeComment(Request $request, $id)
    {
        try {
           
            $request->validate([
                'rating' => 'required|numeric|min:0|max:10',
                'positive_points' => 'nullable|string|max:500',
                'negative_points' => 'nullable|string|max:500',
                'room_id' => 'required'
            ], [
                'rating.required' => 'لطفاً به اقامتگاه امتیاز دهید.',
                'room_id.required' => 'لطفاً اتاق خود را انتخاب کنید.',

            ]);

            
            $existingComment = Comment::where('user_id', Auth::id())
                ->where('accommodation_id', $id)
                ->first();

            if ($existingComment) {
                return back()->with('error', 'شما قبلاً برای این اقامتگاه نظر ثبت کرده‌اید.');
            }

            
            $comment = new Comment();
            $comment->user_id = Auth::id();
            $comment->accommodation_id = $id;
            $comment->room_id = $request->room_id;
            $comment->rating = $request->rating;
            $comment->positive_points = $request->positive_points;
            $comment->negative_points = $request->negative_points;
            $comment->status = 'pending';
            $comment->save();

            return redirect()->back()->with('success', 'نظر شما با موفقیت ثبت شد. پس از تایید مدیریت نمایش داده می‌شود.');
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در ثبت نظر: ' . $e->getMessage());
        }
    }
}
