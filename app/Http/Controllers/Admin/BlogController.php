<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Accommodation;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Blog::with(['accommodation', 'city']);

       
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(15);

      
        $totalPosts = Blog::count();
        $publishedPosts = Blog::where('status', 'published')->count();
        $draftPosts = Blog::where('status', 'draft')->count();

        return view('admin.blog', compact('blogs', 'totalPosts', 'publishedPosts', 'draftPosts'));
    }

    
    public function create()
    {
        $accommodations = Accommodation::where('status', 'active')->get();
        $cities = City::all();
        $categories = Blog::distinct('category')->pluck('category');

        return view('admin.CreateBlog', compact('accommodations', 'cities', 'categories'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'accommodation_id' => 'nullable|exists:accommodations,id',
            'city_id' => 'nullable|exists:cities,id',
            'author' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
           
        ], [
            'title.required' => 'وارد کردن عنوان مقاله الزامی است.',
            'title.unique' => 'این عنوان قبلاً در سیستم ثبت شده است.',
            'title.max' => 'عنوان مقاله نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'summary.max' => 'خلاصه مقاله نباید بیشتر از ۵۰۰ کاراکتر باشد.',
            'content.required' => 'وارد کردن محتوای مقاله الزامی است.',
            'status.required' => 'انتخاب وضعیت الزامی است.',
            'status.in' => 'وضعیت انتخاب شده معتبر نیست.',
            'image.image' => 'فایل انتخاب شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpeg, png, jpg یا webp باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
            'accommodation_id.exists' => 'اقامتگاه انتخاب شده معتبر نیست.',
            'city_id.exists' => 'شهر انتخاب شده معتبر نیست.',
            
        ]);

        
        $slug = Str::slug($validated['title']);
        $count = Blog::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        $validated['slug'] = $slug;

      
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
            $validated['image'] = $imagePath;
        }

        
        

        
        $validated['is_featured'] = $request->has('is_featured');

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'مقاله با موفقیت ایجاد شد.');
    }

   
    public function show($id)
    {
        $blog = Blog::with(['accommodation', 'city'])->findOrFail($id);
        return view('admin.showBlog', compact('blog'));
    }

    
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $accommodations = Accommodation::where('status', 'active')->get();
        $cities = City::all();
        $categories = Blog::distinct('category')->pluck('category');

        return view('admin.editBlog', compact('blog', 'accommodations', 'cities', 'categories'));
    }

    
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title,' . $id,
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'accommodation_id' => 'nullable|exists:accommodations,id',
            'city_id' => 'nullable|exists:cities,id',
            'author' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            
        ], [
            'title.required' => 'وارد کردن عنوان مقاله الزامی است.',
            'title.unique' => 'این عنوان قبلاً در سیستم ثبت شده است.',
            'title.max' => 'عنوان مقاله نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'summary.max' => 'خلاصه مقاله نباید بیشتر از ۵۰۰ کاراکتر باشد.',
            'content.required' => 'وارد کردن محتوای مقاله الزامی است.',
            'status.required' => 'انتخاب وضعیت الزامی است.',
            'status.in' => 'وضعیت انتخاب شده معتبر نیست.',
            'image.image' => 'فایل انتخاب شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpeg, png, jpg یا webp باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
            'accommodation_id.exists' => 'اقامتگاه انتخاب شده معتبر نیست.',
            'city_id.exists' => 'شهر انتخاب شده معتبر نیست.',
            
        ]);

      
        if ($blog->title != $validated['title']) {
            $slug = Str::slug($validated['title']);
            $count = Blog::where('slug', 'like', $slug . '%')
                ->where('id', '!=', $id)
                ->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            $validated['slug'] = $slug;
        }

        // ذخیره تصویر جدید
        if ($request->hasFile('image')) {
            // حذف تصویر قبلی
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store('blogs', 'public');
            $validated['image'] = $imagePath;
        }

        

        $validated['is_featured'] = $request->has('is_featured');

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'مقاله با موفقیت بروزرسانی شد.');
    }

    
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return back()->with('success', 'مقاله با موفقیت حذف شد.');
    }

    
    public function toggleStatus($id)
    {
        $blog = Blog::findOrFail($id);

        $statuses = ['draft', 'published', 'archived'];
        $currentIndex = array_search($blog->status, $statuses);
        $nextIndex = ($currentIndex + 1) % count($statuses);

        $blog->status = $statuses[$nextIndex];

        if ($blog->status == 'created_at' && !$blog->created_at) {
            $blog->created_at = now();
        }

        $blog->save();

        return back()->with('success', 'وضعیت مقاله تغییر کرد.');
    }

    
    public function toggleFeatured($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->is_featured = !$blog->is_featured;
        $blog->save();

        return back()->with('success', 'وضعیت ویژه مقاله تغییر کرد.');
    }

    
    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120'
            ]);

            $imagePath = $request->file('upload')->store('blogs/content', 'public');
            $url = asset('storage/' . $imagePath);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => false,
                'error' => [
                    'message' => 'خطا در آپلود تصویر: ' . $e->getMessage()
                ]
            ]);
        }
    }
}
