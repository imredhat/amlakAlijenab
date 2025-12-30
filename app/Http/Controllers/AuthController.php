<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    // پردازش لاگین
    public function prosrsslogin(Request $request)
    {
        // برای دیباگ
        // dd($request->all()); // این خط را برای تست فعال کنید

        // اعتبارسنجی داده‌ها
        $request->validate([
            'tel' => 'required|string|min:10|max:15'
        ]);

        $tel = $request->input('tel');

        // بررسی وجود کاربر با این شماره موبایل
        $user = User::where('tel', $tel)->first();

        if ($user) {
            // اگر کاربر وجود داشت، کد تایید تولید و ارسال کن
            $verificationCode = rand(1000, 9999);

            // ذخیره کد در سشن
            $request->session()->put('verification_code', $verificationCode);
            $request->session()->put('tel', $tel);

            // TODO: ارسال کد به شماره موبایل (SMS)
            // در اینجا می‌توانید از سرویس SMS استفاده کنید

            return back()->with([
                'success' => 'کد تایید به شماره موبایل شما ارسال شد.',
                'code' => $verificationCode // برای تست - در تولید حذف کنید
            ]);
        } else {
            // اگر کاربر وجود نداشت، ایجاد کن
            $user = User::create([
                'tel' => $tel,
            ]);

            // تولید و ارسال کد تایید
            $verificationCode = rand(1000, 9999);

            // ذخیره کد در سشن
            $request->session()->put('verification_code', $verificationCode);
            $request->session()->put('tel', $tel);

            // TODO: ارسال کد به شماره موبایل (SMS)
            // در اینجا می‌توانید از سرویس SMS استفاده کنید

            return back()->with([
                'success' => 'حساب کاربری شما ایجاد شد. کد تایید به شماره موبایل شما ارسال شد.',
                'code' => $verificationCode // برای تست - در تولید حذف کنید
            ]);
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
