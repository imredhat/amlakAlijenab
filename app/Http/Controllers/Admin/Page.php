<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

use App\Models\Pages;
use App\Models\ContactsForm;



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

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $uploadDir = public_path('upload/site');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $file->move($uploadDir, $filename);
            $data['logo'] = '/upload/site/' . $filename;
        }

        $existing = Pages::where('slug', 'contact')->first();
        $contact = Pages::updateOrCreate(['slug' => 'contact'], $data);
        if ($existing && $existing->id === $contact->id) {
            return back()->with('success', 'اطلاعات با موفقیت به‌روزرسانی شد.');
        } else {
            return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
        }
    }


    public function contactSubmissions()
    {
        $data = [];
        if (session()->has('admin_id')) {
            $adminId = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['submissions'] = ContactsForm::orderByDesc('date_created')->get();

        return view('admin.pages.contact_submissions', $data);
    }


    public function deleteSubmission($id)
    {
        if (!session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        $submission = ContactsForm::find($id);
        if ($submission) {
            $submission->delete();
            return redirect('/admin/page/contact-submissions')->with('success', 'پیام حذف شد.');
        }

        return redirect('/admin/page/contact-submissions')->with('fail', 'پیام یافت نشد.');
    }
}
