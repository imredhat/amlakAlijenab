@include('partials.home.header')

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
          </div>
          <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
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

  @include('partials.home.menu')

  <div class="container-fluid mt-5 pt-5 p-0">
    <div class="row g-0 mt-n3">

      <!-- Sidebar filters -->
      <aside class="col-lg-4 col-xl-3 border-top-lg border-end-lg shadow-sm px-3 px-xl-4 px-xxl-5 pt-lg-2">
        <div class="offcanvas-lg offcanvas-end" id="filters-sidebar">
          <div class="offcanvas-header d-flex d-lg-none align-items-center">
            <h2 class="h5 mb-0">فیلتر جستجو</h2>
            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#filters-sidebar"></button>
          </div>

          <div class="offcanvas-body py-lg-4">

            <!-- Search -->
            <div class="pb-4 mb-2 border-bottom">
              <h3 class="h6">جستجو</h3>
              <div class="input-group">
                <input type="text" class="form-control" id="q" name="q" placeholder="عنوان، آدرس..." value="{{ request('q') }}">
              </div>
            </div>

            <!-- Category -->
            <div class="pb-4 mb-2 border-bottom">
              <h3 class="h6">نوع ملک</h3>
              <select class="form-select mb-2" id="category" name="category">
                <option value="">همه انواع</option>
                <option value="apartment-rent" {{ request('category') === 'apartment-rent' ? 'selected' : '' }}>رهن و اجاره آپارتمان</option>
                <option value="apartment-sale" {{ request('category') === 'apartment-sale' ? 'selected' : '' }}>خرید و فروش آپارتمان</option>
                <option value="villa-sale" {{ request('category') === 'villa-sale' ? 'selected' : '' }}>خرید و فروش ویلا</option>
                <option value="villa-short-rent" {{ request('category') === 'villa-short-rent' ? 'selected' : '' }}>اجاره کوتاه مدت ویلا</option>
                <option value="commercial-rent" {{ request('category') === 'commercial-rent' ? 'selected' : '' }}>رهن و اجاره تجاری</option>
                <option value="commercial-sale" {{ request('category') === 'commercial-sale' ? 'selected' : '' }}>خرید و فروش تجاری</option>
                <option value="land" {{ request('category') === 'land' ? 'selected' : '' }}>زمین و باغ</option>
                <option value="pre-sale" {{ request('category') === 'pre-sale' ? 'selected' : '' }}>پیش فروش</option>
                <option value="other" {{ request('category') === 'other' ? 'selected' : '' }}>سایر</option>
              </select>
            </div>

            <!-- Location -->
            <div class="pb-4 mb-2 border-bottom">
              <h3 class="h6">موقعیت مکانی</h3>
              <select class="form-select mb-2" id="city" name="city">
                <option value="">همه شهرها</option>
                @foreach($cities as $city)
                <option value="{{ $city->name }}" data-city-name="{{ $city->name }}" {{ request('city') === $city->name ? 'selected' : '' }}>
                  {{ $city->name }}
                </option>
                @endforeach
              </select>
              <select class="form-select mb-2" id="neighborhood" name="neighborhood">
                <option value="">همه محله‌ها</option>
              </select>
            </div>

            <!-- Price -->
            <div class="pb-4 mb-2 border-bottom">
              <h3 class="h6">قیمت</h3>
              <div class="d-flex align-items-center mb-2">
                <input type="text" class="form-control price-input" name="price_min" id="price_min" placeholder="حداقل" value="{{ request('price_min') }}">
                <div class="mx-2">—</div>
                <input type="text" class="form-control price-input" name="price_max" id="price_max" placeholder="حداکثر" value="{{ request('price_max') }}">
              </div>
            </div>

            <!-- Rent -->
            <div class="pb-4 mb-2 border-bottom">
              <h3 class="h6">اجاره ماهانه</h3>
              <div class="d-flex align-items-center mb-2">
                <input type="text" class="form-control price-input" name="rent_min" id="rent_min" placeholder="حداقل" value="{{ request('rent_min') }}">
                <div class="mx-2">—</div>
                <input type="text" class="form-control price-input" name="rent_max" id="rent_max" placeholder="حداکثر" value="{{ request('rent_max') }}">
              </div>
            </div>

            <!-- Area -->
            <div class="pb-4 mb-2 border-bottom">
              <h3 class="h6">متراژ (مترمربع)</h3>
              <div class="d-flex align-items-center">
                <input type="number" class="form-control" name="area_min" id="area_min" placeholder="حداقل" value="{{ request('area_min') }}">
                <div class="mx-2">—</div>
                <input type="number" class="form-control" name="area_max" id="area_max" placeholder="حداکثر" value="{{ request('area_max') }}">
              </div>
            </div>

            <!-- Rooms -->
            <div class="pb-4 mb-2 border-bottom">
              <h3 class="h6">تعداد اتاق</h3>
              <select class="form-select" id="rooms" name="rooms">
                <option value="">هر تعداد</option>
                @for($i = 0; $i <= 10; $i++)
                <option value="{{ $i }}" {{ request('rooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
              </select>
            </div>

            <!-- Reset -->
            <div class="border-top py-4">
              <button type="button" class="btn btn-outline-secondary w-100" id="reset-filters">
                <i class="fi-rotate-right me-2"></i>پاک کردن فیلترها
              </button>
            </div>
          </div>
        </div>
      </aside>

      <!-- Main content -->
      <div class="col-lg-8 col-xl-9 position-relative overflow-hidden pb-5 pt-4 px-3 px-xl-4 px-xxl-5">

        <!-- Breadcrumb -->
        <nav class="mb-3 pt-md-2" aria-label="Breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
            <li class="breadcrumb-item active" aria-current="page">خانه های ویژه</li>
          </ol>
        </nav>

        <!-- Title -->
        <div class="d-flex align-items-center justify-content-between pb-3 pb-sm-4">
          <h1 class="h4 mb-sm-0"><i class="fi-star text-warning me-2"></i>خانه های ویژه ما</h1>
          <button class="btn btn-primary d-lg-none" type="button"
                  data-bs-toggle="offcanvas" data-bs-target="#filters-sidebar">
              <i class="fi-filter me-1"></i> فیلترها
          </button>
        </div>

        <!-- Sorting + count -->
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch my-2">
          <div class="d-flex align-items-center flex-shrink-0">
            <label class="fs-sm me-2 pe-1 text-nowrap" for="sortby">
              <i class="fi-arrows-sort text-muted mt-n1 me-2"></i>مرتب سازی:
            </label>
            <select class="form-select form-select-sm" id="sortby">
              <option value="newest" {{ (request('sort') ?? 'newest') === 'newest' ? 'selected' : '' }}>جدیدترین</option>
              <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
              <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
              <option value="area_desc" {{ request('sort') === 'area_desc' ? 'selected' : '' }}>بزرگ‌ترین متراژ</option>
              <option value="most_viewed" {{ request('sort') === 'most_viewed' ? 'selected' : '' }}>پربازدیدترین</option>
            </select>
          </div>
          <hr class="d-none d-sm-block w-100 mx-4">
          <div class="d-none d-sm-flex align-items-center flex-shrink-0 text-muted">
            <i class="fi-check-circle me-2"></i>
            <span class="fs-sm mt-n1" id="results-count">{{ $properties->total() }} نتیجه یافت شد</span>
          </div>
        </div>

        <!-- Properties list -->
        <div id="properties-container" class="row g-4 py-4">
          @if(isset($properties) && $properties->count() > 0)
            @foreach($properties as $p)
              <?php
              $media = [];
              $cat = $p->category;
              if (isset($p->media) && !empty($p->media)) {
                  $decoded = json_decode($p->media, true);
                  if (is_array($decoded)) {
                      $media = $decoded;
                  }
              }
              ?>
              @include("peroperty.vendor.".$cat)
            @endforeach
          @else
            <div class="col-12 text-center py-5">
              <i class="fi-star fs-1 text-muted"></i>
              <p class="text-muted fs-5 mt-3">آگهی ویژه‌ای یافت نشد.</p>
            </div>
          @endif
        </div>

        <!-- Pagination -->
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

  <script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>
  <script>
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    $(document).ready(function() {

        let searchTimer = null;
        let lastUrl = '';

        function collectFilters() {
            let params = {};

            let q = $('#q').val();
            if (q) params.q = q;

            let category = $('#category').val();
            if (category) params.category = category;

            let city = $('#city').val();
            if (city) params.city = city;

            let neighborhood = $('#neighborhood').val();
            if (neighborhood) params.neighborhood = neighborhood;

            let priceMin = $('#price_min').val().replace(/,/g, '');
            if (priceMin) params.price_min = priceMin;

            let priceMax = $('#price_max').val().replace(/,/g, '');
            if (priceMax) params.price_max = priceMax;

            let rentMin = $('#rent_min').val().replace(/,/g, '');
            if (rentMin) params.rent_min = rentMin;

            let rentMax = $('#rent_max').val().replace(/,/g, '');
            if (rentMax) params.rent_max = rentMax;

            let areaMin = $('#area_min').val();
            if (areaMin) params.area_min = areaMin;

            let areaMax = $('#area_max').val();
            if (areaMax) params.area_max = areaMax;

            let rooms = $('#rooms').val();
            if (rooms && rooms !== '0') params.rooms = rooms;

            let sort = $('#sortby').val();
            if (sort) params.sort = sort;

            return params;
        }

        function doSearch() {
            let params = collectFilters();
            let queryString = $.param(params);
            let url = '/special' + (queryString ? '?' + queryString : '');

            if (url === lastUrl) return;
            lastUrl = url;

            $('#properties-container').html(`
                <div class="col-12 text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-3 text-muted">در حال جستجو...</p>
                </div>
            `);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#properties-container').html(response.html);
                    $('#pagination-container').html(response.pagination);
                    $('#results-count').text(response.total + ' نتیجه یافت شد');
                    window.history.pushState({}, '', url);
                },
                error: function() {
                    $('#properties-container').html(`
                        <div class="col-12 alert alert-danger text-center">
                            خطا در جستجو.
                        </div>
                    `);
                }
            });
        }

        function debouncedSearch() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(doSearch, 400);
        }

        $('#q').on('keyup', debouncedSearch);

        $('.price-input').on('input', function() {
            let value = $(this).val().replace(/\D/g, '');
            $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, ','));
            debouncedSearch();
        });

        $('#area_min, #area_max').on('keyup', debouncedSearch);

        $('#city').on('change', function() {
            var cityId = $(this).val();
            var cityName = $(this).find('option:selected').data('city-name');
            var neighborhoodSelect = $('#neighborhood');

            neighborhoodSelect.prop('disabled', true);
            neighborhoodSelect.html('<option value="" disabled selected>در حال بارگذاری...</option>');

            if (cityId) {
                $.ajax({
                    url: '{{ route("get.neighborhoods") }}',
                    type: 'GET',
                    data: { city_id: cityId, city_name: cityName },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success && response.neighborhoods.length > 0) {
                            var options = '<option value="" selected>همه محله‌ها</option>';
                            $.each(response.neighborhoods, function(key, neighborhood) {
                                var selected = '{{ request("neighborhood") }}' === neighborhood.name ? 'selected' : '';
                                options += '<option value="' + neighborhood.name + '" ' + selected + '>' + neighborhood.name + '</option>';
                            });
                            neighborhoodSelect.html(options);
                            neighborhoodSelect.prop('disabled', false);
                        } else {
                            neighborhoodSelect.html('<option value="" selected>همه محله‌ها</option>');
                            neighborhoodSelect.prop('disabled', false);
                        }
                    },
                    error: function() {
                        neighborhoodSelect.html('<option value="" selected>همه محله‌ها</option>');
                        neighborhoodSelect.prop('disabled', false);
                    }
                });
            } else {
                neighborhoodSelect.html('<option value="" selected>همه محله‌ها</option>');
                neighborhoodSelect.prop('disabled', false);
            }

            lastUrl = '';
            doSearch();
        });

        if ($('#city').val()) {
            $('#city').trigger('change');
        }

        $('#neighborhood').on('change', function() {
            lastUrl = '';
            doSearch();
        });

        $('#category, #rooms').on('change', function() {
            lastUrl = '';
            doSearch();
        });

        $('#sortby').on('change', function() {
            lastUrl = '';
            doSearch();
        });

        $('#reset-filters').on('click', function() {
            window.location.href = '/special';
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            if (!url) return;

            $('#properties-container').html(`
                <div class="col-12 text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            `);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#properties-container').html(response.html);
                    $('#pagination-container').html(response.pagination);
                    window.history.pushState({}, '', url);
                    $('html, body').animate({ scrollTop: 0 }, 300);
                }
            });
        });

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
