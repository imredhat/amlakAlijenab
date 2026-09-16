<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Cty;
use App\Models\User;

class BlogController extends Controller
{
    public function index(Request $request)
    {

    $user = [];
     if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
        }

        $category = $request->query('category');

        $query = Blog::published();

        if ($category) {
            $query->where('category', $category);
        }

        $blogs = $query->orderByDesc('published_at')->paginate(12);

        $categories = Blog::published()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct('category')
            ->pluck('category');

        $cities = Cty::orderBy('order')->get();
        $locations = DB::table('neighborhoods')->where('showInMenu', true)->get();

        return view('blog.index', compact('blogs', 'categories', 'category', 'cities', 'locations','user'));
    }

    public function show($slug)
    {
        $user = [];
         if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
        }

        $blog = Blog::where('slug', $slug)->published()->firstOrFail();

        $blog->increment('views_count');

        $comments = BlogComment::where('blog_id', $blog->id)
            ->where('is_approved', true)
            ->orderByDesc('created_at')
            ->get();

        $related = Blog::published()
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        if ($related->count() < 3) {
            $extra = Blog::published()
                ->where('id', '!=', $blog->id)
                ->where('category', '!=', $blog->category)
                ->orderByDesc('published_at')
                ->limit(3 - $related->count())
                ->get();
            $related = $related->merge($extra);
        }

        $cities = Cty::orderBy('order')->get();
        $locations = DB::table('neighborhoods')->where('showInMenu', true)->get();

        return view('blog.show', compact('blog', 'related', 'cities', 'locations','user', 'comments'));
    }

    public function storeComment(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->published()->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'tel' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        BlogComment::create([
            'blog_id' => $blog->id,
            'name' => $request->name,
            'tel' => $request->tel,
            'message' => $request->message,
            'is_approved' => false,
        ]);

        return redirect()->back()->with('comment_success', 'نظر شما ثبت شد و پس از تایید مدیر نمایش داده خواهد شد.');
    }
}
