<?php

namespace App\Services\Categories;

class LandCategory extends OtherCategory
{
    public function getCategoryName(): string
    {
        return "زمین و باغ";
    }

    public function getFooterItems($property): array
    {
        return [
            'area' => ($property->area ?? 0) . ' متر',
            'usage' => $property->usage_type ?? '',
            'location' => $property->property_location ?? '',
        ];
    }

    public function getPropertyDetails($property): array
    {
        $details = parent::getPropertyDetails($property);

        $extraDetails = [
            ['label' => 'نوع کاربری', 'value' => $property->usage_type ?? ''],
            ['label' => 'موقعیت زمین', 'value' => $property->property_location ?? ''],
            ['label' => 'وضعیت سند', 'value' => $property->document_status ?? ''],
            ['label' => 'پروانه ساخت', 'value' => $property->building_permit ?? ''],
            ['label' => 'ساختمان قدیمی', 'value' => ($property->has_old_building ?? '') === 'بله' ? 'دارد' : 'ندارد'],
            ['label' => 'قابل معاوضه', 'value' => ($property->exchangeable ?? '') === 'بله' ? 'دارد' : 'ندارد'],
        ];

        return array_merge($details, $extraDetails);
    }

    public function getFeatures($property): array
    {
        $features = [];

        $landFeatures = [
            'has_old_building' => ['icon' => 'fi-home', 'label' => 'ساختمان قدیمی', 'condition' => 'بله'],
            'exchangeable' => ['icon' => 'fi-refresh', 'label' => 'قابل معاوضه', 'condition' => 'بله'],
            'building_permit' => ['icon' => 'fi-file', 'label' => 'پروانه ساخت', 'condition' => true],
        ];

        foreach ($landFeatures as $key => $config) {
            if (!empty($property->$key) &&
                ($config['condition'] === true || $property->$key === $config['condition'])) {
                $features[] = $config;
            }
        }

        // امکانات عمومی (utilities)
        if (isset($property->utilities) && is_array($property->utilities)) {
            $utilityIcons = [
                'آب' => 'fi-droplet',
                'برق' => 'fi-zap',
                'گاز' => 'fi-flame',
                'تلفن' => 'fi-phone',
            ];

            foreach ($property->utilities as $utility) {
                if (isset($utilityIcons[$utility])) {
                    $features[] = ['icon' => $utilityIcons[$utility], 'label' => $utility];
                }
            }
        }

        return $features;
    }
}
