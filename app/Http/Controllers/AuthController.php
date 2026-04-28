<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use stdClass;


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


        if ($user && $user > 0) {

            // اگر کاربر وجود داشت، کد تایید تولید و ارسال کن
            $verificationCode = rand(1000, 9999);

            $user = User::where('tel', $tel)->first();

            // ذخیره کد در سشن
            $request->session()->put('verification_code', $verificationCode);
            $request->session()->put('tel', $tel);
            $request->session()->put('user_id', $user->id);

            User::where('tel', $tel)->update([
                'verificationCode' => $verificationCode
            ]);

            // TODO: ارسال کد به شماره موبایل (SMS)

            $data = [
                'success' => 'حساب کاربری شما ایجاد شد. کد تایید به شماره موبایل شما ارسال شد.',
                'code' => $verificationCode
            ];
            return view('auth.verify', $data);

            
        } else {
            $verificationCode = rand(1000, 9999);

            $user = User::create([
                'tel' => $tel,
                'verificationCode' =>  $verificationCode,
                'type' => "user"
            ]);


            $request->session()->put('verification_code', $verificationCode);
            $request->session()->put('tel', $tel);


            $this->sendSMS($tel, $verificationCode);
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

        $tel = $request->session()->get('tel');
        $code = $request->input('code');

        $verificationCode = $code[0] . $code[1] . $code[2] . $code[3];


        // بررسی کد تایید
        if ($request->session()->get('verification_code') == $verificationCode && $request->session()->get('tel') == $tel) {

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



    public function sendSMS($tel, $code)
    {

        // Prepare message
        $message = "کد شما : " . $code;
        $body = [
            "sending_type" => "webservice",
            "from_number" => "+983000505",
            "message" => $message,
            "params" => [
                "recipients" => [
                    $tel
                    // Add more numbers if needed
                ]
            ],
        ];


        // Send request
        $response = new stdClass();
        $url = 'https://edge.ippanel.com/v1/api/send/webservice';
        $apiKey = 'YTAwODlhZDQtNGEyNi00MDQyLTliNTgtMjc0YzY5NDQxZWNlM2ZkNzRkZjJhOWE2YjNlYTMzYjUxYzM2OTQ4YTA0NDc=';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://edge.ippanel.com/v1/api/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: YTAwODlhZDQtNGEyNi00MDQyLTliNTgtMjc0YzY5NDQxZWNlM2ZkNzRkZjJhOWE2YjNlYTMzYjUxYzM2OTQ4YTA0NDc=',
                'Cookie: TS01fb45f4=0150a3e24e3545a750ed6bca459a4cf0c3d80f745e6002ada65cc8f926dfdfae5ce2da0471cdf79d295f08fbfbf8bacad213e6db5d'
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


        curl_close($curl);

        return response()->json([
            'status' => 'sent',
            'api_response' => $response, // این $response باید مقدار برگشتی از curl_exec باشد
            'httpcode' => $httpcode
        ]);
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
