<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pages;
use App\Models\User;
use App\Models\FAQ;

class PageController extends Controller
{
    public function about()
    {

        $data['about'] = Pages::where('slug', 'about')->first();




        if (Auth::check()) {
            $id = Auth::id();
            $data['user'] = User::where('id', $id)->get();
        }
        return view('pages.about', $data);
    }


    public function contact()
    {

        $data['contact'] = Pages::where('slug', 'contact')->first();

        if (Auth::check()) {
            $id = Auth::id();
            $data['user'] = User::where('id', $id)->get();
        }
        return view('pages.contact', $data);
    }


    public function faqs()
    {
        $data = [];


        $data['faqs'] = FAQ::orderBy('order')->orderBy('id')->get();


        if (Auth::check()) {
            $id = Auth::id();
            $data['user'] = User::where('id', $id)->get();
        }
        // dd($data);
        return view('pages.faq', $data);
    }
}
