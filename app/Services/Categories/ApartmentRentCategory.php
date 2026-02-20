<?php

namespace App\Services\Categories;

class ApartmentRentCategory implements CategoryInterface
{
    public function getCategoryName(): string
    {
        return "رهن و اجاره آپارتمان";
    }

    public function getDisplayFields(): array
    {
        return ['area', 'mortgage', 'rent', 'city'];
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
        return $display;
    }

    public function getFooterItems($property): array
    {
        return [
            'area' => ($property->area ?? 0) . ' متر',
            'rooms' => ($property->rooms ?? 0) . ' اتاق',
            'city' => $property->city ?? '',
        ];
    }

    public function getTableColumns(): array
    {
        return [
            ['key' => 'title', 'label' => 'عنوان'],
            ['key' => 'category', 'label' => 'دسته‌بندی'],
            ['key' => 'mortgage', 'label' => 'رهن'],
            ['key' => 'rent', 'label' => 'اجاره'],
            ['key' => 'city', 'label' => 'شهر'],
            ['key' => 'status', 'label' => 'وضعیت'],
            ['key' => 'actions', 'label' => 'عملیات'],
        ];
    }

    public function getStatusBadge($property): string
    {
        // می‌توانید وضعیت‌های خاص هر دسته را تعریف کنید
        return (new OtherCategory())->getStatusBadge($property);
    }

    /**
     * مشخصات آگهی رهن و اجاره آپارتمان (بر پایه مشخصات عمومی)
     */
    public function getPropertyDetails($property): array
    {
        // از منطق عمومی OtherCategory استفاده می‌کنیم و در صورت نیاز بعداً می‌توان توسعه داد
        return (new OtherCategory())->getPropertyDetails($property);
    }

    /**
     * ویژگی‌های آگهی رهن و اجاره آپارتمان (بر پایه ویژگی‌های عمومی)
     */
    public function getFeatures($property): array
    {
        return (new OtherCategory())->getFeatures($property);
    }
}
