<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use App\Models\Favorite;
use App\Models\PropertyBoost;

class IndexController extends Controller
{
    private function queryWithDetails()
    {
        $detailCols = 'property_details.property_id, property_details.capacity, property_details.standard_capacity, property_details.extra_capacity, property_details.rental_period, property_details.check_in_time, property_details.check_out_time, property_details.minimum_stay, property_details.price, property_details.mortgage, property_details.rent, property_details.daily_rent, property_details.regular_days, property_details.weekend, property_details.special_days, property_details.extra_person_cost, property_details.floor, property_details.unit_per_floor, property_details.floors_count, property_details.totalFloors, property_details.floor_count, property_details.build_year, property_details.construction_year, property_details.year_built, property_details.building_type, property_details.building_direction, property_details.floor_type, property_details.document_type, property_details.document_status, property_details.current_status, property_details.type as detail_type, property_details.usage_type, property_details.building_facade, property_details.parking, property_details.storage, property_details.elevator, property_details.balcony, property_details.rebuilt, property_details.has_loan, property_details.pool, property_details.pool_type, property_details.sauna, property_details.jacuzzi, property_details.furnished, property_details.convertible, property_details.cooling_system, property_details.heating_system, property_details.pets_allowed, property_details.kitchen_type, property_details.cabinet_material, property_details.toilet, property_details.property_location, property_details.building_permit, property_details.has_old_building, property_details.exchangeable, property_details.utilities, property_details.propertyCondition, property_details.projectType, property_details.roomCount, property_details.participationPercent, property_details.initialPayment, property_details.deliveryPayment, property_details.projectStatus, property_details.deliveryYear, property_details.deliveryMonth, property_details.physicalProgress, property_details.unitsPerFloor, property_details.minUnitArea, property_details.builderName, property_details.constructionPermit, property_details.exchange';

        return DB::table('property')
            ->leftJoin('property_details', 'property.id', '=', 'property_details.property_id')
            ->selectRaw('property.*, '.$detailCols)
            ->whereNotIn('property.status', ['حذف شده', 'غیرفعال', 'منقضی'])
            ->where('property._status', 'active');
    }

    public function index()
    {
        $data = [];


        $id = session('user_id');

        if ($id) {
            $data['user'] = User::where('id', $id)->get();
            $data['favoriteIds'] = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        } else {
            $data['favoriteIds'] = [];
        }

        $data['header'] = Section::where('position', 'header')->get();
        $data['catalog'] = Section::where('position', 'catalog')->get();
        $data['banner'] = Section::where('position', 'banner')->get();
        $data['recent'] = $this->queryWithDetails()->orderBy('property.visit_count', 'DESC')->paginate(10);

        // Get properties with active nardban (upgrade plan)
        $boostedPropertyIds = PropertyBoost::active()->pluck('property_id')->unique()->toArray();
        if (!empty($boostedPropertyIds)) {
            $data['special'] = $this->queryWithDetails()
                ->whereIn('property.id', $boostedPropertyIds)
                ->orderByDesc('property.id')
                ->limit(3)
                ->get();
        } else {
            $data['special'] = collect();
        }

        $data['city'] = DB::table('cties')->get();
        $data['locations'] = DB::table('neighborhoods')->get();

        return view('index', $data);
    }

    public function special()
    {
        $data = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $data['user'] = User::where('id', $id)->get();
            $data['favoriteIds'] = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        } else {
            $data['favoriteIds'] = [];
        }

        $boostedPropertyIds = PropertyBoost::active()->pluck('property_id')->unique()->toArray();

        if (!empty($boostedPropertyIds)) {
            $data['properties'] = $this->queryWithDetails()
                ->whereIn('property.id', $boostedPropertyIds)
                ->orderByDesc('property.id')
                ->paginate(12);
        } else {
            $data['properties'] = collect();
        }

        $data['locations'] = DB::table('neighborhoods')->get();

        return view('real-estate.special', $data);
    }
}
