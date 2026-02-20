<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\Categories\CategoryFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProperty extends Controller
{

    public function pList(Request $request)
    {
        $data = [];

        // دریافت اطلاعات ادمین لاگین شده
        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        // دریافت لیست آگهی‌ها از دیتابیس (مرتب بر اساس id) به‌صورت صفحه‌بندی
        $properties = DB::table('property')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        // اگر درخواست Ajax باشد فقط جدول را برمی‌گردانیم
        if ($request->ajax()) {
            return view('admin.property._table', [
                'properties' => $properties,
            ]);
        }

        return view('admin.property.list', [
            'admin'      => $data['admin'],
            'properties' => $properties,
        ]);
    }

    public function pView($id)
    {

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['property'] = DB::table('property')->where('id', $id)->get();

        $data['categoryHandler'] = CategoryFactory::create($data['property'][0]->category);

        // echo json_encode($data);die();

        return view('admin.property.view', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        if (! session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        $status = $request->input('status');

        if (! in_array($status, ['ثبت شده', 'تایید شده', 'رد شده'])) {
            return redirect()->back()->with('error', 'وضعیت نامعتبر است.');
        }

        DB::table('property')
            ->where('id', $id)
            ->update([
                'status'       => $status,
                'date_updated' => now()->format('Y-m-d H:i:s'),
            ]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'وضعیت آگهی با موفقیت به‌روزرسانی شد.');
    }

}
