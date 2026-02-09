<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Categories\CategoryFactory;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;


class AdminProperty extends Controller
{


    public function pList()
    {
        $data = [];

        // دریافت اطلاعات ادمین لاگین شده
        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        // دریافت لیست آگهی‌ها از مونگو (مرتب بر اساس _id)
        $properties = DB::table('property')-> orderBy('id' , "DESC")->get();

        // گروه‌بندی آگهی‌ها بر اساس category و اتصال هندلر هر دسته
        $groupedProperties = [];

        foreach ($properties as $property) {
            $categoryHandler     = CategoryFactory::create($property->category);
            $groupedProperties[] = [
                'property' => $property,
                'handler'  => $categoryHandler,
            ];
        }

        $data['groupedProperties'] = $groupedProperties;

        // echo json_encode($data);die();

        return view('admin.property.list', $data);
    }

    public function show($id)
    {
        $property        = PropertyModel::findOrFail($id);
        $categoryHandler = CategoryFactory::create($property->category);

        return view('properties.show', compact('property', 'categoryHandler'));
    }

}
