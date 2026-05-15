<?php

if (!function_exists('getPropertyImage')) {
    function getPropertyImage($property, $defaultImage = '/img/blank.png')
    {
        // اگر مدیا وجود ندارد
        if (!isset($property->media) || empty($property->media)) {
            return url($defaultImage);
        }
        
        $media = json_decode($property->media);
        
        // اگر مدیا آرایه نیست یا خالی است
        if (!is_array($media) || empty($media)) {
            return url($defaultImage);
        }
        
        // بررسی تصاویر
        foreach ($media as $mediaFile) {
            if (!empty($mediaFile)) {
                $imagePath = public_path("/upload/property/" . $property->id . "/" . $mediaFile);
                if (file_exists($imagePath)) {
                    return url("/upload/property/" . $property->id . "/" . $mediaFile);
                }
            }
        }
        
        // اگر هیچ تصویری وجود نداشت
        return url($defaultImage);
    }
}