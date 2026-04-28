<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Cty;
use Illuminate\Support\Facades\Storage; // برای مدیریت فایل‌ها



class City extends Controller
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
        $data['cities'] = Cty::orderBy('order', 'asc')->get();



        // print_r($data);die();

        return view('admin.city', $data);
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

        return view('admin.city_create', $data);
    }


    public function store(Request $request)
    {

        // اضافه کردن 'image' به قوانین اعتبار سنجی
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // قوانین برای فایل عکس
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('cities', $filename, 'public_folder');
            $validated['image'] = '/storage/' . $path;
        }

        $validated['date_created'] = now();
        $validated['date_updated'] = now();

        // اضافه کردن مسیر عکس به داده‌ها قبل از ذخیره

        Cty::create($validated);

        return redirect()->route('city.index')->with('success', 'شهر با موفقیت اضافه شد.');
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
        $data['city'] = Cty::where('id', $id)->get()[0];


        // print_r($data['city']);
        // die();

        return view('admin.city_update', $data);
    }

    public function update(Request $request, $id) // استفاده از Route Model Binding
    {


        $validated = $request->validate([
            'name' => 'required|string',
            'order' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $city = Cty::where('id', $id)->first();


        $imagePath = $city->image;

        if ($request->hasFile('image')) {
            if ($city->image && Storage::disk('public')->exists($city->image)) {
                Storage::disk('public')->delete($city->image);
            }
            $imagePath = $request->file('image')->store('cities', 'public_folder');
        }

        $validated['image'] = $imagePath;

        $city->update($validated);

        return redirect()->route('city.index')->with('success', 'شهر با موفقیت به‌روزرسانی شد.');
    }


    public function destroy(Cty $city)
    {

        $city->delete();

        if ($city->image && Storage::disk('public')->exists($city->image)) {
            Storage::disk('public')->delete($city->image);
        }


        // 3. بازگشت به لیست شهرها با پیام موفقیت
        return redirect()->route('city.index')->with('success', 'شهر با موفقیت حذف شد.');
    }
}
