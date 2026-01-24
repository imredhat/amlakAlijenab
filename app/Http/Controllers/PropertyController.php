<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Property;
use MongoDB\Client;



class PropertyController extends Controller
{
    public function show(Request $request)
    {
        $data = [];


        if (Auth::check()) {
            $tel = $request->session()->get('tel');
            $data['user'] = User::where('tel', $tel)->get();
        }
        return view('/peroperty/add', $data);
    }


    public function category(Request $request)
    {
        $category = $request->segment(3);
        $cat = 'peroperty/category/' . $category;

        return view($cat);
    }

    public function savetoDB(Request $request)
    {
        // 1) ذخیره داده‌های متنی در کالکشن / جدول property
        $allData = [];
        foreach ($request->except(['_token', 'media']) as $key => $value) {
            $allData[$key] = is_string($value) ? trim($value) : $value;
        }

        // پاک کردن اعشار و کاراکترهای غیر عددی برای فیلدهای قیمت
        $priceKeys = [
            'mortgage',
            'rent',
            'price',
            'daily_rent',
            'regular_days',
            'weekend',
            'special_days',
            'extra_person_cost',
        ];

        foreach ($priceKeys as $priceKey) {
            if (isset($allData[$priceKey])) {
                // فقط رقم نگه می‌داریم (اعشار و کاما حذف می‌شود)
                $allData[$priceKey] = preg_replace('/\D+/', '', (string) $allData[$priceKey]);
            }
        }
        $allData['status'] = "ثبت شده";
        $allData['_status'] = "addedd";


        // آیدی کاربری که لاگین است
        $allData['user_id'] = Auth::id();

        // درج رکورد و گرفتن آیدی
        $propertyId = DB::table('property')->insertGetId($allData);

        // 2) آپلود فایل‌ها در مسیر /upload/property/$ID
        $mediaFiles = $request->file('media', []);
        $savedFiles = [];

        $uploadDir = public_path('upload/property/' . $propertyId);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        foreach ($mediaFiles as $index => $file) {
            if ($file && $file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . $index . '.' . $extension;
                $file->move($uploadDir, $filename);
                $savedFiles[] = $filename;
            }
        }

        // ذخیره نام فایل‌ها در فیلد media (به صورت JSON)
        if (!empty($savedFiles)) {
            DB::table('property')
                ->where('id', $propertyId)
                ->update(['media' => json_encode($savedFiles)]);
        }

        return redirect('/user/myADS');
        // پاسخ ساده برای تست
        return response()->json([
            'id'    => $propertyId,
            'files' => $savedFiles,
        ]);
    }

    public function viewProperty(Request $request)
    {
        $data = [];
        $visit_count = 1;


        if (Auth::check()) {
            $id = Auth::id();
            $data['user'] = User::where('id', $id)->get();
        }

        $PID = $request->segment(2);

        if (isset($property[0]->visit_count)) {
            $visit_count = $property[0]->visit_count = $property[0]->visit_count + 1;
        }
        DB::table('property')->where('id', $PID)->update(['visit_count' => $visit_count]);

        // $data['property'] = User::where('id', $PID)->get();

        $data['property'] = $property = DB::table('property')->where('id', $PID)->get();
        $data['similar'] = [];
        $data['id'] = $PID;
        $existingIds = [];
        $categoryName = $property[0]->category;
        $data['agent'] = DB::table('users')->where('id', $property[0]->user_id)->get();

        if (isset($property)) {




            $title = explode(' ', $property[0]->title);
            foreach ($title as $t) {
                $get = DB::table('property')
                    ->where('title', 'like', '%' . $t . '%')
                    ->whereNotIn('id', [$PID])
                    ->get();

                foreach ($get as $item) {
                    $id = $item->id;

                    if (!in_array($id, $existingIds)) {
                        array_push($data['similar'], $item);
                        array_push($existingIds, $id);
                    }
                }
            }



            // $data['similar'] = DB::table('properties')
            // ->find(['$text' => ['$search' => 'villa']]);
            // ->find('{$text:{$search:"ویلا"}}');
            // ->whereLike('category', "other")
            // ->get();


            // $data['similar'] = DB::collection('property')
            //     ->where('title', 'like', '%ویلا%') // جستجو بر اساس عنوان
            //     ->get();



            // $properties = Property::all();

            // dd($properties);
            // // $data['similar'] = Property::where('title', 'like', '%ویلا%')
            // //     ->get();




            // $client = new Client('mongodb://localhost:27017'); // آدرس دیتابیس خودتون رو اینجا قرار بدید
            // $collection = $client->selectDatabase('amlak')->selectCollection('property'); // اسم دیتابیس و کالکشن رو اینجا قرار بدید

            // $properties = $collection->find(['title' => ['$regex' => 'ویلا', '$options' => 'i']]); // جستجو با regex و case-insensitive

            // foreach ($properties as $property) {
            //     // پردازش هر رکورد
            //     echo $property['_id'] . " - " . $property['title'] . "\n";
            // }

            // die();

            // echo json_encode($data['similar']);
            // die();
            return view('/peroperty/items/' . $categoryName, $data);
        } else {
            echo "<script>alert('آگهی مورد نظر یافت نشد / پاک شده است')</script>";
            return redirect("/");
        }
    }
}
