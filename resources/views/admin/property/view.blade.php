<div class="property-modal-content">
    @php
        $media = json_decode($property[0]->media ?? '[]', true);
    @endphp

    {{-- هدر آگهی --}}
    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-3">
        <div>
            <h2 class="h4 mb-1">{{ $property[0]->title }}</h2>
            <p class="mb-1 text-muted small">
                <i class="fi-map-pin me-1"></i>
                {{ $property[0]->city }} - {{ $property[0]->address }}
            </p>
            <div class="d-flex align-items-center gap-2 mt-1">
                <span class="badge bg-primary bg-opacity-10 text-primary">
                    <i class="fi-home me-1"></i>{{ $categoryHandler->getCategoryName() }}
                </span>
                @if(!empty($property[0]->status))
                    <span class="badge bg-success bg-opacity-10 text-success">
                        {{ $property[0]->status }}
                    </span>
                @endif
            </div>
        </div>
        @if(!empty($property[0]->price))
            <div class="text-lg-end mt-3 mt-lg-0">
                <div class="text-muted small mb-1">قیمت</div>
                <div class="h4 mb-0 text-primary">
                    {{ number_format($property[0]->price) }} <span class="fs-sm">تومان</span>
                </div>
            </div>
        @endif
    </div>

    {{-- گالری تصاویر --}}
    @if(!empty($media))
        <div class="property-gallery mb-4">
            <div class="main-image mb-3">
                <img src="{{ url('/') }}/upload/property/{{ $property[0]->id }}/{{ $media[0] }}"
                     class="img-fluid rounded-3 w-100 property-main-img"
                     alt="{{ $property[0]->title }}"
                     onerror="this.src='https://envytheme.ir/farol/rtl/assets/images/user-1.jpg'">
            </div>

            @if(count($media) > 1)
                <div class="d-flex flex-wrap gap-2">
                    @foreach($media as $index => $img)
                        @if($index === 0)
                            @continue
                        @endif
                        <button type="button"
                                class="btn p-0 border-0 bg-transparent thumb-btn"
                                onclick="this.closest('.property-gallery').querySelector('.property-main-img').src='{{ url('/') }}/upload/property/{{ $property[0]->id }}/{{ $img }}'">
                            <img src="{{ url('/') }}/upload/property/{{ $property[0]->id }}/{{ $img }}"
                                 class="property-thumb-img rounded-2"
                                 alt="{{ $property[0]->title }}"
                                 onerror="this.src='https://envytheme.ir/farol/rtl/assets/images/user-1.jpg'">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    <hr class="mb-4">

    <div class="row">
        {{-- ستون امکانات --}}
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h3 class="h6 mb-3 d-flex align-items-center">
                <i class="fi-layers me-2 text-primary"></i>
                ویژگی‌ها
            </h3>

            <ul class="list-unstyled row row-cols-lg-2 row-cols-md-2 row-cols-1 gy-2 mb-0 text-nowrap">
                @forelse($categoryHandler->getFeatures($property[0]) as $feature)
                    <li class="col d-flex align-items-center">
                        <span class="feature-icon rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center me-2">
                            <i class="{{ $feature['icon'] }} fs-base"></i>
                        </span>
                        <span class="fs-sm">{{ $feature['label'] }}</span>
                    </li>
                @empty
                    <li class="text-muted fs-sm">امکانی ثبت نشده است.</li>
                @endforelse
            </ul>
        </div>

        {{-- ستون مشخصات --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-3 p-lg-4">
                    <h3 class="h6 mb-3 d-flex align-items-center">
                        <i class="fi-list-check me-2 text-primary"></i>
                        مشخصات {{ $categoryHandler->getCategoryName() }}
                    </h3>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <tbody>
                                @foreach($categoryHandler->getPropertyDetails($property[0]) as $detail)
                                    @if(!empty($detail['value']))
                                        <tr>
                                            <td class="text-muted fs-sm" style="width: 40%">{{ $detail['label'] }}</td>
                                            <td class="fw-semibold fs-sm">{!! $detail['value'] !!}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .property-modal-content {
        padding: 0.25rem 0.5rem 0.5rem 0.5rem;
    }

    .property-modal-content .feature-icon {
        width: 32px;
        height: 32px;
    }

    .property-gallery .property-main-img {
        max-height: 360px;
        object-fit: cover;
    }

    .property-thumb-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }

    .property-gallery .thumb-btn:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
    }
</style>
