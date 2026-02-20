<?php

namespace App\Services\Categories;

class ApartmentSaleCategory extends OtherCategory
{
    public function getCategoryName(): string
    {
        return "خرید و فروش آپارتمان";
    }

    public function getFooterItems($property): array
    {
        return [
            'area' => ($property->area ?? 0) . ' متر',
            'rooms' => ($property->rooms ?? 0) . ' اتاق',
            'floor' => ($property->floor ?? 0) . ' طبقه',
        ];
    }

    public function getPropertyDetails($property): array
    {
        $details = parent::getPropertyDetails($property);

        $extraDetails = [
            ['label' => 'سال ساخت', 'value' => $property->construction_year ?? $property->build_year ?? ''],
            ['label' => 'تعداد اتاق', 'value' => ($property->rooms ?? 0)],
            ['label' => 'طبقه', 'value' => $property->floor ?? ''],
            ['label' => 'واحد در طبقه', 'value' => $property->unit_per_floor ?? ''],
            ['label' => 'جهت ساختمان', 'value' => $property->building_direction ?? ''],
        ];

        return array_merge($details, $extraDetails);
    }

    public function getFeatures($property): array
    {
        $features = parent::getFeatures($property);

        $extraFeatures = [
            'elevator' => ['icon' => 'fi-arrow-up', 'label' => 'آسانسور', 'condition' => 'دارد'],
            'parking' => ['icon' => 'fi-parking', 'label' => 'پارکینگ', 'condition' => 'دارد'],
            'storage' => ['icon' => 'fi-gearbox', 'label' => 'انباری', 'condition' => 'دارد'],
            'balcony' => ['icon' => 'fi-real-estate-house', 'label' => 'بالکن', 'condition' => 'دارد'],
            'rebuilt' => ['icon' => 'fi-home', 'label' => 'بازسازی شده', 'condition' => 'on'],
        ];

        foreach ($extraFeatures as $key => $config) {
            if (isset($property->$key) && $property->$key === $config['condition']) {
                $features[] = $config;
            }
        }

        return $features;
    }
}
