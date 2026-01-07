<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class User extends Controller
{
    public function myADS()
    {
        $properties = DB::table('property')->where('user_id', Auth::id())->get();

        // echo json_encode($properties);die();
        return view('/user/properties', ['properties' => $properties]);
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

        // پاسخ ساده برای تست
        return response()->json([
            'id'    => $propertyId,
            'files' => $savedFiles,
        ]);
    }
}
