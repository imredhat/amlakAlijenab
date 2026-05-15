<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Cty;
use App\Models\Neighborhood;
use Illuminate\Support\Facades\Storage;

class NeighborhoodController extends Controller
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

        $data['neighborhoods'] = Neighborhood::orderBy('order', 'asc')->get();
        $data['cities'] = Cty::orderBy('order', 'asc')->get();

        return view('admin.neighborhood', $data);
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

        $data['cities'] = Cty::orderBy('order', 'asc')->get();

        return view('admin.neighborhood_create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'city_id' => 'required|exists:cties,id',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'showInMenu' => 'boolean'  

        ]);

        $validated['showInMenu'] = $request->has('showInMenu') ? true : false;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('neighborhoods', $filename, 'public_folder');
            $validated['image'] = '/storage/' . $path;
        }

        Neighborhood::create($validated);

        return redirect()->route('neighborhood.index')->with('success', 'محله با موفقیت اضافه شد.');
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

        $data['neighborhood'] = Neighborhood::findOrFail($id);
        $data['cities'] = Cty::orderBy('order', 'asc')->get();

        return view('admin.neighborhood_update', $data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'city_id' => 'required|exists:cties,id',
            'order' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'showInMenu' => 'boolean'
        ]);

        $neighborhood = Neighborhood::findOrFail($id);
        $validated['showInMenu'] = $request->has('showInMenu') ? true : false;


        if ($request->hasFile('image')) {
            if ($neighborhood->image && Storage::disk('public_folder')->exists(str_replace('/storage/', '', $neighborhood->image))) {
                Storage::disk('public_folder')->delete(str_replace('/storage/', '', $neighborhood->image));
            }
            
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('neighborhoods', $filename, 'public_folder');
            $validated['image'] = '/storage/' . $path;
        }

        $neighborhood->update($validated);

        return redirect()->route('neighborhood.index')->with('success', 'محله با موفقیت به‌روزرسانی شد.');
    }

    public function destroy($id)
    {
        $neighborhood = Neighborhood::findOrFail($id);

        if ($neighborhood->image && Storage::disk('public_folder')->exists(str_replace('/storage/', '', $neighborhood->image))) {
            Storage::disk('public_folder')->delete(str_replace('/storage/', '', $neighborhood->image));
        }

        $neighborhood->delete();

        return redirect()->route('neighborhood.index')->with('success', 'محله با موفقیت حذف شد.');
    }
}