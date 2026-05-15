<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function myADS(Request $request)
    {
        $data = $this -> initialize($request);

        $data['properties'] = DB::table('property')->where('user_id', Auth::id()) -> orderBy('id' , "DESC")->get();
        return view('/user/properties', $data);
    }


    public function Profile(Request $request)
    {
        $data = $this -> initialize($request);
        return view('/user/profile', $data);
    }

      public function updateProfile(Request $request)
    {
       $data = $this -> initialize($request);

        $allData = [];
        foreach ($request->except(['_token', 'media']) as $key => $value) {
            $allData[$key] = is_string($value) ? trim($value) : $value;
        }

        $upd = DB::table('users')->update($allData);

        // // 2) آپلود فایل‌ها در مسیر /upload/property/$ID
        // $mediaFiles = $request->file('media', []);
        // $savedFiles = [];

        // $uploadDir = public_path('upload/user/' . $propertyId);
        // if (!is_dir($uploadDir)) {
        //     mkdir($uploadDir, 0755, true);
        // }

        // foreach ($mediaFiles as $index => $file) {
        //     if ($file && $file->isValid()) {
        //         $extension = $file->getClientOriginalExtension();
        //         $filename = time() . '_' . $index . '.' . $extension;
        //         $file->move($uploadDir, $filename);
        //         $savedFiles[] = $filename;
        //     }
        // }

        // ذخیره نام فایل‌ها در فیلد media (به صورت JSON)
        // if (!empty($savedFiles)) {
        //     DB::table('property')
        //         ->where('id', $propertyId)
        //         ->update(['media' => json_encode($savedFiles)]);
        // }





        // return view('/user/profile', $data);
        return redirect('user/profile' );
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


    public function initialize(Request $request)
    {
        $data = [];
        if (Auth::check()) {
            $tel = $request->session()->get('tel');
            $data['user'] = User::where('tel', $tel)->get();
        }

        $data['locations'] = DB::table('neighborhoods')->get();

        return $data;
    }

}
