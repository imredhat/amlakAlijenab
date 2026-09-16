<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class Index extends Controller
{
    public function dashboard()
    {
        $data = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['totalAgents']       = DB::table('users')->where('is_agent', true)->count();
        $data['activeProperties']  = DB::table('property')->where('_status', 'active')->count();
        $data['pendingProperties'] = DB::table('property')->where('_status', 'added')->count();
        $data['totalProperties']   = DB::table('property')->where('_status', '!=', 'deleted')->count();
        $data['expiredProperties'] = DB::table('property')->where('_status', 'expired')->count();
        $data['deletedProperties'] = DB::table('property')->where('_status', 'deleted')->count();

        return view('admin.dashboard', $data);
    }
}
