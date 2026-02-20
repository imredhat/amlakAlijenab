<?php

namespace App\Services\Categories;

class VillaShortRentCategory extends VillaSaleCategory
{
    public function getCategoryName(): string
    {
        return "اجاره کوتاه مدت ویلا";
    }

    public function getPriceDisplay($property): string
    {
        if ($property->rent ?? 0 > 0) {
            return 'اجاره: ' . number_format($property->rent) . ' تومان';
        }
        return parent::getPriceDisplay($property);
    }

    public function getPropertyDetails($property): array
    {
        $details = parent::getPropertyDetails($property);

        // تغییر برچسب قیمت
        $details[1]['label'] = 'اجاره';
        $details[1]['value'] = $this->getPriceDisplay($property);

        return $details;
    }

    public function getFeatures($property): array
    {
        $features = parent::getFeatures($property);

        // ویژگی‌های خاص ویلا اجاره‌ای
        $shortTermFeatures = [
            'furnished' => ['icon' => 'fi-sofa', 'label' => 'مبله', 'condition' => 'on'],
            'pool_type' => ['icon' => 'fi-swimming-pool', 'label' => 'استخر', 'condition' => true],
            'sauna' => ['icon' => 'fi-spa', 'label' => 'سونا', 'condition' => 'on'],
            'jacuzzi' => ['icon' => 'fi-bath', 'label' => 'جکوزی', 'condition' => 'on'],
        ];

        foreach ($shortTermFeatures as $key => $config) {
            if (isset($property->$key) &&
                ($config['condition'] === true || $property->$key === $config['condition'])) {
                $features[] = $config;
            }
        }

        return $features;
    }
}
