<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cty;
use App\Models\Neighborhood;
use App\Models\Favorite;



use Hekmatinasser\Verta\Verta;


class CatalogController extends Controller
{
    private function queryWithDetails()
    {
        $detailCols = 'property_details.property_id, property_details.capacity, property_details.standard_capacity, property_details.extra_capacity, property_details.rental_period, property_details.check_in_time, property_details.check_out_time, property_details.minimum_stay, property_details.price, property_details.mortgage, property_details.rent, property_details.daily_rent, property_details.regular_days, property_details.weekend, property_details.special_days, property_details.extra_person_cost, property_details.floor, property_details.unit_per_floor, property_details.floors_count, property_details.totalFloors, property_details.floor_count, property_details.build_year, property_details.construction_year, property_details.year_built, property_details.building_type, property_details.building_direction, property_details.floor_type, property_details.document_type, property_details.document_status, property_details.current_status, property_details.type as detail_type, property_details.usage_type, property_details.building_facade, property_details.parking, property_details.storage, property_details.elevator, property_details.balcony, property_details.rebuilt, property_details.has_loan, property_details.pool, property_details.pool_type, property_details.sauna, property_details.jacuzzi, property_details.furnished, property_details.convertible, property_details.cooling_system, property_details.heating_system, property_details.pets_allowed, property_details.kitchen_type, property_details.cabinet_material, property_details.toilet, property_details.property_location, property_details.building_permit, property_details.has_old_building, property_details.exchangeable, property_details.utilities, property_details.propertyCondition, property_details.projectType, property_details.roomCount, property_details.participationPercent, property_details.initialPayment, property_details.deliveryPayment, property_details.projectStatus, property_details.deliveryYear, property_details.deliveryMonth, property_details.physicalProgress, property_details.unitsPerFloor, property_details.minUnitArea, property_details.builderName, property_details.constructionPermit, property_details.exchange';

        return DB::table('property')
            ->leftJoin('property_details', 'property.id', '=', 'property_details.property_id')
            ->selectRaw('property.*, ' . $detailCols)
            ->whereNotIn('property.status', ['حذف شده', 'غیرفعال', 'منقضی'])
            ->where('property._status', 'active');
    }

    public function getPropertiesByLocation(Request $request, $slug)
    {

    $favoriteIds = [];
    $user = [];
    if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        }
        $neighborhood = Neighborhood::where('tag', $slug)->first();

        if (!$neighborhood) {
            abort(404, 'محله مورد نظر یافت نشد');
        }

        $type = $request->get('type', 'sale');

        $query = $this->queryWithDetails()->where('neighborhood', $neighborhood->name);

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

        // ── Price range ──
        $priceField = $type === 'rent' ? 'mortgage' : 'price';
        $priceMin = $request->get('min_price');
        if ($priceMin) {
            $query->where($priceField, '>=', preg_replace('/\D/', '', $priceMin));
        }
        $priceMax = $request->get('max_price');
        if ($priceMax) {
            $query->where($priceField, '<=', preg_replace('/\D/', '', $priceMax));
        }

        // ── Rent range ──
        $rentMin = $request->get('rent_min');
        if ($rentMin) {
            $query->where('rent', '>=', preg_replace('/\D/', '', $rentMin));
        }
        $rentMax = $request->get('rent_max');
        if ($rentMax) {
            $query->where('rent', '<=', preg_replace('/\D/', '', $rentMax));
        }

        // ── Area ──
        $areaMin = $request->get('min_area');
        if ($areaMin) {
            $query->where('property.area', '>=', $areaMin);
        }
        $areaMax = $request->get('max_area');
        if ($areaMax) {
            $query->where('property.area', '<=', $areaMax);
        }

        // ── Rooms ──
        $rooms = $request->get('rooms');
        if ($rooms !== null && $rooms !== '' && $rooms !== '0') {
            $query->where('property.rooms', $rooms);
        }

        // ── Floor ──
        $floor = $request->get('floor');
        if ($floor !== null && $floor !== '' && $floor !== '0') {
            $query->where('property_details.floor', $floor);
        }

        // ── Amenities ──
        if ($request->boolean('parking')) {
            $query->where('property_details.parking', '>', 0);
        }
        if ($request->boolean('storage')) {
            $query->where('property_details.storage', '>', 0);
        }
        if ($request->boolean('elevator')) {
            $query->where('property_details.elevator', '>', 0);
        }
        if ($request->boolean('balcony')) {
            $query->where('property_details.balcony', '>', 0);
        }
        if ($request->boolean('pool')) {
            $query->where('property_details.pool', 1);
        }
        if ($request->boolean('furnished')) {
            $query->where('property_details.furnished', 1);
        }

