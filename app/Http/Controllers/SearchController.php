<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cty;
use App\Models\User;
use App\Models\Favorite;

class SearchController extends Controller
{
    private function queryWithDetails()
    {
        $detailCols = 'property_details.property_id, property_details.capacity, property_details.standard_capacity, property_details.extra_capacity, property_details.rental_period, property_details.check_in_time, property_details.check_out_time, property_details.minimum_stay, property_details.price, property_details.mortgage, property_details.rent, property_details.daily_rent, property_details.regular_days, property_details.weekend, property_details.special_days, property_details.extra_person_cost, property_details.floor, property_details.unit_per_floor, property_details.floors_count, property_details.totalFloors, property_details.floor_count, property_details.build_year, property_details.construction_year, property_details.year_built, property_details.building_type, property_details.building_direction, property_details.floor_type, property_details.document_type, property_details.document_status, property_details.current_status, property_details.type as detail_type, property_details.usage_type, property_details.building_facade, property_details.parking, property_details.storage, property_details.elevator, property_details.balcony, property_details.rebuilt, property_details.has_loan, property_details.pool, property_details.pool_type, property_details.sauna, property_details.jacuzzi, property_details.furnished, property_details.convertible, property_details.cooling_system, property_details.heating_system, property_details.pets_allowed, property_details.kitchen_type, property_details.cabinet_material, property_details.toilet, property_details.property_location, property_details.building_permit, property_details.has_old_building, property_details.exchangeable, property_details.utilities, property_details.propertyCondition, property_details.projectType, property_details.roomCount, property_details.participationPercent, property_details.initialPayment, property_details.deliveryPayment, property_details.projectStatus, property_details.deliveryYear, property_details.deliveryMonth, property_details.physicalProgress, property_details.unitsPerFloor, property_details.minUnitArea, property_details.builderName, property_details.constructionPermit, property_details.exchange';

        return DB::table('property')
            ->leftJoin('property_details', 'property.id', '=', 'property_details.property_id')
            ->selectRaw('property.*, ' . $detailCols);
    }

    public function index(Request $request)
    {
        $query = $this->queryWithDetails();

        // Only active listings
        $query->whereNotIn('property.status', ['حذف شده', 'غیرفعال', 'منقضی']);
        $query->where('property._status', 'active');

        // ── Text search (title + address + description) ──
        $q = $request->get('q');
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('property.title', 'LIKE', '%' . $q . '%')
                    ->orWhere('property.address', 'LIKE', '%' . $q . '%')
                    ->orWhere('property.description', 'LIKE', '%' . $q . '%');
            });
        }

        // ── Category ──
        $category = $request->get('category');
        if ($category) {
            $query->where('property.category', $category);
        }

        // ── Location ──
        $city = $request->get('city');
        if ($city) {
            $query->where('property.city', $city);
        }

        $neighborhood = $request->get('neighborhood');
        if ($neighborhood) {
            $query->where('property.neighborhood', $neighborhood);
        }

        $province = $request->get('province');
        if ($province) {
            $query->where('property.province', $province);
        }

        // ── Price range ──
        $priceField = in_array($request->get('type'), ['rent', 'daily']) ? 'mortgage' : 'price';

        $priceMin = $request->get('price_min');
        if ($priceMin) {
            $query->where($priceField, '>=', preg_replace('/\D/', '', $priceMin));
        }

        $priceMax = $request->get('price_max');
        if ($priceMax) {
            $query->where($priceField, '<=', preg_replace('/\D/', '', $priceMax));
        }

        // ── Rent specific ──
        $rentMin = $request->get('rent_min');
        if ($rentMin) {
            $query->where('rent', '>=', preg_replace('/\D/', '', $rentMin));
        }

        $rentMax = $request->get('rent_max');
        if ($rentMax) {
            $query->where('rent', '<=', preg_replace('/\D/', '', $rentMax));
        }

        // ── Area ──
        $areaMin = $request->get('area_min');
        if ($areaMin) {
            $query->where('property.area', '>=', $areaMin);
        }

        $areaMax = $request->get('area_max');
        if ($areaMax) {
            $query->where('property.area', '<=', $areaMax);
        }

        // ── Rooms ──
        $rooms = $request->get('rooms');
        if ($rooms && $rooms !== '0') {
            $query->where('property.rooms', $rooms);
        }

        // ── Floor ──
        $floor = $request->get('floor');
        if ($floor !== null && $floor !== '' && $floor !== '0') {
            $query->where('property_details.floor', $floor);
        }

        // ── Build year ──
        $buildYearMin = $request->get('build_year_min');
        if ($buildYearMin) {
            $query->where('property_details.build_year', '>=', $buildYearMin);
        }

        $buildYearMax = $request->get('build_year_max');
        if ($buildYearMax) {
            $query->where('property_details.build_year', '<=', $buildYearMax);
        }

        // ── Property view ──
        $propertyView = $request->get('property_view');
        if ($propertyView) {
            $query->where('property.property_view', $propertyView);
        }

        // ── Amenities (boolean-like filters) ──
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
        if ($request->boolean('sauna')) {
            $query->where('property_details.sauna', 1);
        }
        if ($request->boolean('jacuzzi')) {
            $query->where('property_details.jacuzzi', 1);
        }
        if ($request->boolean('furnished')) {
            $query->where('property_details.furnished', 1);
        }
        if ($request->boolean('rebuilt')) {
            $query->where('property_details.rebuilt', 1);
        }

        // ── Building type ──
        $buildingType = $request->get('building_type');
        if ($buildingType) {
            $query->where('property_details.building_type', $buildingType);
        }

        // ── Building direction ──
        $buildingDirection = $request->get('building_direction');
        if ($buildingDirection) {
            $query->where('property_details.building_direction', $buildingDirection);
        }

        // ── Document type ──
        $documentType = $request->get('document_type');
        if ($documentType) {
            $query->where('property_details.document_type', $documentType);
        }

        // ── Cooling system ──
        $coolingSystem = $request->get('cooling_system');
        if ($coolingSystem) {
            $query->where('property_details.cooling_system', $coolingSystem);
        }

        // ── Heating system ──
        $heatingSystem = $request->get('heating_system');
        if ($heatingSystem) {
            $query->where('property_details.heating_system', $heatingSystem);
        }

        // ── Capacity (short-term rent) ──
        $capacityMin = $request->get('capacity_min');
        if ($capacityMin) {
            $query->where('property_details.standard_capacity', '>=', $capacityMin);
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
            case 'most_viewed':
                $query->orderBy('property.visit_count', 'DESC');
                break;
            default:
                $query->orderBy('property.id', 'DESC');
        }

        $properties = $query->paginate(12);
        $cities = Cty::orderBy('order')->get();

        // AJAX
        if ($request->ajax()) {
            $html = view('search.partials.cards', compact('properties'))->render();
            $pagination = view('search.partials.pagination', compact('properties'))->render();
            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'total' => $properties->total(),
            ]);
        }

        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        } else {
            $favoriteIds = [];
            $user = [];
        }

        return view('search.index', compact('properties', 'cities','user', 'favoriteIds'));
    }
}
