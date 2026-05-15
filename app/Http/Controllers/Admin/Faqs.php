<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Faq;

class Faqs extends Controller
{
    protected function adminCheck()
    {
        if (!session()->has('admin_id')) {
            return false;
        }
        return Admin::find(session('admin_id'));
    }

    public function index()
    {
        $data = [];
        $admin = $this->adminCheck();
        if (!$admin) return redirect('/admin/login');
        $data['admin'] = $admin;
        $data['faqs'] = Faq::orderBy('order', 'asc')->get();
        return view('admin.faqs.index', $data);
    }

    public function create()
    {
        $admin = $this->adminCheck();
        if (!$admin) return redirect('/admin/login');
        return view('admin.faqs.form', ['admin' => $admin]);
    }

    public function store(Request $request)
    {
        $admin = $this->adminCheck();
        if (!$admin) return redirect('/admin/login');

        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string',
            'slug' => 'nullable|string',
            'order' => 'nullable|numeric'
        ]);

        $data['date_created'] = now()->toDateTimeString();
        Faq::create($data);
        return redirect('/admin/faqs')->with('success', 'سوال افزوده شد');
    }

    public function edit($id)
    {
        $admin = $this->adminCheck();
        if (!$admin) return redirect('/admin/login');
        $faq = Faq::find($id);
        return view('admin.faqs.form', ['admin' => $admin, 'faq' => $faq]);
    }

    public function update(Request $request, $id)
    {
        $admin = $this->adminCheck();
        if (!$admin) return redirect('/admin/login');

        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string',
            'slug' => 'nullable|string',
            'order' => 'nullable|numeric'
        ]);

        $data['date_updated'] = now()->toDateTimeString();
        Faq::where('_id', $id)->update($data);
        return redirect('/admin/faqs')->with('success', 'بروزرسانی با موفقیت انجام شد');
    }

    public function destroy($id)
    {
        $admin = $this->adminCheck();
        if (!$admin) return redirect('/admin/login');
        Faq::where('_id', $id)->delete();
        return redirect('/admin/faqs')->with('success', 'سوال حذف شد');
    }
}
