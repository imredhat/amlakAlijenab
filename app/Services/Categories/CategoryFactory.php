<?php

namespace App\Services\Categories;

class CategoryFactory
{
    private static $categories = [
        'other' => OtherCategory::class,
        'apartment-rent' => ApartmentRentCategory::class,
        'apartment-sale' => ApartmentSaleCategory::class,
        'villa-sale' => VillaSaleCategory::class,
        'villa-short-rent' => VillaShortRentCategory::class,
        'commercial-rent' => CommercialRentCategory::class,
        'commercial-sale' => CommercialSaleCategory::class,
        'land' => LandCategory::class,
        'pre-sale' => PreSaleCategory::class,
    ];

    public static function create(string $category): CategoryInterface
    {
        if (!isset(self::$categories[$category])) {
            return new OtherCategory();
        }

        $className = self::$categories[$category];
        return new $className();
    }

    public static function getCategoryNames(): array
    {
        $names = [];
        foreach (self::$categories as $key => $class) {
            $handler = new $class();
            $names[$key] = $handler->getCategoryName();
        }
        return $names;
    }

    public static function getCategoryOptions(): array
    {
        $options = [];
        foreach (self::getCategoryNames() as $key => $name) {
            $options[] = [
                'value' => $key,
                'label' => $name
            ];
        }
        return $options;
    }
}
