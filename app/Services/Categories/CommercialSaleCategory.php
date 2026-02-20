<?php

namespace App\Services\Categories;

class CommercialSaleCategory extends CommercialRentCategory
{
    public function getCategoryName(): string
    {
        return "خرید و فروش تجاری";
    }

    public function getPriceDisplay($property): string
    {
        return parent::getPriceDisplay($property);
    }

    public function getPropertyDetails($property): array
    {
        $details = parent::getPropertyDetails($property);

        $extraDetails = [
            ['label' => 'وضعیت سند', 'value' => $this->getDocStatus($property->document_status ?? '')],
            ['label' => 'وضعیت فعلی', 'value' => $this->getCurrentStatus($property->current_status ?? '')],
            ['label' => 'تعداد اتاق', 'value' => $property->rooms ?? ''],
        ];

        return array_merge($details, $extraDetails);
    }

    private function getDocStatus($status): string
    {
        $statuses = [
            'full_property' => 'سند کامل',
            'official_document' => 'سند رسمی',
            'partial_document' => 'سند ناقص',
            'lease_document' => 'سند اجاره‌ای'
        ];
        return $statuses[$status] ?? $status;
    }

    private function getCurrentStatus($status): string
    {
        $statuses = [
            'under_renovation' => 'در حال بازسازی',
            'ready' => 'آماده',
            'under_construction' => 'در حال ساخت',
            'old' => 'قدیمی'
        ];
        return $statuses[$status] ?? $status;
    }

    public function getFeatures($property): array
    {
        $features = parent::getFeatures($property);

        // امکانات تجاری خاص
        if (isset($property->utilities) && is_array($property->utilities)) {
            $commercialUtilities = [
                'اتاق مدیریت' => 'fi-user-check',
                'اتاق کنفرانس' => 'fi-users',
                'فضای پذیرش/منشی' => 'fi-user',
                'آبدارخانه/آشپزخانه کوچک' => 'fi-coffee',
                'تابلوخور' => 'fi-award',
                'ورودی مجزا' => 'fi-door',
                'نگهبانی/لابی من' => 'fi-shield',
            ];

            foreach ($property->utilities as $utility) {
                if (isset($commercialUtilities[$utility])) {
                    $features[] = ['icon' => $commercialUtilities[$utility], 'label' => $utility];
                }
            }
        }

        return $features;
    }
}
