<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Ippanel\Client as IPPanelClient;


class AuthController extends Controller
{
    public function formLogin()
    {
        return view('auth.login');
    }

    public function prosrsslogin(Request $request)
    {
        $tel = $request->input('tel');

        $verificationCode = rand(1000, 9999);
        $user = User::where('tel', $tel)->first();

        if ($user) {
            $user->update(['verificationCode' => $verificationCode]);
        } else {
            $user = User::create([
                'tel' => $tel,
                'verificationCode' => $verificationCode,
                'type' => "user"
            ]);
        }

        $request->session()->put([
            'verification_code' => $verificationCode,
            'tel' => $tel,
            'user_id' => $user->getKey(),
        ]);
        $request->session()->save();

        $this->sendSMS($tel, $verificationCode);

        return view('auth.verify', [
            'success' => 'کد تایید به شماره موبایل شما ارسال شد.',
            'code' => $verificationCode,
        ]);
    }


    public function signUp(Request $request)
    {
        $tel = $request->session()->get('tel');
        $code = (array) $request->input('code', []);
        $verificationCode = implode('', array_slice($code, 0, 4));

        if ($request->session()->get('verification_code') == $verificationCode && $request->session()->get('tel') == $tel) {

            $user = User::where('tel', $tel)->first();

            if ($user) {
                $user->update(['status' => 'verified']);
            } else {
                return redirect('/auth/login')->withErrors([
                    'tel' => 'کاربر مربوط به این شماره موبایل پیدا نشد.',
                ]);
            }

            $request->session()->put('user_id', $user->getKey());
            $request->session()->forget(['verification_code', 'tel']);
            $request->session()->save();

            return redirect('/home')->with('success', 'شما با موفقیت ثبت نام و وارد شدید.');
        } else {
            return back()->withErrors(['verification_code' => 'کد تایید نادرست است.']);
        }
    }


    public function sendSMS($tel, $code)
    {
        try {
            $apiKey = config('ippanel.api_key');
            $sender = env('IPPANEL_SENDER', '+983000505');
            $patternCode = env('IPPANEL_PATTERN_CODE', 'tyxk74ikj5');

            $client = new IPPanelClient($apiKey);

            $response = $client->sendPattern($patternCode, $sender, $tel, ['code' => $code]);

            Log::info('SMS sent successfully', [
                'tel' => $tel,
                'status' => $response->isSuccessful(),
                'message' => $response->getMessage(),
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('SMS send failed', [
                'tel' => $tel,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
