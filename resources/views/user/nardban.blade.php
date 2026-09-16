@include('partials.header')
@include('partials.home.menu')

<div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
    <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/user/myADS') }}">املاک من</a></li>
            <li class="breadcrumb-item active" aria-current="page">نردبان</li>
        </ol>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @include('user.side')

        <div class="col-lg-8 col-md-7 mb-5">

            {{-- ============================================================ --}}
            {{-- MODE: SELECT PACKAGE (when property_id is provided)          --}}
            {{-- ============================================================ --}}
            @if($mode === 'select_package')

                <h1 class="h4 mb-3">نردبان آگهی</h1>
                <p class="pb-2 mb-4 fs-base">پکیج مناسب خود را جهت ارتقای آگهی ملک خریداری نمایید.</p>

                @if(isset($property))
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ getPropertyImage($property) }}" alt="{{ $property->title }}" class="rounded me-3" width="80" height="80" style="object-fit: cover;">
                            <div>
                                <h5 class="mb-1">{{ $property->title }}</h5>
                                <span class="text-muted fs-sm">{{ $property->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if(count($packages) > 0)
                <div class="row">
                    @foreach($packages as $index => $pkg)
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card shadow-sm h-100 {{ $index === 1 ? 'shadow border-primary' : '' }}">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    @if($index === 0)
                                        <i class="fi-award fs-1 text-warning"></i>
                                    @elseif($index === 1)
                                        <i class="fi-ribbon fs-1 text-primary"></i>
                                    @else
                                        <i class="fi-star fs-1 text-success"></i>
                                    @endif
                                </div>
                                <h2 class="h5 fw-normal py-1 mb-0">{{ $pkg->name }}</h2>
                                <div class="d-flex align-items-end justify-content-center mb-4">
                                    <div class="h4 mb-0">{{ number_format($pkg->price) }}</div>
                                    <div class="pb-2 ps-2">تومان</div>
                                </div>
                                <ul class="list-unstyled d-block mb-0 mx-auto" style="max-width: 16rem;">
                                    <li class="d-flex">
                                        <i class="fi-check text-primary fs-sm mt-1 me-2"></i>
                                        <span>افزایش {{ $pkg->view_multiplier }} برابری بازدید</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fi-check text-primary fs-sm mt-1 me-2"></i>
                                        <span>اعتبار برای {{ $pkg->duration_days }} روز</span>
                                    </li>
                                    <li class="d-flex {{ $pkg->is_top_listed ? '' : 'text-muted' }}">
                                        <i class="fi-{{ $pkg->is_top_listed ? 'check text-primary fs-sm mt-1' : 'x fs-xs mt-2' }} me-2"></i>
                                        <span>آپدیت آگهی به لیست اول</span>
                                    </li>
                                    <li class="d-flex {{ $pkg->is_special_badge ? '' : 'text-muted' }}">
                                        <i class="fi-{{ $pkg->is_special_badge ? 'check text-primary fs-sm mt-1' : 'x fs-xs mt-2' }} me-2"></i>
                                        <span>جزء نشان ویژه در نتایج</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer py-2 border-0">
                                <div class="border-top text-center pt-4 pb-3">
                                    <form action="{{ url('/user/nardban/activate') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{ $pkg->id }}">
                                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                                        <button type="submit" class="btn btn-{{ $index === 1 ? 'primary' : 'outline-primary' }}">
                                            انتخاب پکیج
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fi-circle-info fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted">در حال حاضر پکیج فعالی وجود ندارد.</p>
                </div>
                @endif

            {{-- ============================================================ --}}
            {{-- MODE: LIST (when no property_id — show my boosted ads)       --}}
            {{-- ============================================================ --}}
            @else

                <h1 class="h4 mb-3">ارتقاءهای من (نردبان)</h1>
                <p class="pb-2 mb-4 fs-base">لیست آگهی‌هایی که ارتقا یافته‌اند را مشاهده کنید.</p>

                @if(count($boostedProperties) > 0)
                    @foreach($boostedProperties as $p)
                    <?php
                        $propertyBoosts = $activeBoost->where('property_id', $p->id);
                    ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <a href="{{ url('/p/' . $p->id . '/' . str_replace(' ', '-', $p->title)) }}">
                                    <img src="{{ getPropertyImage($p) }}" alt="{{ $p->title }}" class="rounded me-3" width="80" height="80" style="object-fit: cover;">
                                </a>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">
                                        <a href="{{ url('/p/' . $p->id . '/' . str_replace(' ', '-', $p->title)) }}" class="text-decoration-none text-dark">
                                            {{ $p->title }}
                                        </a>
                                    </h5>
                                    <span class="text-muted fs-sm">{{ $p->address }}</span>
                                </div>
                                <a href="{{ url('/user/nardban/' . $p->id) }}" class="btn btn-outline-primary btn-sm flex-shrink-0">
                                    <i class="fi-flame me-1"></i>ارتقای مجدد
                                </a>
                            </div>

                            @if(count($propertyBoosts) > 0)
                            <div class="table-responsive mt-3">
                                <table class="table table-sm table-borderless mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>پکیج</th>
                                            <th>تاریخ شروع</th>
                                            <th>تاریخ پایان</th>
                                            <th>وضعیت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($propertyBoosts as $boost)
                                        <tr>
                                            <td>{{ $boost->package->name ?? '---' }}</td>
                                            <td>{{ $boost->starts_at ? $boost->starts_at->format('Y/m/d') : '---' }}</td>
                                            <td>{{ $boost->expires_at ? $boost->expires_at->format('Y/m/d') : '---' }}</td>
                                            <td>
                                                @if($boost->status === 'active' && $boost->expires_at && $boost->expires_at->isFuture())
                                                    <span class="badge bg-success">فعال</span>
                                                @else
                                                    <span class="badge bg-secondary">منقضی</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="text-center py-5">
                    <i class="fi-flame fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted mb-3">شما هیچ ارتقایی ندارید.</p>
                    <p class="text-muted fs-sm">برای ارتقای آگهی خود، به صفحه <a href="{{ url('/user/myADS') }}">املاک من</a> بروید و روی آگهی مورد نظر سه‌نقطه را زده و گزینه «نردبان» را انتخاب کنید.</p>
                </div>
                @endif

            @endif

        </div>
    </div>
</div>

@include('partials.footer')
