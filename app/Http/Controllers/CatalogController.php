<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cty;
use App\Models\Neighborhood;

use Hekmatinasser\Verta\Verta;




class CatalogController extends Controller
{

    public function getPropertiesByLocation(Request $request, $slug)
    {
        // پیدا کردن محله بر اساس slug
        $neighborhood = Neighborhood::where('tag', $slug)->first();


        if (!$neighborhood) {
            abort(404, 'محله مورد نظر یافت نشد');
        }

        $type = $request->get('type', 'sale');

        // ساخت کوئری بر اساس محله
        $query = DB::table('property')->where('neighborhood', $neighborhood->name);

        // فیلتر بر اساس نوع آگهی (اجاره یا فروش)
        if (!empty($type) && $type === 'rent') {
            $query->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->where('mortgage', '>', 0)
                        ->orWhere('mortgage', '!=', null);
                })->orWhere(function ($sub) {
                    $sub->where('rent', '>', 0)
                        ->orWhere('rent', '!=', null);
                })->orWhere(function ($sub) {
                    $sub->where('daily_rent', '>', 0)
                        ->orWhere('daily_rent', '!=', null);
                });
            });
        } else {
            $query->where(function ($q) {
                $q->where('price', '>', 0)
                    ->orWhere('price', '!=', null);
            });
        }

        // مرتب‌سازی بر اساس آخرین آگهی‌ها
        $properties = $query->orderBy('id', 'DESC')->paginate(12);
        $cities = Cty::orderBy('order')->get();
        $locations = DB::table('neighborhoods')->where('showInMenu', true)->get();

        return view('real-estate.catalog-location', compact('properties', 'cities', 'type', 'locations', 'neighborhood'));
    }



    public function getRentProperties(Request $request)
    {

        $query = DB::table('property');
        $query->where(function ($q) {
            $q->where(function ($sub) {
                $sub->where('mortgage', '<=', 0)
                    ->orWhere('mortgage', '!=', null);
            })->orWhere(function ($sub) {
                $sub->where('rent', '>', 0)
                    ->orWhere('rent', '!=', null);
            })->orWhere(function ($sub) {
                $sub->where('daily_rent', '>', 0)
                    ->orWhere('daily_rent', '!=', null);
            });
        });


        // مرتب‌سازی بر اساس آخرین آگهی‌ها
        $properties = $query->orderBy('id', 'DESC')->paginate(12);

        $cities = Cty::orderBy('order')->get();
        $neighborhood = DB::table('neighborhoods')->get();
        $locations = DB::table('neighborhoods')->where('showInMenu', true)->get();

        return view('real-estate.catalog-rent', compact('properties', 'cities',  'locations', 'neighborhood'));
    }


    public function initialize(Request $request)
    {
        $data = [];
        if (Auth::check()) {
            $tel = $request->session()->get('tel');
            $data['user'] = User::where('tel', $tel)->get();
        }

        $data['locations'] = DB::table('neighborhoods')->where('showInMenu', true)->get();

        return $data;
    }


    public function getNeighborhoods(Request $request)
    {
        $cityId = $request->city_id;
        $cityName = $request->city_name;

        if ($cityId) {
            $neighborhoods = Neighborhood::where('city_id', $cityId)
                ->orderBy('order', 'asc')
                ->get();
        }
        // بر اساس نام شهر


        if ($cityName) {
            $city = Cty::where('name', $cityName)->first();
            if ($city) {
                $neighborhoods = Neighborhood::where('city_id', $city->id)
                    ->orderBy('order', 'asc')
                    ->get();
            } else {
                $neighborhoods = collect([]);
            }
        }

        if (empty($neighborhoods)) {
            $neighborhoods = collect([]);
        }




        return response()->json([
            'success' => true,
            'neighborhoods' => $neighborhoods
        ]);
    }
}
