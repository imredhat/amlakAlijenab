@include('partials.header')
@include('partials.home.menu')

<main class="page-wrapper">

    <div class="container-fluid mt-5 pt-5 p-0">
        <div class="row g-0 mt-n3">

            <!-- Sidebar فیلترها -->
            <aside class="col-lg-4 col-xl-3 border-top-lg border-end-lg shadow-sm px-3 px-xl-4 px-xxl-5 pt-lg-2">
                <div class="offcanvas-lg offcanvas-end" id="filters-sidebar">
                    <div class="offcanvas-header d-flex d-lg-none align-items-center">
                        <h2 class="h5 mb-0">فیلتر جستجو</h2>
                        <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#filters-sidebar"></button>
                    </div>

                    <div class="offcanvas-body py-lg-4">

                        <!-- دسته‌بندی‌ها -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">دسته‌بندی</h3>
                            <div class="d-flex flex-column gap-1">
                                <a href="{{ url('browse/apartment') }}"
                                   class="btn btn-sm {{ in_array('apartment', [$slug]) || in_array($slug, ['apartment-rent','apartment-sale']) ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                                    آپارتمان
                                </a>
                                <a href="{{ url('browse/villa') }}"
                                   class="btn btn-sm {{ in_array($slug, ['villa','villa-sale','villa-short-rent']) ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                                    ویلا
                                </a>
                                <a href="{{ url('browse/commercial') }}"
                                   class="btn btn-sm {{ in_array($slug, ['commercial','commercial-rent','commercial-sale']) ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                                    اداری و تجاری
                                </a>
                                <a href="{{ url('browse/land') }}"
                                   class="btn btn-sm {{ $slug === 'land' ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                                    زمین و باغ
                                </a>
                                <a href="{{ url('browse/pre-sale') }}"
                                   class="btn btn-sm {{ $slug === 'pre-sale' ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                                    پیش فروش
                                </a>
                            </div>
                        </div>

                        <!-- زیرمجموعه -->
                        @if(count($subcategories) > 1)
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">زیرمجموعه</h3>
                            <div class="d-flex flex-column gap-1">
                                @foreach($subcategories as $subSlug => $subName)
                                <a href="{{ url('browse/' . $subSlug) }}"
                                   class="btn btn-sm {{ $slug === $subSlug ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                                    {{ $subName }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- تب اجاره / فروش -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">نوع معامله</h3>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link {{ $type === 'rent' ? 'active' : '' }}"
                                       href="{{ url('browse/' . $slug . '?type=rent') }}">
                                        اجاره
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $type === 'sale' ? 'active' : '' }}"
                                       href="{{ url('browse/' . $slug . '?type=sale') }}">
                                        فروش
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ !$type ? 'active' : '' }}"
                                       href="{{ url('browse/' . $slug) }}">
                                        همه
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- موقعیت مکانی -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">موقعیت مکانی</h3>
                            <select class="form-select mb-2" id="city" name="city">
                                <option value="" selected>همه شهرها</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->name }}" {{ request('city') === $city->name ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- قیمت -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">قیمت</h3>
                            <div class="d-flex align-items-center">
                                <div class="w-50 pe-2">
                                    <input type="text" class="form-control price-input" name="price_min"
                                           id="price_min" placeholder="حداقل" value="{{ request('price_min') }}">
                                </div>
                                <div class="text-muted">—</div>
                                <div class="w-50 ps-2">
                                    <input type="text" class="form-control price-input" name="price_max"
                                           id="price_max" placeholder="حداکثر" value="{{ request('price_max') }}">
                                </div>
                            </div>
                        </div>

                        <!-- متراژ -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">متراژ (مترمربع)</h3>
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control" name="area_min" id="area_min"
                                       placeholder="حداقل" value="{{ request('area_min') }}">
                                <div class="mx-2">—</div>
                                <input type="number" class="form-control" name="area_max" id="area_max"
                                       placeholder="حداکثر" value="{{ request('area_max') }}">
                            </div>
                        </div>

                        <!-- دکمه‌ها -->
                        <div class="border-top py-4 d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary flex-fill" id="reset-filters">
                                <i class="fi-rotate-right me-2"></i>پاک کردن
                            </button>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- محتوای اصلی -->
            <div class="col-lg-8 col-xl-9 position-relative overflow-hidden pb-5 pt-4 px-3 px-xl-4 px-xxl-5">

                <!-- Breadcrumb -->
                <nav class="mb-3 pt-md-2" aria-label="Breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('browse/apartment') }}">آپارتمان</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>

                <!-- عنوان صفحه -->
                <div class="d-flex align-items-center justify-content-between pb-3 pb-sm-4">
                    <h1 class="h4 mb-sm-0">{{ $title }}</h1>
                    <button class="btn btn-primary d-lg-none" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#filters-sidebar">
                        <i class="fi-filter me-1"></i> فیلترها
                    </button>
                </div>

                <!-- مرتب‌سازی + تعداد نتایج -->
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch my-2">
                    <div class="d-flex align-items-center flex-shrink-0">
                        <label class="fs-sm me-2 pe-1 text-nowrap" for="sortby">
                            <i class="fi-arrows-sort text-muted mt-n1 me-2"></i>مرتب سازی:
                        </label>
                        <select class="form-select form-select-sm" id="sortby">
                            <option value="newest" {{ ($sort ?? '') === 'newest' ? 'selected' : '' }}>جدیدترین</option>
                            <option value="price_asc" {{ ($sort ?? '') === 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
                            <option value="price_desc" {{ ($sort ?? '') === 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
                            <option value="area_desc" {{ ($sort ?? '') === 'area_desc' ? 'selected' : '' }}>بزرگ‌ترین متراژ</option>
                            <option value="most_viewed" {{ ($sort ?? '') === 'most_viewed' ? 'selected' : '' }}>پربازدیدترین</option>
                        </select>
                    </div>
                    <hr class="d-none d-sm-block w-100 mx-4">
                    <div class="d-none d-sm-flex align-items-center flex-shrink-0 text-muted">
                        <i class="fi-check-circle me-2"></i>
                        <span class="fs-sm mt-n1" id="results-count">{{ $properties->total() }} نتیجه یافت شد</span>
                    </div>
                </div>

                <!-- لیست املاک -->
                <div id="properties-container" class="row g-4 py-4">
                    @if(isset($properties) && $properties->count() > 0)
                        @foreach($properties as $p)
                            <?php
                            $media = [""];
                            $cat = $p->category;
                            if (isset($p->media) && count(json_decode($p->media)) > 0) {
                                $media = json_decode($p->media);
                            }
                            ?>
                            @include("peroperty.vendor.".$cat)
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <i class="fi-folder-open fs-1 text-muted"></i>
                            <p class="text-muted fs-5 mt-3">هنوز هیچ آگهی ثبت نشده است.</p>
                        </div>
                    @endif
                </div>

                <!-- صفحه‌بندی -->
                <div id="pagination-container">
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
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var debounceTimer;

            function applyFilters() {
                var slug = '{{ $slug }}';
                var params = {};

                var type = '{{ $type }}';
                if (type) params.type = type;

                var sort = $('#sortby').val();
                if (sort) params.sort = sort;

                var city = $('#city').val();
                if (city) params.city = city;

                var priceMin = ($('#price_min').val() || '').replace(/,/g, '');
                if (priceMin) params.price_min = priceMin;

                var priceMax = ($('#price_max').val() || '').replace(/,/g, '');
                if (priceMax) params.price_max = priceMax;

                var areaMin = $('#area_min').val();
                if (areaMin) params.area_min = areaMin;

                var areaMax = $('#area_max').val();
                if (areaMax) params.area_max = areaMax;

                var categories = [];
                $('input[name="category[]"]:checked').each(function() {
                    categories.push($(this).val());
                });
                if (categories.length > 0) params['category[]'] = categories;

                var queryString = $.param(params, true);
                var url = '/browse/' + slug + (queryString ? '?' + queryString : '');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#properties-container').css('opacity', '0.5');
                    },
                    success: function(response) {
                        $('#properties-container').html(response.html).css('opacity', '1');
                        $('#pagination-container').html(response.pagination);
                        $('#results-count').text(response.total + ' نتیجه یافت شد');
                        window.history.pushState({}, '', url);
                    },
                    error: function() {
                        $('#properties-container').css('opacity', '1');
                    }
                });
            }

            // Auto-filter on any filter change
            $(document).on('change', '.filter-auto, #sortby', function() {
                applyFilters();
            });

            // Debounced for text inputs
            $(document).on('input', '.price-input, #price_min, #price_max, #area_min, #area_max', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(applyFilters, 500);
            });

            // City change
            $('#city').on('change', function() {
                applyFilters();
            });

            // Reset
            $('#reset-filters').on('click', function() {
                window.location.href = '/browse/{{ $slug }}';
            });

            // AJAX pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                if (!url) return;

                $('#properties-container').css('opacity', '0.5');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#properties-container').html(response.html).css('opacity', '1');
                        $('#pagination-container').html(response.pagination);
                        window.history.pushState({}, '', url);
                        $('html, body').animate({ scrollTop: 0 }, 300);
                    }
                });
            });

            // Format price inputs
            $('.price-input').on('input', function() {
                var value = $(this).val().replace(/\D/g, '');
                $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, ','));
            });
        });
    </script>

    <style>
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important; }
    </style>

@include('partials.home.footer')
</main>
