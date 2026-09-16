<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;
use App\Models\Admin;


class BlogCommentController extends Controller
{
    public function index(Request $request)
    {

    $admin = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $admin = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $tab = $request->query('tab', 'pending');

        $query = BlogComment::with('blog');

        if ($tab === 'pending') {
            $query->where('is_approved', false);
        } elseif ($tab === 'approved') {
            $query->where('is_approved', true);
        }

        $comments = $query->orderByDesc('created_at')->get();

        $pendingCount = BlogComment::where('is_approved', false)->count();
        $approvedCount = BlogComment::where('is_approved', true)->count();

        return view('admin.blog.comments', compact('comments', 'pendingCount', 'approvedCount','admin'));
    }

    public function approve($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'نظر تایید شد.');
    }

    public function reject($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->update(['is_approved' => false]);

        return redirect()->back()->with('success', 'تایید نظر لغو شد.');
    }

    public function delete($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'نظر حذف شد.');
    }
}
