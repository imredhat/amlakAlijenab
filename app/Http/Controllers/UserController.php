<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\UpgradePackage;
use App\Models\PropertyBoost;
use App\Models\PropertyDetails;
use App\Models\Favorite;

class UserController extends Controller
{
    public function toggleFavorite(Request $request)
    {

        $id = session('user_id');

        if (!$id) {
            return response()->json(['success' => false, 'message' => 'لطفا ابتدا وارد شوید.'], 401);
        }

        $propertyId = $request->property_id;
        $userId = $id;

        $existing = Favorite::where('user_id', $userId)->where('property_id', $propertyId)->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['success' => true, 'status' => 'removed']);
        }

        Favorite::create([
            'user_id' => $userId,
            'property_id' => $propertyId,
            'created_at' => now(),
        ]);

        return response()->json(['success' => true, 'status' => 'added']);
    }

    public function favorite(Request $request)
    {
        $data = $this->initialize($request);

        $id       = session('user_id');

        $favoriteIds = Favorite::where('user_id', $id)->pluck('property_id')->toArray();
        $data['favoriteIds'] = $favoriteIds;

        if (!empty($favoriteIds)) {
            $data['properties'] = $this->propertyListingQuery()
                ->whereIn('property.id', $favoriteIds)
                ->orderBy('property.id', 'DESC')
                ->paginate(12);
        } else {
            $data['properties'] = collect();
        }

        return view('/user/favorite', $data);
    }
    public function myADS(Request $request)
    {
        $data = $this->initialize($request);
        $id       = session('user_id');

        $data['properties'] = $this->propertyListingQuery()
            ->where('property.user_id', $id)
            ->where(function ($query): void {
                $query->whereNull('property._status')
                    ->orWhere('property._status', '!=', 'deleted');
            })
            ->where(function ($query): void {
                $query->whereNull('property.status')
                    ->orWhere('property.status', '!=', 'حذف شده');
            })
            ->orderBy('property.id', 'DESC')
            ->paginate(12);
        return view('/user/properties', $data);
    }


    public function Profile(Request $request)
    {
        $data = $this->initialize($request);
        return view('/user/profile', $data);
    }

    public function updateProfile(Request $request)
    {

        $id       = session('user_id');
        $request->validate([
            'name' => 'sometimes|nullable|string|max:255',
            'email' => 'sometimes|nullable|email|unique:users,email,' . $id,
            'tel' => 'sometimes|nullable|string|max:20',
            'bio' => 'sometimes|nullable|string',
            'company' => 'sometimes|nullable|string|max:255',
            'address' => 'sometimes|nullable|string|max:255',
            'instagram' => 'sometimes|nullable|string|max:255',
            'whatsapp' => 'sometimes|nullable|string|max:255',
            'telegram' => 'sometimes|nullable|string|max:255',
            'media.*' => 'sometimes|file|mimes:jpg,jpeg,png,gif|max:2048',
            'avatar' => 'sometimes|file|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $id       = session('user_id');

        $user = User::find($id);
        if (!$user) {
            return redirect('user/profile')->with('error', 'کاربر یافت نشد.');
        }

        $allowed = $request->only([
            'name',
            'email',
            'tel',
            'bio',
            'company',
            'address',
            'instagram',
            'whatsapp',
            'telegram',
        ]);

        $cleaned = [];
        foreach ($allowed as $key => $value) {
            $cleaned[$key] = is_string($value) ? trim($value) : $value;
        }

        $user->update($cleaned);

        // Upload avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            if ($file && $file->isValid()) {
                try {
                    $uploadDir = public_path('upload/user/' . $id);
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move($uploadDir, $filename);
                    $user->avatar = $filename;
                    $user->save();
                } catch (\Exception $e) {
                    \Log::error('Upload error: ' . $e->getMessage());
                }
            }
        }

        return redirect('user/profile')->with('success', 'پروفایل با موفقیت به‌روزرسانی شد!');
    }




    public function savetoDB(Request $request)
    {
        $allData = [];
        foreach ($request->except(['_token', 'media']) as $key => $value) {
            $allData[$key] = is_string($value) ? trim($value) : $value;
        }

        $priceKeys = [
            'mortgage',
            'rent',
            'price',
            'daily_rent',
            'regular_days',
            'weekend',
            'special_days',
            'extra_person_cost',
        ];

        foreach ($priceKeys as $priceKey) {
            if (isset($allData[$priceKey])) {
                $allData[$priceKey] = preg_replace('/\D+/', '', (string) $allData[$priceKey]);
            }
        }


        $allData['user_id'] = session('user_id');

        // Split data between property and property_details
        $detailFields = [
            'price',
            'mortgage',
            'rent',
            'daily_rent',
            'regular_days',
            'weekend',
            'special_days',
            'extra_person_cost',
            'floor',
            'unit_per_floor',
            'floors_count',
            'totalFloors',
            'floor_count',
            'build_year',
            'construction_year',
            'year_built',
            'building_type',
            'building_direction',
            'floor_type',
            'document_type',
            'document_status',
            'current_status',
            'type',
            'usage_type',
            'building_facade',
            'parking',
            'storage',
            'elevator',
            'balcony',
            'rebuilt',
            'has_loan',
            'pool',
            'pool_type',
            'sauna',
            'jacuzzi',
            'furnished',
            'convertible',
            'cooling_system',
            'heating_system',
            'pets_allowed',
            'kitchen_type',
            'cabinet_material',
            'toilet',
            'property_location',
            'building_permit',
            'has_old_building',
            'exchangeable',
            'utilities',
            'propertyCondition',
            'projectType',
            'roomCount',
            'participationPercent',
            'initialPayment',
            'deliveryPayment',
            'projectStatus',
            'deliveryYear',
            'deliveryMonth',
            'physicalProgress',
            'unitsPerFloor',
            'minUnitArea',
            'builderName',
            'constructionPermit',
            'exchange',
            'capacity',
            'standard_capacity',
            'extra_capacity',
            'rental_period',
            'check_in_time',
            'check_out_time',
            'minimum_stay',
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

        $propertyId = DB::table('property')->insertGetId($propertyData);

        if (!empty($detailsData)) {
            $detailsData['property_id'] = $propertyId;
            DB::table('property_details')->insert($detailsData);
        }

        $mediaFiles = $request->file('media', []);
        $savedFiles = [];

        $uploadDir = public_path('upload/property/' . $propertyId);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        foreach ($mediaFiles as $index => $file) {
            if ($file && $file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . $index . '.' . $extension;
                $file->move($uploadDir, $filename);
                $savedFiles[] = $filename;
            }
        }

        if (!empty($savedFiles)) {
            DB::table('property')
                ->where('id', $propertyId)
                ->update(['media' => json_encode($savedFiles)]);
        }

        return response()->json([
            'id'    => $propertyId,
            'files' => $savedFiles,
        ]);
    }


    public function nardban(Request $request, $property_id = null)
    {
        $data = $this->initialize($request);

        $data['packages'] = Schema::hasTable('upgrade_packages')
            ? UpgradePackage::where('is_active', true)->orderBy('order')->get()
            : collect();

        if ($property_id) {
            // Show packages for a specific property
            $data['mode'] = 'select_package';
            $data['property'] = $this->boostPropertyQuery()
                ->where('property.id', $property_id)
                ->where('property.user_id', session('user_id'))
                ->first();
        } else {
            // Show list of user's boosted properties
            $data['mode'] = 'list';

            $boostedPropertyIds = PropertyBoost::where('user_id', session('user_id'))
                ->pluck('property_id')
                ->unique()
                ->toArray();

            if (!empty($boostedPropertyIds)) {
                $data['boostedProperties'] = $this->boostPropertyQuery()
                    ->whereIn('property.id', $boostedPropertyIds)
                    ->where('property.user_id', session('user_id'))
                    ->orderByDesc('property.id')
                    ->get();

                $data['activeBoost'] = PropertyBoost::where('user_id', session('user_id'))
                    ->with(['property', 'package'])
                    ->orderByDesc('created_at')
                    ->get();
            } else {
                $data['boostedProperties'] = collect();
                $data['activeBoost'] = collect();
            }
        }

        return view('/user/nardban', $data);
    }

    public function nardbanActivate(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:upgrade_packages,id',
            'property_id' => 'required|exists:property,id',
        ]);

        $package = UpgradePackage::find($request->package_id);
        $property = DB::table('property')->where('id', $request->property_id)->where('user_id', session('user_id'))->first();

        if (!$property) {
            return redirect()->back()->with('error', 'ملک مورد نظر یافت نشد.');
        }

        $now = now();
        $expiresAt = $now->copy()->addDays($package->duration_days);

        $this->ensurePropertyBoostsTable();

        try {
            DB::transaction(function () use ($request, $now, $expiresAt): void {
                PropertyBoost::create([
                    'property_id' => $request->property_id,
                    'package_id' => $request->package_id,
                    'user_id' => session('user_id'),
                    'starts_at' => $now,
                    'expires_at' => $expiresAt,
                    'status' => 'active',
                ]);

                $propertyUpdate = ['is_featured' => 1];
                if (Schema::hasColumn('property', 'expires_at')) {
                    $propertyUpdate['expires_at'] = now()->addDays(30);
                }

                DB::table('property')->where('id', $request->property_id)->update($propertyUpdate);
            });
        } catch (\Throwable $exception) {
            Log::error('Property boost activation failed', [
                'property_id' => $request->property_id,
                'user_id' => session('user_id'),
                'error' => $exception->getMessage(),
            ]);

            return back()->withInput()->with('error', 'فعال‌سازی نردبان انجام نشد. لطفاً دوباره تلاش کنید.');
        }

        return redirect('/user/nardban/' . $request->property_id)->with('success', 'آگهی شما با موفقیت ارتقا یافت!');
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

        $data['locations'] = DB::table('neighborhoods')->get();

        return $data;
    }

    private function ensurePropertyBoostsTable(): void
    {
        if (Schema::hasTable('property_boosts')) {
            return;
        }

        Schema::create('property_boosts', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('property_id')->index();
            $table->unsignedBigInteger('package_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    private function boostPropertyQuery()
    {
        $query = DB::table('property')->select('property.*');

        if (! Schema::hasTable('property_details')) {
            return $query;
        }

        $availableColumns = Schema::getColumnListing('property_details');
        $selectColumns = ['property.*'];

        foreach (['price', 'mortgage', 'rent'] as $column) {
            if (in_array($column, $availableColumns, true)) {
                $selectColumns[] = 'property_details.'.$column;
            }
        }

        return $query
            ->leftJoin('property_details', 'property.id', '=', 'property_details.property_id')
            ->select($selectColumns);
    }

    private function propertyListingQuery()
    {
        $query = DB::table('property');
        $selectColumns = ['property.*'];
        $expectedColumns = array_values(array_diff(
            (new PropertyDetails())->getFillable(),
            ['property_id']
        ));

        if (! Schema::hasTable('property_details')) {
            foreach ($expectedColumns as $column) {
                $alias = $column === 'type' ? 'detail_type' : $column;
                $selectColumns[] = DB::raw('NULL as `'.$alias.'`');
            }

            return $query->select($selectColumns);
        }

        $availableColumns = Schema::getColumnListing('property_details');
        foreach ($expectedColumns as $column) {
            $alias = $column === 'type' ? 'detail_type' : $column;
            $selectColumns[] = in_array($column, $availableColumns, true)
                ? 'property_details.'.$column.' as '.$alias
                : DB::raw('NULL as `'.$alias.'`');
        }

        return $query
            ->leftJoin('property_details', 'property.id', '=', 'property_details.property_id')
            ->select($selectColumns);
    }
}
