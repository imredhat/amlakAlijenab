<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

use App\Models\Pages;



class Page extends Controller
{

    public function about()
    {

        $data = [];
        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }
        $data['pages'] = Pages::where('slug', 'about')->first();
        return view('admin.pages.about', $data);
    }


    public function contact()
    {

        $data = [];
        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['contact'] = Pages::where('slug', 'contact')->first();
        return view('admin.pages.contact', $data);
    }



    public function UpdContact(Request $request)
    {

        $data = $request->validate([
            'item1_title' => 'required|string',
            'item2_title'    => 'required|string',
            'item3_title'     => 'required|string',
            'value1'     => 'required|string',
            'value2'     => 'required|string',
            'value3'     => 'required|string',
            'slug'     => 'required|string',
        ]);


        $existing = Pages::where('slug', 'contact')->first();
        $contact = Pages::updateOrCreate(['slug' => 'contact'], $data);
        if ($existing && $existing->id === $contact->id) {
            return back()->with('success', 'اطلاعات با موفقیت به‌روزرسانی شد.');
        } else {
            return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
        }
    }

    
}
