<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property', function (Blueprint $table) {
            $table->string('land_area', 20)->nullable()->after('area');
            $table->string('building_area', 20)->nullable()->after('land_area');
        });

        Schema::table('property_details', function (Blueprint $table) {
            // apartment-sale
            $table->string('building_facade', 50)->nullable()->after('kitchen_type');
            $table->string('has_loan', 10)->nullable()->after('rebuilt');

            // villa-short-rent
            $table->string('capacity', 10)->nullable()->after('property_id');
            $table->string('standard_capacity', 10)->nullable()->after('capacity');
            $table->string('extra_capacity', 10)->nullable()->after('standard_capacity');
            $table->string('rental_period', 20)->nullable()->after('extra_capacity');
            $table->string('check_in_time', 10)->nullable()->after('rental_period');
            $table->string('check_out_time', 10)->nullable()->after('check_in_time');
            $table->string('minimum_stay', 10)->nullable()->after('check_out_time');
        });
    }

    public function down(): void
    {
        Schema::table('property', function (Blueprint $table) {
            $table->dropColumn(['land_area', 'building_area']);
        });

        Schema::table('property_details', function (Blueprint $table) {
            $table->dropColumn([
                'building_facade', 'has_loan', 'capacity',
                'standard_capacity', 'extra_capacity', 'rental_period',
                'check_in_time', 'check_out_time', 'minimum_stay',
            ]);
        });
    }
};
