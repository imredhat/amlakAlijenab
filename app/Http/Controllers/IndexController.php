<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class IndexController extends Controller
{
    // در کنترلر
    public function index()
    {

        $data =[];
        if (Auth::check()) {
            $id = Auth::id();
            $data['user'] = User::where('id', $id)->get();
        }

        return view('index', $data);
    }
}
