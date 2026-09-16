<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyDetails;
use App\Models\Cty;
use App\Models\Neighborhood;

use Hekmatinasser\Verta\Verta;
use App\Models\Favorite;


class PropertyController extends Controller
{
    // Fields that go to property_details table
    private $detailFields = [
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

    private function splitData(array $allData): array
    {
        $propertyData = [];
        $detailsData = [];
        foreach ($allData as $key => $value) {
            if (in_array($key, $this->detailFields)) {
                $detailsData[$key] = $value;
            } else {
                $propertyData[$key] = $value;
            }
        }
        return [$propertyData, $detailsData];
    }

    /**
     * Get property with all details merged (read query)
     */
    private function queryWithDetails($table = 'property')
    {
        $query = DB::table($table)->select($table.'.*');

        if (! Schema::hasTable('property_details')) {
            return $query;
        }

        $detailColumns = Schema::getColumnListing('property_details');
        $selectColumns = [$table.'.*'];

        foreach ($this->detailFields as $column) {
            if (in_array($column, $detailColumns, true)) {
                $alias = $column === 'type' ? 'detail_type' : $column;
                $selectColumns[] = 'property_details.'.$column.' as '.$alias;
            }
        }

        return $query
            ->leftJoin('property_details', $table.'.id', '=', 'property_details.property_id')
            ->select($selectColumns);
    }

    public function show(Request $request)
    {
        $data = $this->initialize($request);
        $data['cities'] = DB::table('cties')->get();

        return view('/peroperty/add', $data);
    }


    public function category(Request $request)
    {
        $category = $request->segment(3);
        $cat = 'peroperty/category/' . $category;

        return view($cat);
    }

    public function savetoDB(Request $request)
    {
        $allData = [];
        foreach ($request->except(['_token', 'media']) as $key => $value) {
            $allData[$key] = is_string($value) ? trim($value) : $value;
        }

        $priceKeys = [
            'mortgage', 'rent', 'price', 'daily_rent', 'regular_days',
            'weekend', 'special_days', 'extra_person_cost',
        ];

        foreach ($priceKeys as $priceKey) {
            if (isset($allData[$priceKey])) {
                $allData[$priceKey] = preg_replace('/\D+/', '', (string) $allData[$priceKey]);
            }
        }

        foreach ($allData as $key => $value) {
            if (is_array($value)) {
                $allData[$key] = json_encode(array_values($value), JSON_UNESCAPED_UNICODE);
            }
        }

        $id = $request->session()->get('user_id');
        $allData['status'] = 'فعال';
        $allData['_status'] = 'active';
        $allData['date_created'] = (string) Verta::now();
        $allData['date_updated'] = (string) Verta::now();
        $allData['user_id'] = $id;

        [$propertyData, $detailsData] = $this->splitData($allData);

        $propertyColumns = array_flip(Schema::getColumnListing('property'));
        if (isset($propertyColumns['expires_at'])) {
            $propertyData['expires_at'] = now()->addDays(30);
        }

        // Older installations kept category fields in the property table.
        foreach ($detailsData as $key => $value) {
            if (isset($propertyColumns[$key])) {
                $propertyData[$key] = $value;
            }
        }

        $propertyData = array_intersect_key($propertyData, $propertyColumns);
        $hasDetailsTable = Schema::hasTable('property_details');
        $detailsColumns = $hasDetailsTable
            ? array_flip(Schema::getColumnListing('property_details'))
            : [];
        $detailsData = array_intersect_key($detailsData, $detailsColumns);

        try {
            $propertyId = DB::transaction(function () use ($propertyData, $detailsData, $hasDetailsTable) {
                $propertyId = DB::table('property')->insertGetId($propertyData);

                if ($hasDetailsTable && ! empty($detailsData)) {
                    DB::table('property_details')->insert($detailsData + [
                        'property_id' => $propertyId,
                    ]);
                }

                return $propertyId;
            });
        } catch (\Throwable $exception) {
            Log::error('Property creation failed', [
                'user_id' => $id,
                'category' => $request->input('category'),
                'error' => $exception->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'property' => 'ذخیره آگهی انجام نشد. لطفاً دوباره تلاش کنید.',
            ]);
        }

        try {
            $mediaFiles = $request->file('media', []);
            $savedFiles = [];

            $uploadDir = public_path('upload/property/' . $propertyId);
            if (! is_dir($uploadDir) && ! mkdir($uploadDir, 0755, true) && ! is_dir($uploadDir)) {
                throw new \RuntimeException('Unable to create property upload directory.');
            }

            foreach ($mediaFiles as $index => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . $index . '.' . $extension;
                    $file->move($uploadDir, $filename);
                    $savedFiles[] = $filename;
                }
            }

            DB::table('property')
                ->where('id', $propertyId)
                ->update(['media' => json_encode($savedFiles)]);
        } catch (\Throwable $exception) {
            Log::error('Property media upload failed', [
                'property_id' => $propertyId,
                'error' => $exception->getMessage(),
            ]);
        }

        return redirect('/user/myADS');
    }

