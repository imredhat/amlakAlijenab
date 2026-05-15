<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Cty;
use App\Models\Neighborhood;
use App\Services\Categories\CategoryFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hekmatinasser\Verta\Verta;


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

        // دریافت پارامتر q برای فیلتر کردن
        $q = $request->query('q');

        // ساخت کوئری پایه
        $query = DB::table('property');

        // اعمال فیلتر بر اساس پارامتر q
        switch ($q) {
            case 'accepted':
                $query->where('status', 'تایید شده');
                $data['currentFilter'] = 'accepted';
                $data['filterTitle'] = 'آگهی‌های تایید شده';
                break;
            case 'notaccepted':
                $query->where('status', '!=', 'تایید شده')
                    ->where('status', '!=', 'رد شده');
                $data['currentFilter'] = 'notaccepted';
                $data['filterTitle'] = 'آگهی‌های در انتظار تایید';
                break;
            case 'expired':
                $query->where('status', 'رد شده');
                $data['currentFilter'] = 'expired';
                $data['filterTitle'] = 'آگهی‌های رد شده';
                break;
            default:
                $data['currentFilter'] = 'all';
                $data['filterTitle'] = 'همه آگهی‌ها';
                break;
        }

        // دریافت لیست آگهی‌ها با صفحه‌بندی
        $properties = $query->orderBy('id', 'DESC')->paginate(10);

        // حفظ پارامترهای کوئری در لینک‌های صفحه‌بندی
        $properties->appends(['q' => $q]);

        // اگر درخواست Ajax باشد فقط جدول را برمی‌گردانیم
        if ($request->ajax()) {
            return view('admin.property._table', [
                'properties' => $properties,
                'currentFilter' => $data['currentFilter']
            ]);
        }

        return view('admin.property.list', [
            'admin'      => $data['admin'],
            'properties' => $properties,
            'currentFilter' => $data['currentFilter'],
            'filterTitle' => $data['filterTitle']
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

        if ($data['property']->isEmpty()) {
            return redirect('/admin/property/list')->with('error', 'آگهی یافت نشد.');
        }

        $data['categoryHandler'] = CategoryFactory::create($data['property'][0]->category);

        return view('admin.property.view', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        if (! session()->has('admin_id')) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'لطفا وارد شوید'], 401);
            }
            return redirect('/admin/login');
        }

        $status = $request->input('status');

        if (! in_array($status, ['ثبت شده', 'تایید شده', 'رد شده'])) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'وضعیت نامعتبر است.'], 400);
            }
            return redirect()->back()->with('error', 'وضعیت نامعتبر است.');
        }

        DB::table('property')
            ->where('id', $id)
            ->update([
                'status'       => $status,
                'date_updated' => now()->format('Y-m-d H:i:s'),
            ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'وضعیت با موفقیت به‌روزرسانی شد.']);
        }

        return redirect()->back()->with('success', 'وضعیت آگهی با موفقیت به‌روزرسانی شد.');
    }

    // متد برای دریافت آمار وضعیت آگهی‌ها (اختیاری)
    public function getStats()
    {
        if (! session()->has('admin_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $stats = [
            'all' => DB::table('property')->count(),
            'accepted' => DB::table('property')->where('status', 'تایید شده')->count(),
            'notaccepted' => DB::table('property')
                ->where('status', '!=', 'تایید شده')
                ->where('status', '!=', 'رد شده')
                ->count(),
            'expired' => DB::table('property')->where('status', 'رد شده')->count(),
        ];

        return response()->json($stats);
    }
























    public function edit(Request $request, $id)
    {

     $data['locations'] = DB::table('neighborhoods')->where('showInMenu', true)->get();

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }


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

        if (!$isAdmin) {
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

        return view('admin.property.edit', $data);
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

        if (!$isAdmin) {
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

            return redirect('/admin/property/list')->with('success', 'آگهی با موفقیت به‌روزرسانی شد.');
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

        $isAdmin = session()->has('admin_id');
        $isOwner = Auth::check() && Auth::id() == $property->user_id;


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

        if ($isAdmin) {
            return redirect('/admin/property/list')->with('success', 'آگهی با موفقیت حذف شد.');
        }

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
