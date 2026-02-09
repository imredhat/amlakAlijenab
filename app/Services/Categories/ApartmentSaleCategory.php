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
}

// به همین ترتیب برای بقیه دسته‌ها
