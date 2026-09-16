<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Pages;
use App\Models\User;
use App\Models\Faq;
use App\Models\ContactsForm;

class PageController extends Controller
{
    public function about()
    {

        $data['about'] = Pages::where('slug', 'about')->first();
        $data['locations'] = DB::table('neighborhoods') -> get();




        if (session()->has('user_id')) {
            $id       = session('user_id');
            $data['user'] = User::where('id', $id)->get();
        }
        return view('pages.about', $data);
    }


    public function contact()
    {

        $data['contact'] = Pages::where('slug', 'contact')->first();
        $data['locations'] = DB::table('neighborhoods') -> get();

        if (session()->has('user_id')) {
            $id       = session('user_id');
            $data['user'] = User::where('id', $id)->get();
        }
        return view('pages.contact', $data);
    }


    public function saveContactForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'tel'     => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        ContactsForm::create([
            'name'          => $request->name,
            'tel'           => $request->tel,
            'message'       => $request->message,
            'date_created'  => now(),
            'date_updated'  => now(),
        ]);

        return back()->with('contact_success', 'پیام شما با موفقیت ارسال شد. به زودی با شما تماس خواهیم گرفت.');
    }


    public function faqs()
    {
        $data = [];


        $data['faqs'] = FAQ::orderBy('order')->orderBy('id')->get();
        $data['locations'] = DB::table('neighborhoods') -> get();


        if (session()->has('user_id')) {
            $id       = session('user_id');
            $data['user'] = User::where('id', $id)->get();
        }
        // dd($data);
        return view('pages.faq', $data);
    }
}
