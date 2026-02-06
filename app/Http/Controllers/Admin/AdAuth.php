<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdAuth extends Controller
{
    // نمایش فرم لاگین
    public function formLogin()
    {

        if (session()->has('admin_id')) {
            return redirect('/admin/dashboard');
        } else {

            return view('admin.auth.login');
        }

    }

    public function prosrsslogin(Request $request)
    {
        $user = $request->input('user');
        $pass = $request->input('pass');

        $admin = Admin::where('username', $user)->where('type', 'admin')->first();

        if ($admin && Hash::check($pass, $admin->password)) {
            // موفقیت در لاگین
            $request->session()->put('admin', $admin);
            $request->session()->put('admin_id', $admin->_id ?? $admin->id);

            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'نام کاربری یا رمز عبور اشتباه است.');
    }

    public function forget()
    {
        return view('admin.auth.forget');
    }

    public function recover(Request $request)
    {
        $user = $request->input('user');

        $admin = Admin::where('username', $user)
            ->orWhere('tel', $user)
            ->first();

        if ($admin) {
            //send SMS

            $code = rand(1000, 9999);
            Admin::where('id', $admin->id)->update([
                'verificationCode' => $code,
            ]);

            $request->session()->put('recovery_admin_id', $admin->_id ?? $admin->id);
            $request->session()->put('recovery_code', $code);

            return redirect('/admin/two_step')->with('success', 'کد بازیابی به شماره موبایل شما ارسال شد');
        }
        return back()->with('error', 'نام کاربری یا شماره موبایل اشتباه است.');
    }

    public function two_step()
    {
        return view('admin.auth.two_step');
    }

    public function changepass(Request $request)
    {
        // $request->validate([
        //     'code'     => 'required',
        //     'password' => 'required|min:6|confirmed',
        // ]);

        $code         = $request->input('code');
        $pass         = $request->input('password');
        $repass       = $request->input('repassword');
        $adminId      = $request->session()->get('recovery_admin_id');
        $recoveryCode = $request->session()->get('recovery_code');

        if (! $adminId || ! $recoveryCode) {
            return redirect('/admin/forget')->with('error', 'جلسه بازیابی منقضی شده، دوباره تلاش کنید.');
        }

        if ($code != $recoveryCode) {
            return back()->with('error', 'کد وارد شده اشتباه است.');
        }

        if ($pass != $repass) {
            return back()->with('error', 'رمز عبور با تکرار آن یکسان نیست');
        }

        $admin = Admin::find($adminId);
        if (! $admin) {
            return redirect('/admin/forget')->with('error', 'کاربر یافت نشد.');
        }

        // $admin->password = Hash::make($pass);

        $admin->password = $pass;
        $admin->save();

        $request->session()->forget(['recovery_admin_id', 'recovery_code']);

        return redirect('/admin/login')->with('success', 'رمز عبور با موفقیت تغییر کرد.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
