<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $timestamps = false;
    protected $table = 'property';

    // Common fields only
    protected $fillable = [
        'user_id', 'category', 'title', 'description',
        'name', 'last_name', 'email', 'tel', 'company',
        'province', 'city', 'neighborhood', 'address',
        'area', 'land_area', 'building_area', 'property_type', 'rooms',
        'status', '_status', 'date_created', 'date_updated',
        'is_featured', 'visit_count', 'media', 'property_view',
        'expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasOne(PropertyDetails::class);
    }

    /**
     * Get a property with all details merged (simulates old single-table behavior)
     */
    public static function withDetails($query)
    {
        return $query->leftJoin('property_details', 'property.id', '=', 'property_details.property_id')
            ->selectRaw('property.*, property_details.*');
    }

    public function getFirstImageAttribute()
    {
        $media = json_decode($this->media);

        if (!empty($media) && isset($media[0]) && !empty($media[0])) {
            $imagePath = public_path('/upload/property/' . $this->id . '/' . $media[0]);
            if (file_exists($imagePath)) {
                return '/upload/property/' . $this->id . '/' . $media[0];
            }
        }

        return '/assets/images/no-image.jpg';
    }

    public function getImagesAttribute()
    {
        $media = json_decode($this->media);
        $images = [];

        if (!empty($media) && is_array($media)) {
            foreach ($media as $image) {
                $imagePath = public_path('/upload/property/' . $this->id . '/' . $image);
                if (file_exists($imagePath)) {
                    $images[] = '/upload/property/' . $this->id . '/' . $image;
                }
            }
        }

        if (empty($images)) {
            $images[] = '/assets/images/no-image.jpg';
        }

        return $images;
    }
}
