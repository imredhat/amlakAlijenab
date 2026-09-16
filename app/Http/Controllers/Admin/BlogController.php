<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $data = [];

        if (session()->has('admin_id')) {
            $adminId = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['blogs'] = Blog::orderByDesc('date_created')->get();

        return view('admin.blog.index', $data);
    }

    public function create()
    {
        $data = [];

        if (session()->has('admin_id')) {
            $adminId = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        return view('admin.blog.create', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:blogs,slug',
            'summary'     => 'nullable|string',
            'content'     => 'nullable|string',
            'category'    => 'nullable|string|max:100',
            'tags'        => 'nullable|string',
            'status'      => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'image'       => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('blogs', $filename, 'public_folder');
            $data['image'] = '/storage/' . $path;
        }

        if (!empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
            $data['tags'] = array_filter($data['tags']);
            $data['tags'] = array_values($data['tags']);
        } else {
            $data['tags'] = [];
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $data['views_count'] = 0;
        $data['date_created'] = now();
        $data['date_updated'] = now();

        Blog::create($data);

        return redirect('/admin/blog')->with('success', 'مقاله با موفقیت ذخیره شد.');
    }

    public function edit($id)
    {
        $data = [];

        if (session()->has('admin_id')) {
            $adminId = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['blog'] = Blog::where('id', $id)->first();

        return view('admin.blog.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:blogs,slug,' . $id . ',id',
            'summary'     => 'nullable|string',
            'content'     => 'nullable|string',
            'category'    => 'nullable|string|max:100',
            'tags'        => 'nullable|string',
            'status'      => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'image'       => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $blog = Blog::where('id', $id)->first();

        if (!$blog) {
            return redirect('/admin/blog')->with('fail', 'مقاله یافت نشد.');
        }

        $data = [];
        $data['title'] = $request->title;
        $data['slug'] = $request->slug;
        $data['summary'] = $request->summary;
        $data['content'] = $request->content;
        $data['category'] = $request->category;
        $data['status'] = $request->status;
        $data['published_at'] = $request->published_at;
        $data['date_updated'] = now();

        if (!empty($request->tags)) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
            $data['tags'] = array_filter($data['tags']);
            $data['tags'] = array_values($data['tags']);
        } else {
            $data['tags'] = [];
        }

        if ($data['status'] === 'published' && empty($data['published_at']) && empty($blog->published_at)) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            if ($blog->image) {
                $oldPath = str_replace('/storage/', '', $blog->image);
                if (Storage::disk('public_folder')->exists($oldPath)) {
                    Storage::disk('public_folder')->delete($oldPath);
                }
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('blogs', $filename, 'public_folder');
            $data['image'] = '/storage/' . $path;
        }

        $blog->update($data);

        return redirect('/admin/blog')->with('success', 'بروزرسانی انجام شد.');
    }

    public function destroy($id)
    {
        $blog = Blog::where('id', $id)->first();

        if ($blog) {
            if ($blog->image) {
                $oldPath = str_replace('/storage/', '', $blog->image);
                if (Storage::disk('public_folder')->exists($oldPath)) {
                    Storage::disk('public_folder')->delete($oldPath);
                }
            }
            $blog->delete();
            return redirect('/admin/blog')->with('success', 'مقاله حذف شد.');
        }

        return redirect('/admin/blog')->with('fail', 'مقاله یافت نشد.');
    }

    public function toggleStatus($id)
    {
        $blog = Blog::where('id', $id)->first();

        if ($blog) {
            $newStatus = ($blog->status === 'published') ? 'draft' : 'published';
            $data = ['status' => $newStatus, 'date_updated' => now()];

            if ($newStatus === 'published' && empty($blog->published_at)) {
                $data['published_at'] = now();
            }

            $blog->update($data);
            return redirect('/admin/blog')->with('success', 'وضعیت مقاله تغییر کرد.');
        }

        return redirect('/admin/blog')->with('fail', 'مقاله یافت نشد.');
    }
}
