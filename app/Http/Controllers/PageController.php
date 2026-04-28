<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pages;
use App\Models\User;

class PageController extends Controller
{
    public function about()
    {

        $data['about'] = Pages::where('tag', 'about') -> first();

        if (Auth::check()) {
            $id = Auth::id();
            $data['user'] = User::where('id', $id)->get();
        }
        return view('user.pages.about', $data);
    }


    public function contact()
    {

        $data['contact'] = Pages::where('slug', 'contact') -> first();

        if (Auth::check()) {
            $id = Auth::id();
            $data['user'] = User::where('id', $id)->get();
        }
        return view('pages.contact', $data);
    }





}