        // ── Sorting ──
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy($priceField, 'ASC');
                break;
            case 'price_desc':
                $query->orderBy($priceField, 'DESC');
                break;
            case 'area_asc':
                $query->orderBy('property.area', 'ASC');
                break;
            case 'area_desc':
                $query->orderBy('property.area', 'DESC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);

        // AJAX response
        if ($request->ajax()) {
            $html = view('real-estate.catalog-location-cards', compact('properties'))->render();
            $pagination = view('real-estate.catalog-location-pagination', compact('properties'))->render();
            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'total' => $properties->total(),
            ]);
        }

        return view('real-estate.catalog-location', compact('properties', 'type', 'neighborhood' , 'user', 'favoriteIds'));
    }


    public function getRentProperties(Request $request)
    {
        $user = [];
        $type = 'rent';
        $query = $this->queryWithDetails();
        $query->where(function ($q) {
            $q->where('mortgage', '>', 0)
                ->orWhere('rent', '>', 0)
                ->orWhere('daily_rent', '>', 0);
        });

        // ── Neighborhood filter ──
        $selectedNeighborhood = $request->get('neighborhood');
        if ($selectedNeighborhood) {
            $query->where('property.neighborhood', $selectedNeighborhood);
        }

        // ── City filter ──
        $city = $request->get('city');
        if ($city) {
            $query->where('property.city', $city);
        }

        // ── Category filter ──
        $categories = $request->get('category');
        if (!empty($categories)) {
            $expanded = [];
            foreach ((array) $categories as $cat) {
                if ($cat === 'apartment') {
                    $expanded[] = 'apartment-rent';
                    $expanded[] = 'apartment-sale';
                } elseif ($cat === 'villa') {
                    $expanded[] = 'villa-sale';
                    $expanded[] = 'villa-short-rent';
                } elseif ($cat === 'commercial') {
                    $expanded[] = 'commercial-sale';
                    $expanded[] = 'commercial-rent';
                } else {
                    $expanded[] = $cat;
                }
            }
            $query->whereIn('property.category', array_unique($expanded));
        }

        // ── Price range (rent: rent field = monthly rent) ──
        $priceMin = $request->get('price_min');
        if ($priceMin) {
            $cleanMin = preg_replace('/\D/', '', $priceMin);
            $query->where('rent', '>=', $cleanMin);
        }
        $priceMax = $request->get('price_max');
        if ($priceMax) {
            $cleanMax = preg_replace('/\D/', '', $priceMax);
            $query->where('rent', '<=', $cleanMax);
        }

        // ── Area range ──
        $areaMin = $request->get('area_min');
        if ($areaMin) {
            $query->where('property.area', '>=', $areaMin);
        }
        $areaMax = $request->get('area_max');
        if ($areaMax) {
            $query->where('property.area', '<=', $areaMax);
        }

        // ── Sorting ──
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_high':
                $query->orderBy('mortgage', 'DESC');
                break;
            case 'price_low':
                $query->orderBy('mortgage', 'ASC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);

        // AJAX response
        if ($request->ajax()) {
            $html = view('real-estate.catalog-cards', compact('properties'))->render();
            return response()->json([
                'html' => $html,
                'total' => $properties->total(),
            ]);
        }

        $pageTitle = 'لیست املاک برای اجاره';

        $favoriteIds = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        }

        return view('real-estate.catalog-type', compact('properties', 'type', 'pageTitle','user', 'favoriteIds'));
    }


    public function getSaleProperties(Request $request)
    {
        $type = 'sale';
        $user = [];
        $query = $this->queryWithDetails();
        $query->where('price', '>', 0);

        // ── Neighborhood filter ──
        $selectedNeighborhood = $request->get('neighborhood');
        if ($selectedNeighborhood) {
            $query->where('property.neighborhood', $selectedNeighborhood);
        }

        // ── City filter ──
        $city = $request->get('city');
        if ($city) {
            $query->where('property.city', $city);
        }

        // ── Category filter ──
        $categories = $request->get('category');
        if (!empty($categories)) {
            $expanded = [];
            foreach ((array) $categories as $cat) {
                if ($cat === 'apartment') {
                    $expanded[] = 'apartment-rent';
                    $expanded[] = 'apartment-sale';
                } elseif ($cat === 'villa') {
                    $expanded[] = 'villa-sale';
                    $expanded[] = 'villa-short-rent';
                } elseif ($cat === 'commercial') {
                    $expanded[] = 'commercial-sale';
                    $expanded[] = 'commercial-rent';
                } else {
                    $expanded[] = $cat;
                }
            }
            $query->whereIn('property.category', array_unique($expanded));
        }

        // ── Price range ──
        $priceMin = $request->get('price_min');
        if ($priceMin) {
            $cleanMin = preg_replace('/\D/', '', $priceMin);
            $query->where('price', '>=', $cleanMin);
        }
        $priceMax = $request->get('price_max');
        if ($priceMax) {
            $cleanMax = preg_replace('/\D/', '', $priceMax);
            $query->where('price', '<=', $cleanMax);
        }

        // ── Area range ──
        $areaMin = $request->get('area_min');
        if ($areaMin) {
            $query->where('property.area', '>=', $areaMin);
        }
        $areaMax = $request->get('area_max');
        if ($areaMax) {
            $query->where('property.area', '<=', $areaMax);
        }

        // ── Sorting ──
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_high':
                $query->orderBy('price', 'DESC');
                break;
            case 'price_low':
                $query->orderBy('price', 'ASC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);

        // AJAX response
        if ($request->ajax()) {
            $html = view('real-estate.catalog-cards', compact('properties'))->render();
            return response()->json([
                'html' => $html,
                'total' => $properties->total(),
            ]);
        }

        $pageTitle = 'لیست املاک برای فروش';

        $favoriteIds = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        }

        return view('real-estate.catalog-type', compact('properties', 'type', 'pageTitle','user', 'favoriteIds'));
    }


    public function getUnder100mProperties(Request $request)
    {
        $user = [];
        $query = $this->queryWithDetails();
        $query->where('area', '<=', 100);
        $query->where(function ($q) {
            $q->where('category', 'apartment-rent')
                ->orWhere('category', 'apartment-sale');
        });

        // ── Sorting ──
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_high':
                $query->orderBy('price', 'DESC');
                break;
            case 'price_low':
                $query->orderBy('price', 'ASC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);

        if ($request->ajax()) {
            $html = view('real-estate.catalog-cards', compact('properties'))->render();
            return response()->json(['html' => $html, 'total' => $properties->total()]);
        }

        $pageTitle = 'املاک زیر ۱۰۰ متر';
        $favoriteIds = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        }
        return view('real-estate.catalog-type', compact('properties', 'pageTitle','user', 'favoriteIds'));
    }


    public function getAbove100mProperties(Request $request)
    {
        $user = [];
        $query = $this->queryWithDetails();
        $query->where('area', '>', 100);
        $query->where(function ($q) {
            $q->where('category', 'apartment-rent')
                ->orWhere('category', 'apartment-sale');
        });

        // ── Sorting ──
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_high':
                $query->orderBy('price', 'DESC');
                break;
            case 'price_low':
                $query->orderBy('price', 'ASC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);

        if ($request->ajax()) {
            $html = view('real-estate.catalog-cards', compact('properties'))->render();
            return response()->json(['html' => $html, 'total' => $properties->total()]);
        }

        $pageTitle = 'املاک بالای ۱۰۰ متر';
        $favoriteIds = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        }
        return view('real-estate.catalog-type', compact('properties', 'pageTitle','user', 'favoriteIds'));
    }


    public function getViewSeaProperties(Request $request)
    {
        $user = [];
        $query = $this->queryWithDetails();
        $query->where('property_view', 'دریا');

        // ── Sorting ──
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_high':
                $query->orderBy('price', 'DESC');
                break;
            case 'price_low':
                $query->orderBy('price', 'ASC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);

        if ($request->ajax()) {
            $html = view('real-estate.catalog-cards', compact('properties'))->render();
            return response()->json(['html' => $html, 'total' => $properties->total()]);
        }

        $pageTitle = 'املاک با ویو دریا';
        $favoriteIds = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        }
        return view('real-estate.catalog-type', compact('properties', 'pageTitle','user', 'favoriteIds'));
    }


    public function getViewJungleProperties(Request $request)
    {
        $user = [];
        $query = $this->queryWithDetails();
        $query->where('property_view', 'جنگل');

        // ── Sorting ──
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_high':
                $query->orderBy('price', 'DESC');
                break;
            case 'price_low':
                $query->orderBy('price', 'ASC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);

        if ($request->ajax()) {
            $html = view('real-estate.catalog-cards', compact('properties'))->render();
            return response()->json(['html' => $html, 'total' => $properties->total()]);
        }

        $pageTitle = 'املاک با ویو جنگل';
        $favoriteIds = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        }
        return view('real-estate.catalog-type', compact('properties', 'pageTitle','user', 'favoriteIds'));
    }


    public function initialize(Request $request)
    {
        
        $data = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $data['user'] = User::where('id', $id)->get();
            $data['favoriteIds'] = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        } else {
            $data['favoriteIds'] = [];
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


    public function getPropertiesByCity(Request $request, $slug)
    {
        $user = [];
        $city = Cty::where('tag', $slug)->first();
        if (!$city) {
            abort(404, 'شهر مورد نظر یافت نشد');
        }

        $type = $request->get('type');
        $query = $this->queryWithDetails()->where('property.city', $city->name);

        // ── Type filter ──
        if ($type === 'rent') {
            $query->where(function ($q) {
                $q->where('mortgage', '>', 0)
                    ->orWhere('rent', '>', 0)
                    ->orWhere('daily_rent', '>', 0);
            });
        } elseif ($type === 'sale') {
            $query->where('price', '>', 0);
        }

        // ── Neighborhood filter ──
        $neighborhood = $request->get('neighborhood');
        if ($neighborhood) {
            $query->where('property.neighborhood', $neighborhood);
        }

        // ── Category filter ──
        $categories = $request->get('category');
        if (!empty($categories)) {
            $expanded = [];
            foreach ((array) $categories as $cat) {
                if ($cat === 'apartment') {
                    $expanded[] = 'apartment-rent';
                    $expanded[] = 'apartment-sale';
                } elseif ($cat === 'villa') {
                    $expanded[] = 'villa-sale';
                    $expanded[] = 'villa-short-rent';
                } elseif ($cat === 'commercial') {
                    $expanded[] = 'commercial-sale';
                    $expanded[] = 'commercial-rent';
                } else {
                    $expanded[] = $cat;
                }
            }
            $query->whereIn('property.category', array_unique($expanded));
        }

        // ── Price range ──
        $priceMin = $request->get('price_min');
        if ($priceMin) {
            $cleanMin = preg_replace('/\D/', '', $priceMin);
            if ($cleanMin > 0 && $cleanMin < 10000) {
                $cleanMin = $cleanMin * 1000000;
            }
            $priceField = $type === 'rent' ? 'mortgage' : 'price';
            $query->where($priceField, '>=', $cleanMin);
        }
        $priceMax = $request->get('price_max');
        if ($priceMax) {
            $cleanMax = preg_replace('/\D/', '', $priceMax);
            if ($cleanMax > 0 && $cleanMax < 10000) {
                $cleanMax = $cleanMax * 1000000;
            }
            $priceField = $type === 'rent' ? 'mortgage' : 'price';
            $query->where($priceField, '<=', $cleanMax);
        }

        // ── Area range ──
        $areaMin = $request->get('area_min');
        if ($areaMin) {
            $query->where('property.area', '>=', $areaMin);
        }
        $areaMax = $request->get('area_max');
        if ($areaMax) {
            $query->where('property.area', '<=', $areaMax);
        }

        // ── Sorting ──
        $sort = $request->get('sort', 'newest');
        $priceField = $type === 'rent' ? 'mortgage' : 'price';
        switch ($sort) {
            case 'price_high':
                $query->orderBy($priceField, 'DESC');
                break;
            case 'price_low':
                $query->orderBy($priceField, 'ASC');
                break;
            case 'area_desc':
                $query->orderBy('property.area', 'DESC');
                break;
            case 'area_asc':
                $query->orderBy('property.area', 'ASC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);

        $neighborhoods = DB::table('neighborhoods')
            ->where('city_id', $city->id)
            ->orderBy('order')
            ->get();

        // AJAX response
        if ($request->ajax()) {
            $html = view('real-estate.catalog-cards', compact('properties'))->render();
            return response()->json([
                'html' => $html,
                'total' => $properties->total(),
            ]);
        }
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        } else {
            $favoriteIds = [];
        }

        return view('real-estate.catalog-city', compact('properties', 'city', 'neighborhoods', 'type','user', 'favoriteIds'));
    }
}
