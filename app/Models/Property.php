<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;


class Property extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'property';
    public $timestamps = false;
    

    protected $fillable = [
        'category',
        'title',
        'description',
        'area',
        'price',
        'type',
        'date_created',
        'date_updated',
        'visit_count'
    ];



        public function getFirstImageAttribute()
    {
        $media = json_decode($this->media);
        
        // بررسی وجود تصویر
        if (!empty($media) && isset($media[0]) && !empty($media[0])) {
            $imagePath = public_path('/upload/property/' . $this->id . '/' . $media[0]);
            if (file_exists($imagePath)) {
                return '/upload/property/' . $this->id . '/' . $media[0];
            }
        }
        
        // تصویر پیش‌فرض
        return '/assets/images/no-image.jpg';
    }
    
    // Accessor برای تمام تصاویر
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
        
        // اگر هیچ تصویری نبود، تصویر پیش‌فرض را برگردان
        if (empty($images)) {
            $images[] = '/assets/images/no-image.jpg';
        }
        
        return $images;
    }


}
