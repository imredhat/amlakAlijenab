<?php

namespace App\Services\Categories;

class OtherCategory implements CategoryInterface
{
    public function getCategoryName(): string
    {
        return "سایر";
    }

    public function getDisplayFields(): array
    {
        return ['area', 'price', 'city'];
    }

    public function getPriceDisplay($property): string
    {
        return number_format($property->price ?? 0) . ' تومان';
    }

    public function getFooterItems($property): array
    {
        return [
            'area' => ($property->area ?? 0) . ' متر',
            'city' => $property->city ?? '',
        ];
    }

    public function getTableColumns(): array
    {
        return [
            ['key' => 'title', 'label' => 'عنوان'],
            ['key' => 'category', 'label' => 'دسته‌بندی'],
            ['key' => 'price', 'label' => 'قیمت'],
            ['key' => 'city', 'label' => 'شهر'],
            ['key' => 'status', 'label' => 'وضعیت'],
            ['key' => 'actions', 'label' => 'عملیات'],
        ];
    }

    public function getStatusBadge($status): string
    {
        $statuses = [
            'ثبت شده' => 'success',
            'در انتظار تایید' => 'warning',
            'رد شده' => 'danger',
            'غیرفعال' => 'secondary'
        ];

        $color = $statuses[$status] ?? 'secondary';
        return "<span class='badge bg-{$color}'>$status</span>";
    }
}
