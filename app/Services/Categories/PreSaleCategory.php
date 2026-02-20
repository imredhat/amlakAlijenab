<?php

namespace App\Services\Categories;

class PreSaleCategory extends OtherCategory
{
    public function getCategoryName(): string
    {
        return "پیش فروش و مشارکت در ساخت";
    }

    public function getFooterItems($property): array
    {
        return [
            'area' => ($property->area ?? 0) . ' متر',
            'floors' => ($property->totalFloors ?? 0) . ' طبقه',
            'progress' => ($property->physicalProgress ?? 0) . '%',
        ];
    }

    public function getPropertyDetails($property): array
    {
        $details = parent::getPropertyDetails($property);

        $extraDetails = [
            ['label' => 'وضعیت ملک', 'value' => $property->propertyCondition ?? ''],
            ['label' => 'نوع پروژه', 'value' => $property->projectType ?? ''],
            ['label' => 'موقعیت', 'value' => $property->propertyLocation ?? ''],
            ['label' => 'تعداد اتاق', 'value' => $property->roomCount ?? ''],
            ['label' => 'وضعیت سند', 'value' => $property->documentStatus ?? ''],
            ['label' => 'درصد مشارکت', 'value' => ($property->participationPercent ?? 0) . '%'],
            ['label' => 'تعداد طبقات', 'value' => $property->totalFloors ?? ''],
            ['label' => 'پیش پرداخت', 'value' => ($property->initialPayment ?? 0) . '%'],
            ['label' => 'پرداخت تحویل', 'value' => ($property->deliveryPayment ?? 0) . '%'],
            ['label' => 'وضعیت ساخت', 'value' => $property->projectStatus ?? ''],
            ['label' => 'سال تحویل', 'value' => $property->deliveryYear ?? ''],
            ['label' => 'ماه تحویل', 'value' => $property->deliveryMonth ?? ''],
            ['label' => 'پیشرفت فیزیکی', 'value' => ($property->physicalProgress ?? 0) . '%'],
            ['label' => 'واحد در طبقه', 'value' => $property->unitsPerFloor ?? ''],
            ['label' => 'حداقل متراژ واحد', 'value' => ($property->minUnitArea ?? 0) . ' متر'],
            ['label' => 'نام سازنده', 'value' => $property->builderName ?? ''],
            ['label' => 'پروانه ساخت', 'value' => $property->constructionPermit ?? ''],
            ['label' => 'قابل معاوضه', 'value' => ($property->exchange ?? '') === 'on' ? 'دارد' : 'ندارد'],
        ];

        return array_merge($details, $extraDetails);
    }

    public function getFeatures($property): array
    {
        $features = [];

        $preSaleFeatures = [
            'propertyCondition' => ['icon' => 'fi-home', 'label' => 'وضعیت ملک', 'condition' => true],
            'projectType' => ['icon' => 'fi-briefcase', 'label' => 'نوع پروژه', 'condition' => true],
            'propertyLocation' => ['icon' => 'fi-map-pin', 'label' => 'موقعیت', 'condition' => true],
            'exchange' => ['icon' => 'fi-refresh', 'label' => 'قابل معاوضه', 'condition' => 'on'],
            'constructionPermit' => ['icon' => 'fi-check-circle', 'label' => 'پروانه ساخت', 'condition' => true],
        ];

        foreach ($preSaleFeatures as $key => $config) {
            if (!empty($property->$key) &&
                ($config['condition'] === true || $property->$key === $config['condition'])) {
                $label = $config['label'];
                if ($config['condition'] === true) {
                    $label .= ': ' . $property->$key;
                }
                $features[] = ['icon' => $config['icon'], 'label' => $label];
            }
        }

        // نوار پیشرفت
        if (!empty($property->physicalProgress)) {
            $features[] = [
                'icon' => 'fi-bar-chart',
                'label' => 'پیشرفت: ' . $property->physicalProgress . '%',
                'progress' => $property->physicalProgress
            ];
        }

        return $features;
    }
}
