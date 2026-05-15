<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Admin;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['faqs'] = FAQ::orderBy('order')->orderBy('id')->get();
        
        return view('admin.pages.faq', $data);   // نام ویو: admin.faq
    }

    public function update(Request $request)
    {
        // حذف مواردی که علامت حذف خورده‌اند
        if ($request->delete_faq) {
            foreach ($request->delete_faq as $index => $delete) {
                if ($delete == '1' && isset($request->question[$index])) {
                    // اینجا فقط از حذف در فرم استفاده می‌کنیم، رکورد را بعداً حذف می‌کنیم
                }
            }
        }

        // پاک کردن همه سوالات قبلی و ذخیره مجدد (روش ساده و مطمئن برای تک‌صفحه‌ای)
        FAQ::truncate();   // یا می‌تونی هوشمندانه‌تر حذف کنی

        if ($request->question) {
            foreach ($request->question as $i => $question) {
                if (empty($question) || ($request->delete_faq[$i] ?? 0) == '1') {
                    continue;
                }

                FAQ::create([
                    'category'   => $request->category[$i] ?? null,
                    'question'   => $question,
                    'answer'     => $request->answer[$i] ?? '',
                    'order'      => $request->order[$i] ?? $i,
                    'is_active'  => $request->is_active[$i] ?? true,
                ]);
            }
        }

        return redirect()->back()->with('success', 'سوالات متداول با موفقیت ذخیره شد.');
    }
}