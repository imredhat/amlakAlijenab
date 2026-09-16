<?php

if (!function_exists('getCat')) {
    function getCat($type)
    {
        return match($type) {
            'other' => 'سایر',
            'pre-sale' => 'پیش فروش و مشارکت در ساخت',
            'villa-sale' => 'خرید و فروش ویلا',
            'apartment-rent' => 'رهن و اجاره خانه و آپارتمان',
            'apartment-sale' => 'خرید و فروش خانه و آپارتمان',
            'villa-short-rent' => 'اجاره کوتاه مدت ویلا، سوئیت',
            'commercial-rent' => 'رهن و اجاره اداری، تجاری و صنعتی',
            'commercial-sale' => 'خرید و فروش اداری، تجاری و صنعتی',
            'land' => 'زمین و باغ',
            default => 'نامشخص',
        };
    }
}

if (! function_exists('getPropertyImage')) {
    function getPropertyImage($property, $defaultImage = '/img/blank.png')
    {
        $propertyId = $property->id ?? null;
        if (! $propertyId) {
            return $defaultImage;
        }

        $mediaValue = $property->media ?? [];
        if (is_string($mediaValue)) {
            $decodedMedia = json_decode($mediaValue, true);
            $media = is_array($decodedMedia)
                ? $decodedMedia
                : preg_split('/\s*,\s*/', trim($mediaValue, "[] \t\n\r\0\x0B\""));
        } elseif (is_array($mediaValue)) {
            $media = $mediaValue;
        } else {
            $media = [];
        }

        foreach ($media as $mediaFile) {
            $filename = basename(trim((string) $mediaFile));
            if ($filename !== '') {
                return '/upload/property/'.rawurlencode((string) $propertyId).'/'.rawurlencode($filename);
            }
        }

        // Support records whose files exist but whose media value was not
        // imported into MySQL correctly.
        $uploadDirectory = public_path('upload/property/'.basename((string) $propertyId));
        if (is_dir($uploadDirectory)) {
            $files = glob($uploadDirectory.'/*.{jpg,jpeg,png,gif,webp,avif}', GLOB_BRACE) ?: [];
            if ($files !== []) {
                return '/upload/property/'.rawurlencode((string) $propertyId).'/'.rawurlencode(basename($files[0]));
            }
        }

        return $defaultImage;
    }
}
