<?php

namespace App\Services\Categories;

class CommercialRentCategory extends OtherCategory
{
    public function getCategoryName(): string
    {
        return "رهن و اجاره تجاری";
    }

    public function getPriceDisplay($property): string
    {
        $display = '';
        if ($property->mortgage ?? 0 > 0) {
            $display .= 'رهن: ' . number_format($property->mortgage) . ' تومان<br>';
        }
        if ($property->rent ?? 0 > 0) {
            $display .= 'اجاره: ' . number_format($property->rent) . ' تومان';
        }
        return $display ?: parent::getPriceDisplay($property);
    }

    public function getFooterItems($property): array
    {
        return [
            'area' => ($property->area ?? 0) . ' متر',
            'type' => $property->type ?? $property->usage_type ?? '',
            'floor' => 'طبقه ' . ($property->floor ?? 0),
        ];
    }

    public function getPropertyDetails($property): array
    {
        $details = parent::getPropertyDetails($property);

        // جایگزینی قیمت
        $details[1]['value'] = $this->getPriceDisplay($property);

        $extraDetails = [
            ['label' => 'نوع', 'value' => $property->type ?? ''],
            ['label' => 'نوع کاربری', 'value' => $property->usage_type ?? ''],
            ['label' => 'طبقه', 'value' => $property->floor ?? ''],
            ['label' => 'سال ساخت', 'value' => $property->year_built ?? ''],
        ];

        return array_merge($details, $extraDetails);
    }

    public function getFeatures($property): array
    {
        $features = parent::getFeatures($property);

        $commercialFeatures = [
            'elevator' => ['icon' => 'fi-arrow-up', 'label' => 'آسانسور', 'condition' => 'دارد'],
            'parking' => ['icon' => 'fi-parking', 'label' => 'پارکینگ', 'condition' => 'دارد'],
            'toilet' => ['icon' => 'fi-bath', 'label' => 'سرویس بهداشتی', 'condition' => 'دارد'],
            'convertible' => ['icon' => 'fi-refresh', 'label' => 'قابل تبدیل', 'condition' => '1'],
        ];

        foreach ($commercialFeatures as $key => $config) {
            if (isset($property->$key) && $property->$key === $config['condition']) {
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
