@include('admin.parts.header')

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fs-18 mb-0">لیست آگهی‌ها</h4>
                    <div>
                        <a href="" class="btn btn-primary btn-sm">
                            <i class="fi-plus me-1"></i> آگهی جدید
                        </a>
                    </div>
                </div>

                <div class="tab-pane fade show active" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0"> <div class="default-table-area members-list">

                <div class="table-responsive">
                    <table class="table align-middle" id="myTable">
                        <thead>
                            <tr>
                                @php
                                    // گرفتن ستون‌های جدول از اولین دسته (همه یکسان هستند)
                                    $sampleHandler = App\Services\Categories\CategoryFactory::create('other');
                                    $sampleHandler = App\Services\Categories\CategoryFactory::create('villa-sale');
                                    $columns = $sampleHandler->getTableColumns();
                                @endphp

                                @foreach($columns as $column)
                                <th scope="col">{{ $column['label'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groupedProperties as $item)
                            @php
                                $property = $item['property'];
                                $handler = $item['handler'];
                                $media = json_decode($property->media ?? '[]');
                                $firstImage = !empty($media) ? $media[0] : 'default.jpg';
                            @endphp

                            <tr>
                                <!-- ستون عنوان -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check pe-2">
                                            <input class="form-check-input row-checkbox" type="checkbox" value="{{ $property->id ?? $property->id }}">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 lh-1">
                                                <img src="{{ url('/') }}/upload/property/{{ $property->id ?? $property->id }}/{{ $firstImage }}"
                                                     class="wh-44 rounded-circle" alt="{{ $property->title }}"
                                                     onerror="this.src='https://envytheme.ir/farol/rtl/assets/images/user-1.jpg'">
                                            </div>
                                            <div class="flex-grow-1 ms-10">
                                                <h4 class="fw-semibold fs-16 mb-0">{{ $property->title }}</h4>
                                                <span class="text-gray-light">
                                                    @foreach($handler->getFooterItems($property) as $key => $value)
                                                        {{ $value }}@if(!$loop->last) • @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- ستون دسته‌بندی -->
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        {{ $handler->getCategoryName() }}
                                    </span>
                                </td>

                                <!-- ستون قیمت (متفاوت بر اساس دسته) -->
                                <td>
                                    {!! $handler->getPriceDisplay($property) !!}
                                </td>

                                <!-- ستون شهر -->
                                <td>{{ $property->city }}</td>

                                <!-- ستون وضعیت -->
                                <td>
                                    {!! $handler->getStatusBadge($property->status ?? 'ثبت شده') !!}
                                </td>

                                <!-- ستون عملیات -->
                                <td>
                                    <div class="dropdown action-opt">
                                        <button class="btn bg p-0" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i data-feather="more-horizontal"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{ url('/') }}/p/{{ $property->id ?? $property->id }}/{{ str_replace(' ', '-', $property->title) }}" target="_blank">
                                                    <i data-feather="eye"></i> مشاهده
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ url('properties.edit', $property->id ?? $property->id) }}">
                                                    <i data-feather="edit-3"></i> ویرایش
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="shareProperty('{{ $property->id }}')">
                                                    <i data-feather="share-2"></i> اشتراک گذاری
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="copyLink('{{ url('/p/' . $property->id) }}')">
                                                    <i data-feather="link-2"></i> دریافت لینک
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ url('properties.destroy', $property->id ?? $property->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('آیا مطمئن هستید؟')">
                                                        <i data-feather="trash-2"></i> حذف
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($groupedProperties) == 0)
                            <tr>
                                <td colspan="{{ count($columns) }}" class="text-center py-4">
                                    <div class="text-muted">
                                        <i data-feather="inbox" class="feather-48 mb-3"></i>
                                        <p>هیچ آگهی‌ای یافت نشد.</p>
                                        <a href="{{ url('properties.create') }}" class="btn btn-primary btn-sm">
                                            ایجاد اولین آگهی
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>

<script>
// Select All Checkbox
document.getElementById('selectAll').addEventListener('change', function(e) {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = e.target.checked;
    });
});

// Share Property
function shareProperty(id) {
    const url = window.location.origin + '/p/' + id;
    if (navigator.share) {
        navigator.share({
            title: 'آگهی املاک',
            text: 'مشاهده آگهی املاک',
            url: url,
        });
    } else {
        copyLink(url);
        alert('لینک کپی شد!');
    }
}

// Copy Link
function copyLink(url) {
    navigator.clipboard.writeText(url).then(() => {
        alert('لینک در کلیپ‌بورد کپی شد!');
    });
}
</script>

<style>
.table-responsive {
    overflow-x: visible;
    -webkit-overflow-scrolling: touch;
}

.wh-44 {
    width: 44px;
    height: 44px;
    object-fit: cover;
}

.badge {
    font-size: 12px;
    padding: 4px 8px;
}
</style>

@include('admin.parts.footer')