    public function viewProperty(Request $request)
    {
        $data = $this->initialize($request);

        $PID = $request->segment(2);

        // Update visit count on property table
        DB::table('property')->where('id', $PID)->increment('visit_count');

        // Get property with details
        $propertyResult = $this->queryWithDetails()
            ->where('property.id', $PID)
            ->whereNotIn('property.status', ['حذف شده', 'غیرفعال', 'منقضی'])
            ->where('property._status', 'active')
            ->get();

        if ($propertyResult->isEmpty()) {
            echo "<script>alert('آگهی مورد نظر یافت نشد / پاک شده است')</script>";
            return redirect("/");
        }

        $property = $propertyResult;
        $data['property'] = $property;
        $data['similar'] = [];
        $data['id'] = $PID;
        $existingIds = [];

        // Get the first property from the collection
        $propertyItem = $property->first();
        $categoryName = $propertyItem->category;
        $data['agent'] = DB::table('users')->where('id', $propertyItem->user_id)->get();

        $title = explode(' ', $propertyItem->title);
        foreach ($title as $t) {
            $get = $this->queryWithDetails()
                ->where('property.title', 'like', '%' . $t . '%')
                ->whereNotIn('property.id', [$PID])
                ->get();

            foreach ($get as $item) {
                $id = $item->id;
                if (!in_array($id, $existingIds)) {
                    // Get the full property record to ensure media field is available
                    $fullProperty = DB::table('property')->where('id', $id)->first();
                    if ($fullProperty) {
                        $item->media = $fullProperty->media;
                    }
                    array_push($data['similar'], $item);
                    array_push($existingIds, $id);
                }
            }
        }

        return view('/peroperty/items/' . $categoryName, $data);
    }


