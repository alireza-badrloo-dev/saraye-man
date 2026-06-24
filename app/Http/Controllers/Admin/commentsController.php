<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Accommodation;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'accommodation']);

       
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

      
        if ($request->filled('accommodation_id')) {
            $query->where('accommodation_id', $request->accommodation_id);
        }

        // جستجو
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('positive_points', 'like', '%' . $request->search . '%')
                    ->orWhere('negative_points', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($user) use ($request) {
                        $user->where('first_name', 'like', '%' . $request->search . '%')
                            ->orWhere('last_name', 'like', '%' . $request->search . '%')
                            ->orWhere('email', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $comments = $query->orderBy('created_at', 'desc')->paginate(10);

        $totalComments = Comment::count();
        $approvedComments = Comment::where('status', 'approved')->count();
        $pendingComments = Comment::where('status', 'pending')->count();
        $rejectedComments = Comment::where('status', 'rejected')->count();
        $averageRating = Comment::where('status', 'approved')->avg('rating') ?? 0;

        $accommodations = Accommodation::all();

        return view('admin.comments', compact(
            'comments',
            'totalComments',
            'approvedComments',
            'pendingComments',
            'rejectedComments',
            'averageRating',
            'accommodations'
        ));
    }

    public function show($id)
    {
        $comment = Comment::with(['user', 'accommodation'])->findOrFail($id);
        return view('admin.showComment', compact('comment'));
    }

    public function updateStatus(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = $request->status;
        $comment->save();

        return redirect()->route('admin.comments')->with('success', 'وضعیت نظر با موفقیت تغییر کرد');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'نظر با موفقیت حذف شد');
    }
}
