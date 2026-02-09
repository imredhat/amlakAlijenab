<?php

namespace App\Services\Categories;

class CategoryFactory
{
    private static $categories = [
        'other' => OtherCategory::class,
        'apartment-rent' => ApartmentRentCategory::class,
        'apartment-sale' => ApartmentSaleCategory::class,
        'villa-sale' => VillaSaleCategory::class,
        'commercial-rent' => CommercialRentCategory::class,
        'commercial-sale' => CommercialSaleCategory::class,
        'land' => LandCategory::class,
        'pre-sale' => PreSaleCategory::class,
        'villa-short-rent' => VillaShortRentCategory::class,
    ];

    public static function create(string $category): CategoryInterface
    {
        if (!isset(self::$categories[$category])) {
            return new OtherCategory();
        }

        $className = self::$categories[$category];
        return new $className();
    }

    public static function getAllCategories(): array
    {
        return self::$categories;
    }
}
