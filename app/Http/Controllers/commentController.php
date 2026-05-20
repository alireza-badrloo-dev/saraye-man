<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
     public function store(Request $request, $accommodation_id)
    {
        try {
            // اعتبارسنجی
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'required|string|min:5|max:1000',
            ], [
                'rating.required' => 'لطفاً به اقامتگاه امتیاز دهید.',
                'rating.min' => 'امتیاز باید بین 1 تا 5 باشد.',
                'rating.max' => 'امتیاز باید بین 1 تا 5 باشد.',
                'comment.required' => 'متن نظر الزامی است.',
                'comment.min' => 'متن نظر باید حداقل 5 کاراکتر باشد.',
                'comment.max' => 'متن نظر نمی‌تواند بیشتر از 1000 کاراکتر باشد.',
            ]);
            
            // بررسی اینکه کاربر قبلاً نظر نداده
            $existingComment = Comment::where('user_id', Auth::id())
                ->where('accommodation_id', $accommodation_id)
                ->first();
            
            if ($existingComment) {
                return back()->with('error', 'شما قبلاً برای این اقامتگاه نظر ثبت کرده‌اید.');
            }
            
            // ایجاد نظر جدید
            $comment = new Comment();
            $comment->user_id = Auth::id();
            $comment->accommodation_id = $accommodation_id;
            $comment->title = $request->title ?? 'نظر کاربر';
            $comment->comment = $request->comment;
            $comment->rating = $request->rating;
            $comment->positive_points = $request->positive_points;
            $comment->negative_points = $request->negative_points;
            $comment->status = 'pending'; // در انتظار تایید ادمین
            $comment->save();
            
            return redirect()->back()->with('success', 'نظر شما با موفقیت ثبت شد. پس از تایید مدیریت نمایش داده می‌شود.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در ثبت نظر: ' . $e->getMessage());
        }
    }
}
