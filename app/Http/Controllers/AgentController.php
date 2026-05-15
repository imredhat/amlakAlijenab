<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AgentController extends Controller
{
    /**
     * نمایش صفحه مشاور املاک + املاک او
     */
    public function show($phone, Request $request)
    {


        if (Auth::check()) {
            $id = Auth::id();
            $user = User::where('id', $id)->get();
        }


        $sort = $request->segment(3) ?? '';
        $srt = 'id';
        $dir = 'DESC';


        if (!empty($sort)) {
            if ($sort = 'newest') {
                $srt = 'id';
                $dir = 'DESC';
            }
            if ($sort = 'price_high') {
                $srt = 'price';
                $dir = 'DESC';
            }
            if ($sort = 'price_low') {
                $srt = 'price';
                $dir = 'ASC';
            }
        }

        // echo $srt."|";
        // echo $dir;
        // die();



        // پیدا کردن مشاور
        $agent = User::where('tel', $phone)
            // ->where('type', 'agent')   // اگر فیلد type داری
            // ->orWhere('is_agent', true)
            ->firstOrFail();

        // املاک مشاور (فروش)

        $properties = DB::table('property')
            ->where('user_id', $agent->id)
            ->orderBy($srt, $dir)
            // ->orWhere('price', '>', 0)
            // ->orderBy('date_created', 'desc')
            ->paginate(12);


        // $rentProperties = DB::table('property')
        //     ->where(function ($query) {
        //         $query->where('mortgage', '>', 0)
        //             ->orWhere('rent', '>', 0)
        //             ->orWhere('daily_rent', '>', 0);
        //     })
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(9);

        // املاک مشاور (اجاره)
        // $rentProperties = Property::where('user_id', $agent->id)
        //     ->where(function ($query) {
        //         $query->where('mortgage', '>', 0)
        //             ->orWhere('rent', '>', 0)
        //             ->orWhere('daily_rent', '>', 0);
        //     })
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(9);

        // تعداد کل املاک مشاور
        $totalProperties = Property::where('user_id', $agent->id)->count();

        return view('real-estate.vendor-properties', compact(
            'agent',
            'properties',
            'totalProperties',
            'user'
        ));
    }

    /**
     * لیست همه مشاوران (اختیاری - برای صفحه مشاوران)
     */
    public function index()
    {


        if (Auth::check()) {
            $id = Auth::id();
            $user = User::where('id', $id)->get();
        }

        $agents = User::orderBy('created_at', 'desc')

            // ->where('type', 'agent')
            // ->orWhere('is_agent', true)
            ->paginate(12);

        return view('real-estate.agents-list', compact('agents,user'));
    }
}
