@if($properties->hasPages())
<nav class="border-top pb-md-4 pt-4 mt-2" aria-label="Pagination">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="text-muted small">
            نمایش {{ $properties->firstItem() }} تا {{ $properties->lastItem() }} از {{ $properties->total() }} نتیجه
        </div>
        <div>
            {{ $properties->appends(request()->query())->links('pagination::persian') }}
        </div>
    </div>
</nav>
@endif
