<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class AgentController extends Controller
{
    /**
     * نمایش صفحه مشاور املاک + املاک او
     */
    public function show($phone, Request $request)
    {


        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
        }else{
            $user = [];
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

        $detailCols = 'property_details.property_id, property_details.capacity, property_details.standard_capacity, property_details.extra_capacity, property_details.rental_period, property_details.check_in_time, property_details.check_out_time, property_details.minimum_stay, property_details.price, property_details.mortgage, property_details.rent, property_details.daily_rent, property_details.regular_days, property_details.weekend, property_details.special_days, property_details.extra_person_cost, property_details.floor, property_details.unit_per_floor, property_details.floors_count, property_details.totalFloors, property_details.floor_count, property_details.build_year, property_details.construction_year, property_details.year_built, property_details.building_type, property_details.building_direction, property_details.floor_type, property_details.document_type, property_details.document_status, property_details.current_status, property_details.type as detail_type, property_details.usage_type, property_details.building_facade, property_details.parking, property_details.storage, property_details.elevator, property_details.balcony, property_details.rebuilt, property_details.has_loan, property_details.pool, property_details.pool_type, property_details.sauna, property_details.jacuzzi, property_details.furnished, property_details.convertible, property_details.cooling_system, property_details.heating_system, property_details.pets_allowed, property_details.kitchen_type, property_details.cabinet_material, property_details.toilet, property_details.property_location, property_details.building_permit, property_details.has_old_building, property_details.exchangeable, property_details.utilities, property_details.propertyCondition, property_details.projectType, property_details.roomCount, property_details.participationPercent, property_details.initialPayment, property_details.deliveryPayment, property_details.projectStatus, property_details.deliveryYear, property_details.deliveryMonth, property_details.physicalProgress, property_details.unitsPerFloor, property_details.minUnitArea, property_details.builderName, property_details.constructionPermit, property_details.exchange';

        $properties = DB::table('property')
            ->leftJoin('property_details', 'property.id', '=', 'property_details.property_id')
            ->selectRaw('property.*, '.$detailCols)
            ->where('property.user_id', $agent->id)
            ->whereNotIn('property.status', ['حذف شده', 'غیرفعال', 'منقضی'])
            ->where('property._status', 'active')
            ->orderBy($srt, $dir)
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
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $user = User::where('id', $id)->get();
        }else{
            $user = [];
        }

        $locations = DB::table('neighborhoods')->where('showInMenu', true)->get();
        $selectedLocation = request()->query('location');
        $selectedSort = request()->query('sort', 'newest');

        // Start with base query
        $agentsQuery = User::where('is_agent', true);

        // Apply location filter if selected
        if ($selectedLocation) {
            $agentsQuery->where('address', 'like', '%' . $selectedLocation . '%');
        }

        // Get total count before pagination
        $agentCount = $agentsQuery->count();

        // Apply sorting
        if ($selectedSort === 'name') {
            $agentsQuery->orderBy('name')->orderBy('lname');
        } else {
            $agentsQuery->orderBy('id', 'DESC');
        }

        // Paginate results
        $agents = $agentsQuery->paginate(12);

        return view('agents-list', compact('agents', 'agentCount', 'locations', 'selectedLocation', 'selectedSort','user'));
    }
}
