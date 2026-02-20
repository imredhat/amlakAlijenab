<?php

namespace App\Services\Categories;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;

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

    public function getStatusBadge($property): string
    {
        $statusLabel = $this->getEffectiveStatus($property);

        // نگاشت وضعیت‌ها به رنگ بوت‌استرپ
        $statusColors = [
            'ثبت شده'       => 'secondary',
            'تایید شده'     => 'success',
            'رد شده'        => 'danger',
            'در انتظار تایید' => 'warning',
            'منقضی'         => 'dark',
        ];

        $color = $statusColors[$statusLabel] ?? 'secondary';

        return "<span class='badge bg-{$color}'>$statusLabel</span>";
    }

    /**
     * محاسبه وضعیت نهایی آگهی (شامل منقضی شدن)
     */
    protected function getEffectiveStatus($property): string
    {
        $status = $property->status ?? 'ثبت شده';

        // اگر وضعیت به‌طور صریح رد شده باشد، منقضی در نظر نمی‌گیریم
        if ($status === 'رد شده') {
            return $status;
        }

        // بررسی منقضی شدن بر اساس تاریخ ثبت
        $dateString = $property->date_created ?? $property->created_at ?? null;

        if ($dateString) {
            try {
                $year = (int) substr($dateString, 0, 4);

                // اگر سال شمسی (کوچک‌تر از 1700) باشد، با ورتا به میلادی تبدیل می‌کنیم
                if ($year > 0 && $year < 1700) {
                    $v      = Verta::parse($dateString);
                    $carbon = Carbon::instance($v->datetime());
                } else {
                    $carbon = Carbon::parse($dateString);
                }

                if ($carbon->lt(now()->subMonth())) {
                    return 'منقضی';
                }
            } catch (\Throwable $e) {
                // در صورت خطا در پارس تاریخ، همان وضعیت اصلی را برمی‌گردانیم
            }
        }

        return $status;
    }

    /**
     * مشخصات عمومی برای تمام دسته‌ها
     */
    public function getPropertyDetails($property): array
    {
        return [
            [
                'label' => 'متراژ',
                'value' => ($property->area ?? 0) . ' متر',
            ],
            [
                'label' => 'قیمت',
                'value' => $this->getPriceDisplay($property),
            ],
            [
                'label' => 'شهر',
                'value' => $property->city ?? '',
            ],
            [
                'label' => 'آدرس',
                'value' => $property->address ?? '',
            ],
            [
                'label' => 'وضعیت آگهی',
                'value' => $this->getEffectiveStatus($property),
            ],
        ];
    }

    /**
     * امکانات عمومی برای تمام دسته‌ها
     */
    public function getFeatures($property): array
    {
        $features = [];

        if (!empty($property->area)) {
            $features[] = [
                'icon'  => 'fi-ruler',
                'label' => 'متراژ: ' . $property->area . ' متر',
            ];
        }

        if (!empty($property->city)) {
            $features[] = [
                'icon'  => 'fi-map-pin',
                'label' => 'شهر: ' . $property->city,
            ];
        }

        if (!empty($property->price)) {
            $features[] = [
                'icon'  => 'fi-credit-card',
                'label' => 'قیمت: ' . number_format($property->price) . ' تومان',
            ];
        }

        if (!empty($property->status)) {
            $features[] = [
                'icon'  => 'fi-check-circle',
                'label' => 'وضعیت: ' . $property->status,
            ];
        }

        return $features;
    }
}
