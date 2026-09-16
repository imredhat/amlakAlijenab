<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Cty;
use App\Models\Neighborhood;
use App\Services\Categories\CategoryFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hekmatinasser\Verta\Verta;


class AdminProperty extends Controller
{
    private function queryWithDetails()
    {
        $detailCols = 'property_details.property_id, property_details.capacity, property_details.standard_capacity, property_details.extra_capacity, property_details.rental_period, property_details.check_in_time, property_details.check_out_time, property_details.minimum_stay, property_details.price, property_details.mortgage, property_details.rent, property_details.daily_rent, property_details.regular_days, property_details.weekend, property_details.special_days, property_details.extra_person_cost, property_details.floor, property_details.unit_per_floor, property_details.floors_count, property_details.totalFloors, property_details.floor_count, property_details.build_year, property_details.construction_year, property_details.year_built, property_details.building_type, property_details.building_direction, property_details.floor_type, property_details.document_type, property_details.document_status, property_details.current_status, property_details.type as detail_type, property_details.usage_type, property_details.building_facade, property_details.parking, property_details.storage, property_details.elevator, property_details.balcony, property_details.rebuilt, property_details.has_loan, property_details.pool, property_details.pool_type, property_details.sauna, property_details.jacuzzi, property_details.furnished, property_details.convertible, property_details.cooling_system, property_details.heating_system, property_details.pets_allowed, property_details.kitchen_type, property_details.cabinet_material, property_details.toilet, property_details.property_location, property_details.building_permit, property_details.has_old_building, property_details.exchangeable, property_details.utilities, property_details.propertyCondition, property_details.projectType, property_details.roomCount, property_details.participationPercent, property_details.initialPayment, property_details.deliveryPayment, property_details.projectStatus, property_details.deliveryYear, property_details.deliveryMonth, property_details.physicalProgress, property_details.unitsPerFloor, property_details.minUnitArea, property_details.builderName, property_details.constructionPermit, property_details.exchange';

        return DB::table('property')
            ->leftJoin('property_details', 'property.id', '=', 'property_details.property_id')
            ->selectRaw('property.*, '.$detailCols);
    }

    public function pList(Request $request)
    {
        $data = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $q = $request->query('q');

        $query = $this->queryWithDetails();

        switch ($q) {
            case 'accepted':
                $query->where('status', 'تایید شده');
                $data['currentFilter'] = 'accepted';
                $data['filterTitle'] = 'آگهی‌های تایید شده';
                break;
            case 'notaccepted':
                $query->where('status', '!=', 'تایید شده')
                    ->where('status', '!=', 'رد شده');
                $data['currentFilter'] = 'notaccepted';
                $data['filterTitle'] = 'آگهی‌های در انتظار تایید';
                break;
            case 'expired':
                $query->where('status', 'رد شده');
                $data['currentFilter'] = 'expired';
                $data['filterTitle'] = 'آگهی‌های رد شده';
                break;
            default:
                $data['currentFilter'] = 'all';
                $data['filterTitle'] = 'همه آگهی‌ها';
                break;
        }

        $properties = $query->orderBy('property.id', 'DESC')->paginate(10);
        $properties->appends(['q' => $q]);

        if ($request->ajax()) {
            return view('admin.property._table', [
                'properties' => $properties,
                'currentFilter' => $data['currentFilter']
            ]);
        }

        return view('admin.property.list', [
            'admin'      => $data['admin'],
            'properties' => $properties,
            'currentFilter' => $data['currentFilter'],
            'filterTitle' => $data['filterTitle']
        ]);
    }

