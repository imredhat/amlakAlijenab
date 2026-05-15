<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Property;
use App\Models\Cty;
use App\Models\Neighborhood;
use MongoDB\Client;

use Hekmatinasser\Verta\Verta;




class PropertyController extends Controller
{

    public function show(Request $request)
    {
        $data = $this->initialize($request);
        $data['cities'] = DB::table('cties')->get();

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

        $allData = [];
        foreach ($request->except(['_token', 'media']) as $key => $value) {
            $allData[$key] = is_string($value) ? trim($value) : $value;
        }

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

        // ذخیره تاریخ شمسی
        $allData['date_created'] = (string) Verta::now();
        $allData['date_updated'] = (string) Verta::now();


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
        } else {
            DB::table('property')
                ->where('id', $propertyId)
                ->update(['media' => '[]']);
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
        $data = $this->initialize($request);

        $visit_count = 1;
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



    public function catalog(Request $request)
    {

        $locations = DB::table('neighborhoods')->where('showInMenu', true)->get();

        $type = $request->get('type', 'sale');
        $query = DB::table('property');

        if (!empty($type) && $type === 'rent') {
            $query->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->where('mortgage', '>', 0)
                        ->orWhere('mortgage', '!=', null);
                })->orWhere(function ($sub) {
                    $sub->where('rent', '>', 0)
                        ->orWhere('rent', '!=', null);
                })->orWhere(function ($sub) {
                    $sub->where('daily_rent', '>', 0)
                        ->orWhere('daily_rent', '!=', null);
                });
            });
        } else {
            $query->where(function ($q) {
                $q->where('price', '>', 0)
                    ->orWhere('price', '!=', null);
            });
        }


        $properties = $query->paginate(12);

        // برای درخواست‌های Ajax
        if ($request->ajax()) {
            $html = view('partials.properties.catalog-list', compact('properties'))->render();
            return response()->json([
                'html' => $html,
                'total' => $properties->total()
            ]);
        }

        // شهرها برای فیلتر
        $cities = Cty::orderBy('order')->get();

        return view('real-estate.catalog', compact('properties', 'cities', 'type', 'locations'));
    }


    public function initialize(Request $request)
    {
        $data = [];
        if (Auth::check()) {
            $tel = $request->session()->get('tel');
            $data['user'] = User::where('tel', $tel)->get();
        }

        $data['locations'] = DB::table('neighborhoods')->where('showInMenu', true)->get();

        return $data;
    }


    public function getNeighborhoods(Request $request)
    {
        $cityId = $request->city_id;
        $cityName = $request->city_name;

        if ($cityId) {
            $neighborhoods = Neighborhood::where('city_id', $cityId)
                ->orderBy('order', 'asc')
                ->get();
        }
        // بر اساس نام شهر


        if ($cityName) {
            $city = Cty::where('name', $cityName)->first();
            if ($city) {
                $neighborhoods = Neighborhood::where('city_id', $city->id)
                    ->orderBy('order', 'asc')
                    ->get();
            } else {
                $neighborhoods = collect([]);
            }
        }

        if (empty($neighborhoods)) {
            $neighborhoods = collect([]);
        }




        return response()->json([
            'success' => true,
            'neighborhoods' => $neighborhoods
        ]);
    }
















    public function edit(Request $request, $id)
    {
        $data = $this->initialize($request);

        // بررسی دسترسی
        $property = DB::table('property')->where('id', $id)->first();

        if (!$property) {
            return redirect()->back()->with('error', 'آگهی یافت نشد.');
        }

        $city = Cty::where('name', $property->city)->first();
        $data['neighborhoods'] = Neighborhood::where('city_id', $city->id)
            ->orderBy('order', 'asc')
            ->get();

        // نام محله برای نمایش (اگر نیاز دارید)
        $data['selectedNeighborhoodName'] = $property->city;

        // چک کردن دسترسی: ادمین یا صاحب آگهی
        $isAdmin = session()->has('admin_id');
        $isOwner = Auth::check() && Auth::id() == $property->user_id;

        if (!$isAdmin && !$isOwner) {
            return redirect('/')->with('error', 'شما دسترسی به ویرایش این آگهی ندارید.');
        }

        $data['property'] = $property;
        $data['cities'] = DB::table('cties')->get();
        $data['property_id'] = $id;

        // تعیین ویو مناسب بر اساس دسته‌بندی
        $categoryView = $this->getCategoryView($property->category);
        $data['categoryView'] = $categoryView;



        // دیکد کردن مدیاها
        $data['mediaFiles'] = json_decode($property->media ?? '[]', true);

        return view('peroperty.edit', $data);
    }


    public function update(Request $request, $id)
    {
        // بررسی وجود آگهی
        $property = DB::table('property')->where('id', $id)->first();

        if (!$property) {
            return redirect()->back()->with('error', 'آگهی یافت نشد.');
        }

        // بررسی دسترسی
        $isAdmin = session()->has('admin_id');
        $isOwner = Auth::check() && Auth::id() == $property->user_id;

        if (!$isAdmin && !$isOwner) {
            return redirect('/')->with('error', 'شما دسترسی به ویرایش این آگهی ندارید.');
        }

        // جمع‌آوری داده‌ها
        $allData = [];
        foreach ($request->except(['_token', '_method', 'media', 'deleted_images']) as $key => $value) {
            if (is_array($value)) {
                $allData[$key] = json_encode($value);
            } else {
                $allData[$key] = is_string($value) ? trim($value) : $value;
            }
        }

        // پردازش فیلدهای قیمتی
        $priceKeys = [
            'mortgage',
            'rent',
            'price',
            'daily_rent',
            'regular_days',
            'weekend',
            'special_days',
            'extra_person_cost'
        ];

        foreach ($priceKeys as $priceKey) {
            if (isset($allData[$priceKey])) {
                $allData[$priceKey] = preg_replace('/\D+/', '', (string) $allData[$priceKey]);
            }
        }

        // به‌روزرسانی تاریخ
        $allData['date_updated'] = (string) Verta::now();

        // پردازش تصاویر حذف شده
        $deletedImages = $request->input('deleted_images', []);
        $existingMedia = json_decode($property->media ?? '[]', true);

        if (!empty($deletedImages)) {
            $uploadDir = public_path('upload/property/' . $id);
            foreach ($deletedImages as $deletedImage) {
                $imagePath = $uploadDir . '/' . $deletedImage;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $existingMedia = array_values(array_diff($existingMedia, [$deletedImage]));
            }
        }

        // آپلود تصاویر جدید
        $newFiles = [];
        if ($request->hasFile('media')) {
            $uploadDir = public_path('upload/property/' . $id);
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            foreach ($request->file('media') as $index => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . $index . '.' . $extension;
                    $file->move($uploadDir, $filename);
                    $newFiles[] = $filename;
                }
            }
        }

        // ترکیب تصاویر موجود و جدید
        $allMedia = array_merge($existingMedia, $newFiles);
        $allData['media'] = json_encode($allMedia);

        // به‌روزرسانی در دیتابیس
        DB::table('property')->where('id', $id)->update($allData);

        // ریدایرکت بر اساس نقش کاربر
        // if ($isAdmin) {
        //     return redirect('/admin/property/list')->with('success', 'آگهی با موفقیت به‌روزرسانی شد.');
        // }

        return redirect('/user/myADS')->with('success', 'آگهی با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف آگهی
     */
    public function destroy($id)
    {
        $property = DB::table('property')->where('id', $id)->first();

        if (!$property) {
            return redirect()->back()->with('error', 'آگهی یافت نشد.');
        }


        // حذف فایل‌های آپلود شده
        $uploadDir = public_path('upload/property/' . $id);
        if (is_dir($uploadDir)) {
            $files = glob($uploadDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($uploadDir);
        }

        // حذف از دیتابیس
        DB::table('property')->where('id', $id)->delete();


        return redirect('/user/myADS')->with('success', 'آگهی با موفقیت حذف شد.');
    }

    /**
     * دریافت ویو مربوط به دسته‌بندی
     */
    private function getCategoryView($category)
    {
        $categoryMap = [
            'apartment-rent' => 'peroperty/edit/apartment-rent',
            'apartment-sale' => 'peroperty/edit/apartment-sale',
            'villa-sale' => 'peroperty/edit/villa-sale',
            'villa-short-rent' => 'peroperty/edit/villa-short-rent',
            'commercial-rent' => 'peroperty/edit/commercial-rent',
            'commercial-sale' => 'peroperty/edit/commercial-sale',
            'land' => 'peroperty/edit/land',
            'pre-sale' => 'peroperty/edit/pre-sale',
            'other' => 'peroperty/edit/other',
        ];

        return $categoryMap[$category] ?? 'peroperty/category/other';
    }


    public function toggleStatus($id)
    {
        $property = DB::table('property')->where('id', $id)->first();
        $newStatus = $property->status == 'فعال' ? 'غیرفعال' : 'فعال';
        DB::table('property')->where('id', $id)->update(['status' => $newStatus]);
        return response()->json(['success' => true]);
    }

    public function toggleFeature($id)
    {
        $property = DB::table('property')->where('id', $id)->first();
        $isFeatured = $property->is_featured ?? 0;
        DB::table('property')->where('id', $id)->update(['is_featured' => !$isFeatured]);
        return response()->json(['success' => true]);
    }
}
