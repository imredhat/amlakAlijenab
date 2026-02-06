<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    // نمایش فرم لاگین
    public function formLogin()
    {
        return view('auth.login');
    }

    public function prosrsslogin(Request $request)
    {

        $tel = $request->input('tel');

        // بررسی وجود کاربر با این شماره موبایل
        $user = User::where('tel', $tel)->count();

        // echo json_encode($user);die();

        if ($user && $user > 0) {

            // اگر کاربر وجود داشت، کد تایید تولید و ارسال کن
            $verificationCode = rand(1000, 9999);

            // ذخیره کد در سشن
            $request->session()->put('verification_code', $verificationCode);
            $request->session()->put('tel', $tel);

            User::where('tel', $tel)->update([
                'verificationCode' => $verificationCode
            ]);

            // TODO: ارسال کد به شماره موبایل (SMS)
            // در اینجا می‌توانید از سرویس SMS استفاده کنید

            $data = [
                'success' => 'حساب کاربری شما ایجاد شد. کد تایید به شماره موبایل شما ارسال شد.',
                'code' => $verificationCode
            ];
            return view('auth.verify', $data);
        } else {
            // تولید و ارسال کد تایید
            $verificationCode = rand(1000, 9999);

            // اگر کاربر وجود نداشت، ایجاد کن
            $user = User::create([
                'tel' => $tel,
                'verificationCode' =>  $verificationCode,
                'type' => "user"
            ]);


            // ذخیره کد در سشن
            $request->session()->put('verification_code', $verificationCode);
            $request->session()->put('tel', $tel);

            // TODO: ارسال کد به شماره موبایل (SMS)
            // در اینجا می‌توانید از سرویس SMS استفاده کنید
            $data = [
                'success' => 'حساب کاربری شما ایجاد شد. کد تایید به شماره موبایل شما ارسال شد.',
                'code' => $verificationCode // برای تست - در تولید حذف کنید
            ];

            // echo json_encode($data);
            // die();

            return view('auth.verify', $data);
        }
    }


    // پردازش ثبت نام
    public function signUp(Request $request)
    {
        // اعتبارسنجی داده‌ها
        // $request->validate([
        //     'tel' => 'required|string|min:10|max:15',
        //     'verification_code' => 'required|integer|digits:4'
        // ]);

        $tel = $request->session()->get('tel');
        $code = $request->input('code');

        $verificationCode = $code[0] . $code[1] . $code[2] . $code[3];


        // بررسی کد تایید
        if ($request->session()->get('verification_code') == $verificationCode && $request->session()->get('tel') == $tel) {
            // کاربر را ثبت نام کن
            $user = User::where('tel', $tel)->first();

            if ($user) {
                $user->update(['status' => 'verified']);
            }
            // ورود کاربر
            Auth::login($user);
            $request->session()->put('verification_code', $verificationCode);


            return redirect('/home')->with('success', 'شما با موفقیت ثبت نام و وارد شدید.');
        } else {

            // echo "NOK"; // die();

            return back()->back()->withErrors(['verification_code' => 'کد تایید نادرست است.']);
        }
    }


    // خروج از سیستم
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