    public function catalog(Request $request)
    {
        $locations = DB::table('neighborhoods')->where('showInMenu', true)->get();

        $type = $request->get('type', 'sale');
        $query = $this->queryWithDetails();

        if (!empty($type) && $type === 'rent') {
            $query->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->where('property_details.mortgage', '>', 0)
                        ->orWhere('property_details.mortgage', '!=', null);
                })->orWhere(function ($sub) {
                    $sub->where('property_details.rent', '>', 0)
                        ->orWhere('property_details.rent', '!=', null);
                })->orWhere(function ($sub) {
                    $sub->where('property_details.daily_rent', '>', 0)
                        ->orWhere('property_details.daily_rent', '!=', null);
                });
            });
        } else {
            $query->where(function ($q) {
                $q->where('property_details.price', '>', 0)
                    ->orWhere('property_details.price', '!=', null);
            });
        }

        $properties = $query->paginate(12);

        if ($request->ajax()) {
            $html = view('partials.properties.catalog-list', compact('properties'))->render();
            return response()->json([
                'html' => $html,
                'total' => $properties->total()
            ]);
        }

        $cities = Cty::orderBy('order')->get();

        $favoriteIds = [];
        if (session()->has('user_id')) {
            $id       = session('user_id');
            $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        }

        return view('real-estate.catalog', compact('properties', 'cities', 'type', 'locations', 'favoriteIds'));
    }


    public function initialize(Request $request)
    {
        $data = [];
        if (session()->has('user_id')) {
            $id = session('user_id');
            $data['user'] = User::where('id', $id)->get();
            $data['favoriteIds'] = Schema::hasTable('favorites')
                ? Favorite::where('user_id', $id)->pluck('property_id')->toArray()
                : [];
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


    public function edit(Request $request, $id)
    {
        $data = $this->initialize($request);

        $property = $this->queryWithDetails()
            ->where('property.id', $id)->first();

        if (!$property) {
            return redirect()->back()->with('error', 'آگهی یافت نشد.');
        }

        foreach ($this->detailFields as $detailField) {
            if (! property_exists($property, $detailField)) {
                $property->{$detailField} = null;
            }
        }

        $city = Cty::where('name', $property->city)->first();
        $data['neighborhoods'] = $city
            ? Neighborhood::where('city_id', $city->id)->orderBy('order', 'asc')->get()
            : collect([]);

        $data['selectedNeighborhoodName'] = $property->city;

        $isAdmin = session()->has('admin_id');
        $isOwner = session()->has('user_id')&& session('user_id') == $property->user_id;

        

        if (!$isAdmin && !$isOwner) {
            return redirect('/')->with('error', 'شما دسترسی به ویرایش این آگهی ندارید.');
        }

        $data['property'] = $property;
        $data['cities'] = DB::table('cties')->get();
        $data['property_id'] = $id;

        $categoryView = $this->getCategoryView($property->category);
        $data['categoryView'] = $categoryView;

        $data['mediaFiles'] = json_decode($property->media ?? '[]', true);

        return view('peroperty.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $property = DB::table('property')->where('id', $id)->first();

        if (!$property) {
            return redirect()->back()->with('error', 'آگهی یافت نشد.');
        }

        $isAdmin = session()->has('admin_id');
        $isOwner = session()->has('user_id')&& session('user_id') == $property->user_id;

        if (!$isAdmin && !$isOwner) {
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

        // Handle media
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

        return redirect('/user/myADS')->with('success', 'آگهی با موفقیت به‌روزرسانی شد.');
    }

    public function destroy($id)
    {
        try {
            $property = DB::table('property')->where('id', $id)->first();

            if (!$property) {
                return $this->navigationResponse('/user/myADS', 'error', 'آگهی یافت نشد.');
            }

            $isAdmin = session()->has('admin_id');
            $isOwner = session()->has('user_id') && (string) session('user_id') === (string) $property->user_id;

            if (! $isAdmin && ! $isOwner) {
                return $this->navigationResponse('/', 'error', 'شما اجازه حذف این آگهی را ندارید.');
            }

            DB::table('property')->where('id', $id)->update([
                'status' => 'حذف شده',
                '_status' => 'deleted',
            ]);

            $redirectPath = $isAdmin ? '/admin/property/list' : '/user/myADS';

            return $this->navigationResponse($redirectPath, 'success', 'آگهی با موفقیت حذف شد.');
        } catch (\Throwable $exception) {
            Log::error('Property deletion failed', [
                'property_id' => $id,
                'user_id' => session('user_id'),
                'admin_id' => session('admin_id'),
                'error' => $exception->getMessage(),
            ]);

            return $this->navigationResponse('/user/myADS', 'error', 'حذف آگهی انجام نشد.');
        }
    }

    public function destroyGet($id)
    {
        return $this->destroy($id);
    }

    private function navigationResponse(string $path, string $flashKey, string $message)
    {
        session()->flash($flashKey, $message);

        $safePath = str_starts_with($path, '/') ? $path : '/';
        $escapedPath = htmlspecialchars($safePath, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $javascriptPath = json_encode(
            $safePath,
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
        );

        return response(
            '<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8">'
            .'<meta http-equiv="refresh" content="0;url='.$escapedPath.'">'
            .'<title>در حال انتقال...</title></head><body>'
            .'<script>window.location.replace('.$javascriptPath.');</script>'
            .'<a href="'.$escapedPath.'">ادامه</a></body></html>',
            200,
            ['Content-Type' => 'text/html; charset=UTF-8']
        );
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
            $updateData['_status'] = 'active';
            $updateData['expires_at'] = now()->addDays(30);
        } elseif ($property->status === 'فعال') {
            $updateData['status'] = 'غیرفعال';
        } else {
            $updateData['status'] = 'فعال';
            $updateData['_status'] = 'active';
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
}
