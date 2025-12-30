<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    // در کنترلر
    public function index()
    {
        $data = [
            'name' => 'علی',
            'features' => ['لاراول', 'Blade', 'Eloquent', 'MongoDB']
        ];

        return view('index', $data);
    }
}
