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
            @foreach($properties as $property)
                @php
                    $handler = App\Services\Categories\CategoryFactory::create($property->category);
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
                        {!! $handler->getStatusBadge($property) !!}
                    </td>

                    <!-- ستون عملیات -->
                    <td>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex flex-wrap gap-1 ">
                                <button type="button"
                                        class="btn btn-xs btn-outline-success"
                                        onclick="updatePropertyStatus('{{ $property->id }}', 'تایید شده')">
                                    تایید
                                </button>
                                <button type="button"
                                        class="btn btn-xs btn-outline-danger"
                                        onclick="if(confirm('آگهی رد شود؟')) updatePropertyStatus('{{ $property->id }}', 'رد شده')">
                                    رد
                                </button>


                                <div class="dropdown btn btn-outline-success">
                                <button class="btn bg p-0" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    <i data-feather="more-horizontal"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                    <li>
                                        <a class="dropdown-item" href="#"
                                           onclick="openPropertyModal(event, '{{ $property->id }}')">
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


                            </div>


                        </div>
                    </td>
                </tr>
            @endforeach

            @if($properties->isEmpty())
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

@if($properties instanceof \Illuminate\Pagination\LengthAwarePaginator && $properties->lastPage() > 1)
    <div class="d-sm-flex justify-content-between align-items-center text-center mt-3">
        <span class="fs-14">
            نمایش {{ $properties->firstItem() }} تا {{ $properties->lastItem() }} از {{ $properties->total() }} ورودی
        </span>
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0 mt-3 mt-sm-0 justify-content-center">
                {{-- Previous --}}
                <li class="page-item {{ $properties->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link icon"
                       href="#"
                       aria-label="Previous"
                       @if(! $properties->onFirstPage())
                           data-page="{{ $properties->currentPage() - 1 }}"
                       @endif
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-arrow-right">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </li>

                {{-- Page numbers --}}
                @for($page = 1; $page <= $properties->lastPage(); $page++)
                    <li class="page-item">
                        <a class="page-link {{ $page === $properties->currentPage() ? 'active' : '' }}"
                           href="#"
                           data-page="{{ $page }}">
                            {{ $page }}
                        </a>
                    </li>
                @endfor

                {{-- Next --}}
                <li class="page-item {{ $properties->currentPage() === $properties->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link icon"
                       href="#"
                       aria-label="Next"
                       @if($properties->currentPage() < $properties->lastPage())
                           data-page="{{ $properties->currentPage() + 1 }}"
                       @endif
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-arrow-left">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif

