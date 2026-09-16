@include('partials.home.header')


<!-- Demo switcher (offcanvas)-->

<!-- Page loading spinner-->
<div class="page-loading active">
  <div class="page-loading-inner">
    <div class="page-spinner"></div><span>لطفا منتظر باشید</span>
  </div>
</div>
<main class="page-wrapper">
  <!-- Sign In Modal-->
  <div class="modal fade" id="signin-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered p-2 my-0 mx-auto" style="max-width: 950px;">
      <div class="modal-content">
        <div class="row mx-0 align-items-center">
          <div class="col-md-6 border-end-md p-4 p-sm-5">
            <h2 class="h3 mb-4 mb-sm-5">سلام!<br>به سایت ما خوش آمدید.</h2><img class="d-block mx-auto rotate-img" src="{{ url('') }}/img/signin-modal/signin.svg" width="344" alt="Illustartion">
            <!-- <div class="mt-4 mt-sm-5">هنوز ثبت نام نکرده اید؟ <a href="signup-light.html">ثبت نام</a></div> -->
          </div>
          <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
            <!-- <a class="btn btn-outline-info w-100 mb-3" href="signin-light.html#"><i class="fi-google fs-lg me-1"></i>ورود با اکانت گوگل</a><a class="btn btn-outline-info w-100 mb-3" href="signin-light.html#"><i class="fi-facebook fs-lg me-1"></i>ورود با اکانت فیسبوک</a>
                  <div class="d-flex align-items-center py-3 mb-3">
                    <hr class="w-100">
                    <div class="px-3">یـا</div>
                    <hr class="w-100">
                  </div> -->
            <form class="needs-validation" novalidate action="{{ url('auth/check') }}" method="post" autocomplete="on">
              @csrf
              <div class="mb-4">
                <label class="form-label mb-2" for="signin-email">شماره موبایل</label>
                <input class="form-control" type="tel" id="signin-email" name="tel" placeholder="09123456789" required pattern="[0-9]{11}">
              </div>

              <button class="btn btn-primary btn-lg w-100" type="submit">ارسال کد</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navbar-->



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

                        <!-- تب اجاره / فروش -->
                        <div class="pb-4 mb-2 border-bottom">
                            <ul class="nav nav-tabs mb-0">
                                <li class="nav-item">
                                    <a class="nav-link {{ $type === 'rent' ? 'active' : '' }}"
                                       href="{{ route('property.city', ['slug' => $city->tag]) }}?type=rent">
                                        <i class="fi-rent fs-base me-2"></i>اجاره
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $type === 'sale' ? 'active' : '' }}"
                                       href="{{ route('property.city', ['slug' => $city->tag]) }}?type=sale">
                                        <i class="fi-home fs-base me-2"></i>فروش
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ !$type ? 'active' : '' }}"
                                       href="{{ route('property.city', ['slug' => $city->tag]) }}">
                                        همه
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- محله -->
                        @if($neighborhoods->count() > 0)
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">محله</h3>
                            <select class="form-select" id="neighborhood" name="neighborhood">
                                <option selected value="">همه محله‌ها</option>
                                @foreach($neighborhoods as $n)
                                <option value="{{ $n->name }}" {{ request('neighborhood') === $n->name ? 'selected' : '' }}>{{ $n->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- قیمت -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">قیمت</h3>
                            <div class="d-flex align-items-center mb-2">
                                <input type="text" class="form-control price-input" name="price_min" id="price_min"
                                       placeholder="حداقل" value="{{ request('price_min') }}">
                                <div class="mx-2">—</div>
                                <input type="text" class="form-control price-input" name="price_max" id="price_max"
                                       placeholder="حداکثر" value="{{ request('price_max') }}">
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

                        <!-- تعداد اتاق -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">تعداد اتاق</h3>
                            <select class="form-select" id="rooms" name="rooms">
                                <option selected value="">هر تعداد</option>
                                @for($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ request('rooms') >0  && request('rooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- طبقه -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">طبقه</h3>
                            <select class="form-select" id="floor" name="floor">
                                <option selected value="">هر طبقه</option>
                                @for($i = -2; $i <= 30; $i++)
                                <option value="{{ $i }}" {{ request('floor') >0  && request('floor') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- امکانات -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">امکانات</h3>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parking" id="parking" value="1" {{ request('parking') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="parking">پارکینگ</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="storage" id="storage" value="1" {{ request('storage') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="storage">انباری</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="elevator" id="elevator" value="1" {{ request('elevator') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="elevator">آسانسور</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="balcony" id="balcony" value="1" {{ request('balcony') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="balcony">بالکن</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pool" id="pool" value="1" {{ request('pool') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="pool">استخر</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="furnished" id="furnished" value="1" {{ request('furnished') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="furnished">مبله</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- مرتب‌سازی -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">مرتب‌سازی</h3>
                            <select class="form-select" id="sortby" name="sortby">
                                <option value="newest" {{ (request('sort') ?? 'newest') === 'newest' ? 'selected' : '' }}>جدیدترین</option>
                                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
                                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
                                <option value="area_desc" {{ request('sort') === 'area_desc' ? 'selected' : '' }}>بزرگ‌ترین متراژ</option>
                            </select>
                        </div>

                        <!-- دکمه پاک کردن -->
                        <div class="border-top py-4">
                            <button type="button" class="btn btn-outline-secondary w-100" id="reset-filters">
                                <i class="fi-rotate-right me-2"></i>پاک کردن فیلترها
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
                        <li class="breadcrumb-item active" aria-current="page">{{ $city->name }}</li>
                    </ol>
                </nav>

                <!-- عنوان -->
                <div class="d-flex align-items-center justify-content-between pb-3 pb-sm-4">
                    <div>
                        <h1 class="h4 mb-0">املاک {{ $city->name }}</h1>
                        <p class="text-muted fs-sm mb-0 mt-1">
                            <i class="fi-map-pin me-1"></i>
                            {{ $properties->total() }} آگهی در {{ $city->name }}
                        </p>
                    </div>
                    <button class="btn btn-primary d-lg-none" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#filters-sidebar">
                        <i class="fi-filter me-1"></i> فیلترها
                    </button>
                </div>

                <!-- مرتب‌سازی + تعداد نتایج -->
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch my-2">
                    <div class="d-flex align-items-center flex-shrink-0">
                        <label class="fs-sm me-2 pe-1 text-nowrap" for="sortby-top">
                            <i class="fi-arrows-sort text-muted mt-n1 me-2"></i>مرتب سازی:
                        </label>
                        <select class="form-select form-select-sm" id="sortby-top">
                            <option value="newest" {{ (request('sort') ?? 'newest') === 'newest' ? 'selected' : '' }}>جدیدترین</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
                            <option value="area_desc" {{ request('sort') === 'area_desc' ? 'selected' : '' }}>بزرگ‌ترین متراژ</option>
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
                            {{ $properties->appends(request()->query())->links('vendor.pagination.persian') }}
                        </div>
                    </div>
                </nav>
                @endif
                </div>

            </div>
        </div>
    </div>

    <script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var searchTimer = null;
            var lastUrl = '';
            var citySlug = '{{ $city->tag }}';

            function collectFilters() {
                var params = {};

                var type = '{{ $type }}';
                if (type) params.type = type;

                var neighborhood = $('#neighborhood').val();
                if (neighborhood) params.neighborhood = neighborhood;

                var priceMin = ($('#price_min').val() || '').replace(/,/g, '');
                if (priceMin) params.price_min = priceMin;

                var priceMax = ($('#price_max').val() || '').replace(/,/g, '');
                if (priceMax) params.price_max = priceMax;

                var areaMin = $('#area_min').val();
                if (areaMin) params.area_min = areaMin;

                var areaMax = $('#area_max').val();
                if (areaMax) params.area_max = areaMax;

                var rooms = $('#rooms').val();
                if (rooms !== '') params.rooms = rooms;

                var floor = $('#floor').val();
                if (floor !== '') params.floor = floor;

                if ($('#parking').is(':checked')) params.parking = 1;
                if ($('#storage').is(':checked')) params.storage = 1;
                if ($('#elevator').is(':checked')) params.elevator = 1;
                if ($('#balcony').is(':checked')) params.balcony = 1;
                if ($('#pool').is(':checked')) params.pool = 1;
                if ($('#furnished').is(':checked')) params.furnished = 1;

                var sort = $('#sortby').val() || $('#sortby-top').val();
                if (sort) params.sort = sort;

                return params;
            }

            function doSearch() {
                var params = collectFilters();
                var queryString = $.param(params);
                var url = '/city/' + citySlug + (queryString ? '?' + queryString : '');

                if (url === lastUrl) return;
                lastUrl = url;

                $('#properties-container').html('<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-3 text-muted">در حال بارگذاری...</p></div>');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#properties-container').html(response.html);
                        $('#results-count').text(response.total + ' نتیجه یافت شد');
                        window.history.pushState({}, '', url);
                    },
                    error: function() {
                        $('#properties-container').html('<div class="col-12 alert alert-danger text-center">خطا در بارگذاری آگهی‌ها.</div>');
                    }
                });
            }

            function debouncedSearch() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(doSearch, 400);
            }

            // Price inputs: format + debounce
            $('.price-input').on('input', function() {
                var value = $(this).val().replace(/\D/g, '');
                $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                debouncedSearch();
            });

            // Number inputs: debounce
            $('#area_min, #area_max').on('keyup', debouncedSearch);

            // Selects: immediate
            $('#neighborhood, #rooms, #floor').on('change', function() {
                lastUrl = '';
                doSearch();
            });

            // Sort top bar sync
            $('#sortby-top').on('change', function() {
                $('#sortby').val($(this).val());
                lastUrl = '';
                doSearch();
            });

            $('#sortby').on('change', function() {
                $('#sortby-top').val($(this).val());
            });

            // Checkboxes: immediate
            $('input[type="checkbox"]').on('change', function() {
                lastUrl = '';
                doSearch();
            });

            // Reset
            $('#reset-filters').on('click', function() {
                window.location.href = '/city/' + citySlug;
            });

            // Pagination AJAX
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                if (!url) return;

                $('#properties-container').html('<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#properties-container').html(response.html);
                        window.history.pushState({}, '', url);
                        $('html, body').animate({ scrollTop: 0 }, 300);
                    }
                });
            });

            // Browser back/forward
            $(window).on('popstate', function() {
                lastUrl = '';
                doSearch();
            });
        });
    </script>

    <style>
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important; }
    </style>

@include('partials.home.footer')
</main>
