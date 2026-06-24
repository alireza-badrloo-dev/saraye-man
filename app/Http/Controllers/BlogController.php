<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Accommodation;
use App\Models\City;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // آخرین مقالات (منتشر شده)
        $latestPosts = Blog::where('status', 'published')
            ->with(['accommodation', 'city'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // همه مقالات (منتشر شده)
        $posts = Blog::where('status', 'published')
            ->with(['accommodation', 'city'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // اقامتگاه‌های محبوب
        $popularAccommodations = Accommodation::where('status', 'active')
            ->with(['city', 'rooms'])
            ->orderBy('rating', 'desc')
            ->take(4)
            ->get();

        // شهرهای محبوب
        $popularCities = City::withCount('accommodations')
            ->having('accommodations_count', '>', 0)
            ->orderBy('accommodations_count', 'desc')
            ->take(6)
            ->get();

        return view('user.blog', compact('posts', 'latestPosts', 'popularAccommodations', 'popularCities'));
    }

    public function show($slug)
    {
        $post = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->with(['accommodation', 'city'])
            ->firstOrFail();

        // مقالات مرتبط
        $relatedPosts = Blog::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                $query->where('city_id', $post->city_id)
                      ->orWhere('category', $post->category);
            })
            ->take(4)
            ->get();

        $post->increment('views');

        return view('user.showBlog', compact('post', 'relatedPosts'));
    }

    public function category($category)
    {
        $posts = Blog::where('status', 'published')
            ->where('category', $category)
            ->with(['accommodation', 'city'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $categories = Blog::where('status', 'published')
            ->distinct('category')
            ->pluck('category');

        return view('user.blog.category', compact('posts', 'category', 'categories'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        
        $posts = Blog::where('status', 'published')
            ->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%")
                      ->orWhere('summary', 'like', "%{$search}%");
            })
            ->with(['accommodation', 'city'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('user.blog.search', compact('posts', 'search'));
    }
}