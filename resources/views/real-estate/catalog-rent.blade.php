@include('partials.header')
@include('partials.home.menu')

<!-- Page container -->
<main class="page-wrapper">

    <div class="container mt-5 mb-md-4 py-5">
        <div class="row">

            <!-- Breadcrumb -->
            <nav class="mb-3 pt-md-2" aria-label="Breadcrumb">
                <ol class="breadcrumb">

                </ol>
            </nav>

            <aside class="col-lg-4 col-xl-4 pe-xl-4 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 mb-0">جستجوی پیشرفته</h2>
                    <button class="btn btn-sm btn-outline-secondary d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#filters-collapse">
                        <i class="fi-filter"></i> فیلترها
                    </button>
                </div>

                <div class="collapse d-lg-block" id="filters-collapse">


                    <div class="card border-0 shadow-sm p-4 mb-4">
                        <h3 class="h6 mb-3"><i class="fi-cash"></i> محدوده قیمت</h3>
                        <div class="mb-3">
                            <label class="form-label">حداقل قیمت</label>
                            <input type="text" class="form-control price-input" id="min-price" placeholder="0 تومان">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">حداکثر قیمت</label>
                            <input type="text" class="form-control price-input" id="max-price" placeholder="نامحدود">
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm p-4 mb-4">
                        <h3 class="h6 mb-3"><i class="fi-home"></i> مشخصات ملک</h3>
                        <div class="mb-3">
                            <label class="form-label">حداقل متراژ</label>
                            <input type="number" class="form-control" id="min-area" placeholder="متر مربع">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تعداد اتاق</label>
                            <select class="form-select" id="rooms">
                                <option value="">هر تعداد</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4+</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100" id="apply-filters">
                        <i class="fi-filter"></i> اعمال فیلترها
                    </button>
                </div>
            </aside>

            <!-- Main content -->
            <div class="col-lg-8 col-xl-8">

                <!-- Header -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-2">
                            آپارتمان برای اجاره 
                        </h1>
                        <p class="text-muted mb-0">
                            <i class="fi-map-pin"></i>
                            {{ $properties->total() }} آگهی در این دسته
                        </p>
                    </div>

                    <div class="d-flex gap-2 mt-3 mt-sm-0">
                      

                        <select class="form-select form-select-sm w-auto" id="sort-by">
                            <option value="newest">جدیدترین</option>
                            <option value="price_asc">ارزان‌ترین</option>
                            <option value="price_desc">گران‌ترین</option>
                            <option value="area_asc">کوچک‌ترین متراژ</option>
                            <option value="area_desc">بزرگ‌ترین متراژ</option>
                        </select>
                    </div>
                </div>

                <!-- Properties list -->
                <div id="properties-container">
                    <!-- لیست املاک -->
                    <div id="properties-container" class="row g-4 py-4">
                        <?php
                        function getCat($type)
                        {
                            switch ($type) {
                                case 'other':
                                    return "سایر";
                                    break;
                                case 'pre-sale':
                                    return "پیش فروش";
                                    break;
                                case 'villa-sale':
                                    return "خرید و فروش ویلا";
                                    break;
                                case 'apartment-rent':
                                    return "رهن و اجاره خانه و آپارتمان";
                                    break;
                                case 'apartment-sale':
                                    return "خرید و فروش خانه و آپارتمان";
                                    break;
                                case 'villa-short-rent':
                                    return "اجاره کوتاه مدت ویلا، سوئیت";
                                    break;
                                case 'commercial-rent':
                                    return "رهن و اجاره اداری، تجاری و صنعتی";
                                    break;
                                case 'commercial-sale':
                                    return "خرید و فروش اداری، تجاری و صنعتی";
                                    break;
                                case 'land':
                                    return "زمین و باغ";
                                    break;
                                case 'pre-sale':
                                    return "پیش فروش و مشارکت در ساخت";
                                    break;

                                default:
                                    break;
                            }
                        }
                        ?>


                        @if(isset($properties))
                        @foreach($properties as $p)



                        <?php
                        $media = [""];
                        $cat = $properties[0]->category;
                        if (isset($p->media) && count(json_decode($p->media)) > 0) {
                            $media = json_decode($p->media);
                        }

                        ?>

                        @include("peroperty.vendor.".$cat)

                        @endforeach

                        @else

                        <div class="col-12 text-center py-5">
                            <p class="text-muted fs-5">هنوز هیچ آگهی ثبت نشده است.</p>
                        </div>
                        @endif

                    </div>

                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4" id="pagination-container">
                    {{ $properties->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentSlug = 'rent';
            let currentType = 'rent';

            function loadProperties() {
                let minPrice = $('#min-price').val().replace(/,/g, '');
                let maxPrice = $('#max-price').val().replace(/,/g, '');
                let minArea = $('#min-area').val();
                let rooms = $('#rooms').val();
                let city = $('#city-filter').val();
                let province = $('#province-filter').val();
                let neighborhood = $('#neighborhood-filter').val();
                let sort = $('#sort-by').val();

                let url = `/property/type/${currentSlug}/?`;

                if (minPrice) url += `&min_price=${minPrice}`;
                if (maxPrice) url += `&max_price=${maxPrice}`;
                if (minArea) url += `&min_area=${minArea}`;
                if (rooms) url += `&rooms=${rooms}`;
                if (city) url += `&city=${city}`;
                if (province) url += `&province=${province}`;
                if (neighborhood) url += `&neighborhood=${neighborhood}`;
                if (sort) url += `&sort=${sort}`;

                $('#properties-container').html(`
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">در حال بارگذاری...</span>
                </div>
                <p class="mt-3 text-muted">در حال بارگذاری آگهی‌ها...</p>
            </div>
        `);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#properties-container').html(response.html);
                        if (response.total > 0) {
                            // صفحه‌بندی را دوباره راه‌اندازی کنید
                            attachPaginationEvents();
                        } else {
                            $('#properties-container').html(`
                        <div class="text-center py-5">
                            <i class="fi-folder-open fs-1 text-muted"></i>
                            <p class="mt-3 text-muted">هیچ آگهی‌ای یافت نشد</p>
                        </div>
                    `);
                            $('#pagination-container').empty();
                        }
                    },
                    error: function() {
                        $('#properties-container').html(`
                    <div class="alert alert-danger text-center">
                        خطا در بارگذاری آگهی‌ها. لطفاً دوباره تلاش کنید.
                    </div>
                `);
                    }
                });
            }

            function attachPaginationEvents() {
                $('.pagination a').off('click').on('click', function(e) {
                    e.preventDefault();
                    let url = $(this).attr('href');
                    if (url) {
                        $('#properties-container').html(`
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                `);

                        $.ajax({
                            url: url,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                $('#properties-container').html(response.html);
                                attachPaginationEvents();
                                $('html, body').animate({
                                    scrollTop: 0
                                }, 300);
                            }
                        });
                    }
                });
            }

            // رویدادها
            $('#apply-filters').on('click', loadProperties);
            $('#sort-by').on('change', loadProperties);

            // فرمت قیمت
            $('.price-input').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, ','));
            });

            // بارگذاری اولیه
            attachPaginationEvents();
        });
    </script>

    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .pagination {
            gap: 5px;
        }

        .page-link {
            border-radius: 8px;
            padding: 8px 14px;
        }

        @media (max-width: 768px) {
            .page-link {
                padding: 6px 10px;
                font-size: 12px;
            }
        }
    </style>

    @include('partials.footer')