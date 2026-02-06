<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class Property extends Controller
{
    public function pList()
    {

        $data = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        return view('admin.body', $data);

    }
}
