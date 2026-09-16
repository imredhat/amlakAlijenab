<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cty;
use App\Models\Favorite;

class CategoryController extends Controller
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

    /**
     * Browse apartments (all apartment categories: apartment-rent + apartment-sale)
     * URL: /browse/apartment
     */
    public function apartment(Request $request)
    {
        return $this->browse($request, 'apartment');
    }

    /**
     * Browse properties by specific category
     * URL: /browse/{category}
     */
    public function browse(Request $request, $category = null)
    {
        $validCategories = [
            'apartment-rent', 'apartment-sale', 'villa-sale', 'villa-short-rent',
            'commercial-rent', 'commercial-sale', 'land', 'pre-sale', 'other',
        ];

        $parentCategories = [
            'apartment' => ['apartment-rent', 'apartment-sale'],
            'villa'     => ['villa-sale', 'villa-short-rent'],
            'commercial' => ['commercial-rent', 'commercial-sale'],
        ];

        $query = $this->queryWithDetails();

        if ($category === 'apartment') {
            $categories = $parentCategories['apartment'];
            $title = 'آپارتمان';
            $slug = 'apartment';
        } elseif ($category === 'villa') {
            $categories = $parentCategories['villa'];
            $title = 'ویلا';
            $slug = 'villa';
        } elseif ($category === 'commercial') {
            $categories = $parentCategories['commercial'];
            $title = 'اداری و تجاری';
            $slug = 'commercial';
        } elseif (in_array($category, $validCategories)) {
            $categories = [$category];
            $title = getCat($category);
            $slug = $category;
        } else {
            abort(404);
        }

        $query->whereIn('property.category', $categories);

        // Filter by type (rent/sale)
        $type = $request->get('type');
        if ($type === 'rent') {
            $query->where(function ($q) {
                $q->where('mortgage', '>', 0)
                    ->orWhere('rent', '>', 0)
                    ->orWhere('daily_rent', '>', 0);
            });
        } elseif ($type === 'sale') {
            $query->where('price', '>', 0);
        }

        // Filter by city
        $city = $request->get('city');
        if ($city) {
            $query->where('property.city', $city);
        }

        // Filter by neighborhood
        $neighborhood = $request->get('neighborhood');
        if ($neighborhood) {
            $query->where('property.neighborhood', $neighborhood);
        }

        // Filter by price range
        $priceMin = $request->get('price_min');
        $priceMax = $request->get('price_max');
        if ($priceMin) {
            $priceField = in_array($type, ['rent']) ? 'mortgage' : 'price';
            $query->where($priceField, '>=', $priceMin);
        }
        if ($priceMax) {
            $priceField = in_array($type, ['rent']) ? 'mortgage' : 'price';
            $query->where($priceField, '<=', $priceMax);
        }

        // Filter by area range
        $areaMin = $request->get('area_min');
        $areaMax = $request->get('area_max');
        if ($areaMin) {
            $query->where('property.area', '>=', $areaMin);
        }
        if ($areaMax) {
            $query->where('property.area', '<=', $areaMax);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'ASC');
                break;
            case 'price_desc':
                $query->orderBy('price', 'DESC');
                break;
            case 'area_asc':
                $query->orderBy('property.area', 'ASC');
                break;
            case 'area_desc':
                $query->orderBy('property.area', 'DESC');
                break;
            case 'most_viewed':
                $query->orderBy('property.visit_count', 'DESC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);
        $cities = Cty::orderBy('order')->get();
        $locations = DB::table('neighborhoods')->where('showInMenu', true)->get();

        $favoriteIds = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        }

        // Build subcategories list for sidebar
        $subcategories = [];
        foreach ($categories as $cat) {
            $subcategories[$cat] = getCat($cat);
        }

        // AJAX response for filter/sort
        if ($request->ajax()) {
            $html = view('browse.partials.cards', compact('properties', 'categories'))->render();
            $pagination = view('browse.partials.pagination', compact('properties'))->render();
            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'total' => $properties->total(),
            ]);
        }

        return view('browse.index', compact(
            'properties', 'cities', 'locations', 'title', 'slug',
            'subcategories', 'categories', 'type', 'sort', 'favoriteIds'
        ));
    }
}
