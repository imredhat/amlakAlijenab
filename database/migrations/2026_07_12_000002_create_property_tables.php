<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ============================================================
        // PROPERTY (common fields used across ALL categories)
        // ============================================================
        Schema::dropIfExists('property');
        Schema::create('property', function (Blueprint $table) {
            $table->id();

            // Core
            $table->string('category', 50)->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            // User info (denormalized)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('tel', 20)->nullable();
            $table->string('company')->nullable();

            // Location
            $table->string('province', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('neighborhood', 100)->nullable();
            $table->string('address')->nullable();

            // Basic details
            $table->string('area', 20)->nullable();
            $table->string('property_type', 50)->nullable();
            $table->string('rooms', 10)->nullable();

            // Status & meta
            $table->string('status', 30)->nullable();
            $table->string('_status', 30)->nullable();
            $table->string('date_created', 50)->nullable();
            $table->string('date_updated', 50)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('visit_count')->default(0);
            $table->json('media')->nullable();
            $table->string('property_view', 50)->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        // ============================================================
        // PROPERTY_DETAILS (category-specific fields)
        // ============================================================
        Schema::dropIfExists('property_details');
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->unique();
            $table->foreign('property_id')->references('id')->on('property')->onDelete('cascade');

            // Pricing
            $table->string('price', 50)->nullable();
            $table->string('mortgage', 50)->nullable();
            $table->string('rent', 50)->nullable();
            $table->string('daily_rent', 50)->nullable();
            $table->string('regular_days', 50)->nullable();
            $table->string('weekend', 50)->nullable();
            $table->string('special_days', 50)->nullable();
            $table->string('extra_person_cost', 50)->nullable();

            // Building / Floor
            $table->string('floor', 10)->nullable();
            $table->string('unit_per_floor', 10)->nullable();
            $table->string('floors_count', 10)->nullable();
            $table->string('totalFloors', 10)->nullable();
            $table->string('floor_count', 10)->nullable();
            $table->string('build_year', 20)->nullable();
            $table->string('construction_year', 20)->nullable();
            $table->string('year_built', 20)->nullable();

            // Building type
            $table->string('building_type', 50)->nullable();
            $table->string('building_direction', 50)->nullable();
            $table->string('floor_type', 50)->nullable();
            $table->string('document_type', 50)->nullable();
            $table->string('document_status', 50)->nullable();
            $table->string('current_status', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->string('usage_type', 50)->nullable();

            // Amenities
            $table->string('parking', 20)->nullable();
            $table->string('storage', 20)->nullable();
            $table->string('elevator', 20)->nullable();
            $table->string('balcony', 20)->nullable();
            $table->string('rebuilt', 10)->nullable();
            $table->string('pool', 10)->nullable();
            $table->string('pool_type', 50)->nullable();
            $table->string('sauna', 10)->nullable();
            $table->string('jacuzzi', 10)->nullable();
            $table->string('furnished', 10)->nullable();
            $table->string('convertible', 10)->nullable();
            $table->string('cooling_system', 50)->nullable();
            $table->string('heating_system', 50)->nullable();
            $table->string('pets_allowed', 20)->nullable();
            $table->string('kitchen_type', 50)->nullable();
            $table->string('cabinet_material', 50)->nullable();
            $table->string('toilet', 10)->nullable();

            // Land specific
            $table->string('property_location', 50)->nullable();
            $table->string('building_permit', 100)->nullable();
            $table->string('has_old_building', 10)->nullable();
            $table->string('exchangeable', 10)->nullable();
            $table->json('utilities')->nullable();

            // Pre-sale fields
            $table->string('propertyCondition', 50)->nullable();
            $table->string('projectType', 50)->nullable();
            $table->string('roomCount', 10)->nullable();
            $table->string('participationPercent', 10)->nullable();
            $table->string('initialPayment', 10)->nullable();
            $table->string('deliveryPayment', 10)->nullable();
            $table->string('projectStatus', 50)->nullable();
            $table->string('deliveryYear', 10)->nullable();
            $table->string('deliveryMonth', 10)->nullable();
            $table->string('physicalProgress', 10)->nullable();
            $table->string('unitsPerFloor', 10)->nullable();
            $table->string('minUnitArea', 10)->nullable();
            $table->string('builderName')->nullable();
            $table->string('constructionPermit', 100)->nullable();
            $table->string('exchange', 10)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_details');
        Schema::dropIfExists('property');
    }
};
