<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDetails extends Model
{
    public $timestamps = false;

    protected $table = 'property_details';

    protected $fillable = [
        'property_id',
        // Pricing
        'price', 'mortgage', 'rent', 'daily_rent',
        'regular_days', 'weekend', 'special_days', 'extra_person_cost',
        // Building / Floor
        'floor', 'unit_per_floor', 'floors_count', 'totalFloors', 'floor_count',
        'build_year', 'construction_year', 'year_built',
        // Building type
        'building_type', 'building_direction', 'floor_type',
        'document_type', 'document_status', 'current_status',
        'type', 'usage_type', 'building_facade',
        // Amenities
        'parking', 'storage', 'elevator', 'balcony', 'rebuilt', 'has_loan',
        'pool', 'pool_type', 'sauna', 'jacuzzi', 'furnished', 'convertible',
        'cooling_system', 'heating_system', 'pets_allowed',
        'kitchen_type', 'cabinet_material', 'toilet',
        // Villa short-rent
        'capacity', 'standard_capacity', 'extra_capacity', 'rental_period',
        'check_in_time', 'check_out_time', 'minimum_stay',
        // Land
        'property_location', 'building_permit', 'has_old_building',
        'exchangeable', 'utilities',
        // Pre-sale
        'propertyCondition', 'projectType', 'roomCount',
        'participationPercent', 'initialPayment', 'deliveryPayment',
        'projectStatus', 'deliveryYear', 'deliveryMonth',
        'physicalProgress', 'unitsPerFloor', 'minUnitArea',
        'builderName', 'constructionPermit', 'exchange',
    ];

    protected $casts = [
        'utilities' => 'array',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
