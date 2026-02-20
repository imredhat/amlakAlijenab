<?php

namespace App\Services\Categories;

interface CategoryInterface
{
    public function getCategoryName(): string;
    public function getDisplayFields(): array;
    public function getPriceDisplay($property): string;
    public function getFooterItems($property): array;
    public function getTableColumns(): array;
    public function getStatusBadge($property): string;
    public function getPropertyDetails($property): array;
    public function getFeatures($property): array;
}
