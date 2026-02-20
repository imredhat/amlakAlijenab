<?php

namespace App\Services\Categories;

class VillaSaleCategory extends OtherCategory
{
    public function getCategoryName(): string
    {
        return "خرید و فروش ویلا";
    }

    public function getFooterItems($property): array
    {
        return [
            'floors' => ($property->floor_count ?? 0) . ' طبقه',
            'rooms' => ($property->rooms ?? 0) . ' اتاق',
            'toilet' => ($property->toilet ?? 0) . ' سرویس',
        ];
    }

    public function getPropertyDetails($property): array
    {
        $details = parent::getPropertyDetails($property);

        $extraDetails = [
            ['label' => 'تعداد طبقات', 'value' => $property->floor_count ?? ''],
            ['label' => 'نوع ساختمان', 'value' => $property->building_type ?? ''],
            ['label' => 'تعداد اتاق', 'value' => $property->rooms ?? ''],
            ['label' => 'تعداد سرویس بهداشتی', 'value' => $property->toilet ?? ''],
            ['label' => 'جهت ساختمان', 'value' => $property->building_direction ?? ''],
            ['label' => 'نوع کف', 'value' => $property->floor_type ?? ''],
            ['label' => 'سیستم سرمایش', 'value' => $property->cooling_system ?? ''],
            ['label' => 'نوع سند', 'value' => $property->document_type ?? ''],
            ['label' => 'نوع استخر', 'value' => $property->pool_type ?? ''],
        ];

        return array_merge($details, $extraDetails);
    }

    public function getFeatures($property): array
    {
        $features = parent::getFeatures($property);

        $extraFeatures = [
            'pool_type' => ['icon' => 'fi-swimming-pool', 'label' => 'استخر', 'condition' => true],
            'cooling_system' => ['icon' => 'fi-snowflake', 'label' => 'سیستم سرمایش', 'condition' => true],
            'building_type' => ['icon' => 'fi-home', 'label' => 'نوع ساختمان', 'condition' => true],
            'document_type' => ['icon' => 'fi-file-text', 'label' => 'سند', 'condition' => true],
        ];

        foreach ($extraFeatures as $key => $config) {
            if (!empty($property->$key)) {
                $label = $config['label'];
                if ($key === 'pool_type' || $key === 'building_type' || $key === 'cooling_system' || $key === 'document_type') {
                    $label .= ': ' . $property->$key;
                }
                $features[] = ['icon' => $config['icon'], 'label' => $label];
            }
        }

        return $features;
    }
}
