@php
    $expiryDate = null;
    $daysRemaining = null;

    if (!empty($p->expires_at)) {
        try {
            $expiryDate = \Illuminate\Support\Carbon::parse($p->expires_at)->startOfDay();
            $daysRemaining = (int) now()->startOfDay()->diffInDays($expiryDate, false);
        } catch (\Throwable $exception) {
            $expiryDate = null;
        }
    }
@endphp

@if($expiryDate)
    @if($daysRemaining < 0)
        <span class="d-table badge bg-danger mt-1">منقضی شده</span>
    @elseif($daysRemaining === 0)
        <span class="d-table badge bg-warning text-dark mt-1">امروز منقضی می‌شود</span>
    @elseif($daysRemaining <= 7)
        <span class="d-table badge bg-warning text-dark mt-1">{{ $daysRemaining }} روز تا انقضا</span>
    @else
        <span class="d-table badge bg-info text-dark mt-1">{{ $daysRemaining }} روز تا انقضا</span>
    @endif
@else
    <span class="d-table badge bg-secondary mt-1">بدون تاریخ انقضا</span>
@endif
