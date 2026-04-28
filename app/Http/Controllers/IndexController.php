<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Section;
use Illuminate\Support\Facades\DB;



class IndexController extends Controller
{
    // در کنترلر
    public function index()
    {

        $data = [];
        if (Auth::check()) {
            $id = Auth::id();
            $data['user'] = User::where('id', $id)->get();
        }

        $data['header'] = Section::where('position', 'header')->get();
        $data['catalog'] = Section::where('position', 'catalog')->get();
        $data['banner'] = Section::where('position', 'banner')->get();
        $data['recent'] = DB::table('property') -> orderBy('visit_count', 'DESC')->paginate(10);
        $data['special'] = DB::table('property') -> where ('category' , 'land')-> orderBy('visit_count', 'DESC')->get();
        $data['city'] = DB::table('cties') -> get();
        // $data['special'] = DB::table('property') -> limit(3) -> where ('category' , 'land')-> orderBy('date_created', 'DESC');
        // $data['special'] = Property::where('category' , 'land') -> get();
        


        // echo "<pre>";
        // echo json_encode(array_slice($data['special'],1));
        // die();

        return view('index', $data);
    }
}
