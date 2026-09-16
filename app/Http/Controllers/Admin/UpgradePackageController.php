<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UpgradePackage;

class UpgradePackageController extends Controller
{
    private function guard()
    {
        if (!session()->has('admin_id')) {
            return redirect('/admin/login');
        }
        return Admin::find(session('admin_id'));
    }

    public function index()
    {
        if (!session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        $admin = Admin::find(session('admin_id'));
        $packages = UpgradePackage::orderBy('order')->get();

        return view('admin.upgrade-packages.index', compact('packages', 'admin'));
    }

    public function create()
    {
        if (!session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        $admin = Admin::find(session('admin_id'));

        return view('admin.upgrade-packages.create', compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'duration_days' => 'required|integer|min:1',
            'view_multiplier' => 'required|integer|min:1',
            'is_top_listed' => 'nullable',
            'is_special_badge' => 'nullable',
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        UpgradePackage::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'view_multiplier' => $request->view_multiplier,
            'is_top_listed' => $request->has('is_top_listed'),
            'is_special_badge' => $request->has('is_special_badge'),
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.upgrade-packages.index')->with('success', 'پکیج با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        if (!session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        $admin = Admin::find(session('admin_id'));
        $package = UpgradePackage::findOrFail($id);

        return view('admin.upgrade-packages.edit', compact('package', 'admin'));
    }

    public function update(Request $request, $id)
    {
        $package = UpgradePackage::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'duration_days' => 'required|integer|min:1',
            'view_multiplier' => 'required|integer|min:1',
            'is_top_listed' => 'nullable',
            'is_special_badge' => 'nullable',
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        $package->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'view_multiplier' => $request->view_multiplier,
            'is_top_listed' => $request->has('is_top_listed'),
            'is_special_badge' => $request->has('is_special_badge'),
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.upgrade-packages.index')->with('success', 'پکیج با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $package = UpgradePackage::findOrFail($id);
        $package->delete();

        return redirect()->route('admin.upgrade-packages.index')->with('success', 'پکیج با موفقیت حذف شد.');
    }
}
