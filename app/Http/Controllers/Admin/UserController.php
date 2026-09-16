<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use App\Models\Admin;
use Illuminate\Http\Request;

class UserController extends Controller
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

        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'))->with('admin', $data['admin']);
    }

    public function toggleAgent($id)
    {
        $user = User::findOrFail($id);
        $user->is_agent = !$user->is_agent;
        $user->save();

        return redirect()->back()->with('success', 'وضعیت مشاور با موفقیت تغییر کرد.');
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

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'))->with('admin', $data['admin']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'lname' => 'nullable|string|max:255',
            'agency_name' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|string'
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'اطلاعات کاربر با موفقیت بروزرسانی شد.');
    }

    public function show($id)
    {
        $data = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'))->with('admin', $data['admin']);
    }
}