    public function pView($id)
    {
        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $data['property'] = $this->queryWithDetails()
            ->where('property.id', $id)->get();

        if ($data['property']->isEmpty()) {
            return redirect('/admin/property/list')->with('error', 'آگهی یافت نشد.');
        }

        $data['categoryHandler'] = CategoryFactory::create($data['property'][0]->category);

        return view('admin.property.view', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        if (! session()->has('admin_id')) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'لطفا وارد شوید'], 401);
            }
            return redirect('/admin/login');
        }

        $status = $request->input('status');

        if (! in_array($status, ['ثبت شده', 'تایید شده', 'رد شده'])) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'وضعیت نامعتبر است.'], 400);
            }
            return redirect()->back()->with('error', 'وضعیت نامعتبر است.');
        }

        $statusMap = [
            'ثبت شده' => 'added',
            'تایید شده' => 'active',
            'رد شده' => 'expired',
        ];

        DB::table('property')
            ->where('id', $id)
            ->update([
                'status'       => $status,
                '_status'      => $statusMap[$status] ?? $status,
                'date_updated' => now()->format('Y-m-d H:i:s'),
            ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'وضعیت با موفقیت به‌روزرسانی شد.']);
        }

        return redirect()->back()->with('success', 'وضعیت آگهی با موفقیت به‌روزرسانی شد.');
    }

    public function getStats()
    {
        if (! session()->has('admin_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $stats = [
            'all' => DB::table('property')->count(),
            'accepted' => DB::table('property')->where('status', 'تایید شده')->count(),
            'notaccepted' => DB::table('property')
                ->where('status', '!=', 'تایید شده')
                ->where('status', '!=', 'رد شده')
                ->count(),
            'expired' => DB::table('property')->where('status', 'رد شده')->count(),
        ];

        return response()->json($stats);
    }


    public function edit(Request $request, $id)
    {
     $data['locations'] = DB::table('neighborhoods')->where('showInMenu', true)->get();

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $property = $this->queryWithDetails()
            ->where('property.id', $id)->first();

        if (!$property) {
            return redirect()->back()->with('error', 'آگهی یافت نشد.');
        }

        $city = Cty::where('name', $property->city)->first();
        $data['neighborhoods'] = $city
            ? Neighborhood::where('city_id', $city->id)->orderBy('order', 'asc')->get()
            : collect([]);

        $data['selectedNeighborhoodName'] = $property->city;

        $isAdmin = session()->has('admin_id');

        if (!$isAdmin) {
            return redirect('/')->with('error', 'شما دسترسی به ویرایش این آگهی ندارید.');
        }

        $data['property'] = $property;
        $data['cities'] = DB::table('cties')->get();
        $data['property_id'] = $id;

        $categoryView = $this->getCategoryView($property->category);
        $data['categoryView'] = $categoryView;

        $data['mediaFiles'] = json_decode($property->media ?? '[]', true);

        return view('admin.property.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $property = DB::table('property')->where('id', $id)->first();

        if (!$property) {
            return redirect()->back()->with('error', 'آگهی یافت نشد.');
        }

        $isAdmin = session()->has('admin_id');

        if (!$isAdmin) {
            return redirect('/')->with('error', 'شما دسترسی به ویرایش این آگهی ندارید.');
        }

        $allData = [];
        foreach ($request->except(['_token', '_method', 'media', 'deleted_images']) as $key => $value) {
            if (is_array($value)) {
                $allData[$key] = json_encode($value);
            } else {
                $allData[$key] = is_string($value) ? trim($value) : $value;
            }
        }

        $priceKeys = [
            'mortgage', 'rent', 'price', 'daily_rent', 'regular_days',
            'weekend', 'special_days', 'extra_person_cost'
        ];

        foreach ($priceKeys as $priceKey) {
            if (isset($allData[$priceKey])) {
                $allData[$priceKey] = preg_replace('/\D+/', '', (string) $allData[$priceKey]);
            }
        }

        $allData['date_updated'] = (string) Verta::now();

        $deletedImages = $request->input('deleted_images', []);
        $existingMedia = json_decode($property->media ?? '[]', true);

        if (!empty($deletedImages)) {
            $uploadDir = public_path('upload/property/' . $id);
            foreach ($deletedImages as $deletedImage) {
                $imagePath = $uploadDir . '/' . $deletedImage;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $existingMedia = array_values(array_diff($existingMedia, [$deletedImage]));
            }
        }

        $newFiles = [];
        if ($request->hasFile('media')) {
            $uploadDir = public_path('upload/property/' . $id);
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            foreach ($request->file('media') as $index => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . $index . '.' . $extension;
                    $file->move($uploadDir, $filename);
                    $newFiles[] = $filename;
                }
            }
        }

        $allMedia = array_merge($existingMedia, $newFiles);
        $allData['media'] = json_encode($allMedia);

        // Split and update both tables
        [$propertyData, $detailsData] = $this->splitData($allData);

        DB::table('property')->where('id', $id)->update($propertyData);

        if (!empty($detailsData)) {
            $exists = DB::table('property_details')->where('property_id', $id)->exists();
            if ($exists) {
                DB::table('property_details')->where('property_id', $id)->update($detailsData);
            } else {
                $detailsData['property_id'] = $id;
                DB::table('property_details')->insert($detailsData);
            }
        }

        return redirect('/admin/property/list')->with('success', 'آگهی با موفقیت به‌روزرسانی شد.');
    }

    public function destroy($id)
    {
        $property = DB::table('property')->where('id', $id)->first();

        if (!$property) {
            return redirect()->back()->with('error', 'آگهی یافت نشد.');
        }

        DB::table('property')->where('id', $id)->update([
            'status' => 'حذف شده',
            '_status' => 'deleted',
        ]);

        $isAdmin = session()->has('admin_id');

        if ($isAdmin) {
            return redirect('/admin/property/list')->with('success', 'آگهی با موفقیت حذف شد.');
        }

        return redirect('/user/myADS')->with('success', 'آگهی با موفقیت حذف شد.');
    }

    private function getCategoryView($category)
    {
        $categoryMap = [
            'apartment-rent' => 'peroperty/edit/apartment-rent',
            'apartment-sale' => 'peroperty/edit/apartment-sale',
            'villa-sale' => 'peroperty/edit/villa-sale',
            'villa-short-rent' => 'peroperty/edit/villa-short-rent',
            'commercial-rent' => 'peroperty/edit/commercial-rent',
            'commercial-sale' => 'peroperty/edit/commercial-sale',
            'land' => 'peroperty/edit/land',
            'pre-sale' => 'peroperty/edit/pre-sale',
            'other' => 'peroperty/edit/other',
        ];

        return $categoryMap[$category] ?? 'peroperty/category/other';
    }


    public function toggleStatus($id)
    {
        $property = DB::table('property')->where('id', $id)->first();

        $updateData = [];

        if (in_array($property->status, ['حذف شده', 'منقضی'])) {
            $updateData['status'] = 'فعال';
            $updateData['expires_at'] = now()->addDays(30);
        } elseif ($property->status === 'فعال') {
            $updateData['status'] = 'غیرفعال';
        } else {
            $updateData['status'] = 'فعال';
            $updateData['expires_at'] = now()->addDays(30);
        }

        DB::table('property')->where('id', $id)->update($updateData);
        return response()->json(['success' => true]);
    }

    public function toggleFeature($id)
    {
        $property = DB::table('property')->where('id', $id)->first();
        $isFeatured = $property->is_featured ?? 0;
        DB::table('property')->where('id', $id)->update(['is_featured' => !$isFeatured]);
        return response()->json(['success' => true]);
    }

    private function splitData(array $allData): array
    {
        $detailFields = [
            'price', 'mortgage', 'rent', 'daily_rent', 'regular_days', 'weekend',
            'special_days', 'extra_person_cost', 'floor', 'unit_per_floor',
            'floors_count', 'totalFloors', 'floor_count', 'build_year',
            'construction_year', 'year_built', 'building_type', 'building_direction',
            'floor_type', 'document_type', 'document_status', 'current_status',
            'type', 'usage_type', 'building_facade', 'parking', 'storage', 'elevator', 'balcony',
            'rebuilt', 'has_loan', 'pool', 'pool_type', 'sauna', 'jacuzzi', 'furnished',
            'convertible', 'cooling_system', 'heating_system', 'pets_allowed',
            'kitchen_type', 'cabinet_material', 'toilet', 'property_location',
            'building_permit', 'has_old_building', 'exchangeable', 'utilities',
            'propertyCondition', 'projectType', 'roomCount', 'participationPercent',
            'initialPayment', 'deliveryPayment', 'projectStatus', 'deliveryYear',
            'deliveryMonth', 'physicalProgress', 'unitsPerFloor', 'minUnitArea',
            'builderName', 'constructionPermit', 'exchange',
            'capacity', 'standard_capacity', 'extra_capacity', 'rental_period',
            'check_in_time', 'check_out_time', 'minimum_stay',
        ];
        $propertyData = [];
        $detailsData = [];
        foreach ($allData as $key => $value) {
            if (in_array($key, $detailFields)) {
                $detailsData[$key] = $value;
            } else {
                $propertyData[$key] = $value;
            }
        }
        return [$propertyData, $detailsData];
    }
}
