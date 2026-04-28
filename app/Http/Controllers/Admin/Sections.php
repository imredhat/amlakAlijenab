<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Section;



class Sections extends Controller
{
    public function index()
    {

        $data = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }
        $data['sections'] = Section::get();


        // print_r($data);die();

        return view('admin.sections', $data);
    }


    public function create()
    {

        $data = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }
        return view('admin.sections_create', $data);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'position' => 'required',
            'title'    => 'required|string',
            'desc'     => 'nullable|string',
            'pic' => 'nullable|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'link_title'     => 'nullable|string',
            'link'     => 'nullable|string',
        ]);

        // آپلود عکس
        if ($request->hasFile('pic')) {
            $filename = time() . '_' . $request->file('pic')->getClientOriginalName();
            $path = $request->file('pic')->storeAs('sections', $filename, 'public_folder');
            $data['pic'] = '/storage/' . $path;
        }

        $data['date_created'] = now();
        $data['date_updated'] = now();


        Section::create($data);

        return back()->with('success', 'دیتا با موفقیت ذخیره شد.');
    }


    public function edit($id)
    {
        $data = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['section'] = Section::where('id', $id)->get()[0];

        // echo json_encode($data['section']);die();
        return view('admin.sections_update', $data);
    }

    public function update(Request $request, $id)
    {
        // echo $id;die();
        $request->validate([
            'title' => 'required',
            'position' => 'required',
            'pic' => 'nullable|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
        ]);

        $section = Section::where('id', $id)->first();

        $data = [];

        if ($request->hasFile('pic')) {
            $filename = time() . '_' . $request->file('pic')->getClientOriginalName();
            $path = $request->file('pic')->storeAs('sections', $filename, 'public_folder');
            $data['pic'] = '/storage/' . $path;
        }

        if ($section) {
            $data['title'] = $request->title;
            $data['position'] = $request->position;
            $data['type'] = $request->type;
            $data['desc'] = $request->desc;
            $data['link'] = $request->link;
            $data['link_title'] = $request->link_title;
            $data['date_updated'] = now();

            $section->update($data);

            return redirect()->route('sections.index')->with('success', 'بروزرسانی انجام شد');
        } else {
            return redirect()->route('sections.index')->with('fail', 'بروزرسانی انجام نشد');
        }
    }
}
