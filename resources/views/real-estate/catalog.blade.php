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

                <!-- Sidebar فیلترها (Offcanvas در موبایل) -->
                <aside class="col-lg-4 col-xl-3 border-top-lg border-end-lg shadow-sm px-3 px-xl-4 px-xxl-5 pt-lg-2">
                    <div class="offcanvas-lg offcanvas-end" id="filters-sidebar">
                        <div class="offcanvas-header d-flex d-lg-none align-items-center">
                            <h2 class="h5 mb-0">فیلتر جستجو</h2>
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#filters-sidebar"></button>
                        </div>

                        <!-- تب اجاره / فروش -->
                        <div class="offcanvas-header d-block border-bottom pt-0 pt-lg-4 px-lg-0">
                            <ul class="nav nav-tabs mb-0">
                                <li class="nav-item">
                                    <a class="nav-link {{ request('type') === 'rent' ? 'active' : '' }}"
                                        href="{{ route('catalog', ['type' => 'rent']) }}">
                                        <i class="fi-rent fs-base me-2"></i>برای اجاره
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request('type') !== 'rent' ? 'active' : '' }}"
                                        href="{{ route('catalog', ['type' => 'sale']) }}">
                                        <i class="fi-home fs-base me-2"></i>برای فروش
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="offcanvas-body py-lg-4">
                            @include('partials.properties.filters')
                        </div>
                    </div>
                </aside>

                <!-- محتوای اصلی صفحه -->
                <div class="col-lg-8 col-xl-9 position-relative overflow-hidden pb-5 pt-4 px-3 px-xl-4 px-xxl-5">
                    <div class="map-popup invisible" id="map">
                        <button class="btn btn-icon btn-light btn-sm shadow-sm rounded-circle" type="button" data-bs-toggle-class="invisible" data-bs-target="#map">
                            <i class="fi-x fs-xs"></i>
                        </button>
                        <div class="interactive-map"></div>
                    </div>

                    <!-- Breadcrumb -->
                    <nav class="mb-3 pt-md-2" aria-label="Breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ request('type') === 'rent' ? 'ملک برای اجاره' : 'ملک برای فروش' }}
                            </li>
                        </ol>
                    </nav>

                    <!-- عنوان صفحه -->
                    <div class="d-sm-flex align-items-center justify-content-between pb-3 pb-sm-4">
                        <h1 class="h4 mb-sm-0">
                            لیست املاک @if(request('type') === 'rent') برای اجاره @else برای فروش @endif
                        </h1>
                        <a class="d-inline-block fw-bold text-decoration-none py-1" href="#" data-bs-toggle-class="invisible" data-bs-target="#map">
                            <i class="fi-map me-2"></i>مشاهده نقشه
                        </a>
                    </div>

                    <!-- مرتب‌سازی + تعداد نتایج -->
                    <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch my-2">
                        <div class="d-flex align-items-center flex-shrink-0">
                            <label class="fs-sm me-2 pe-1 text-nowrap" for="sortby">
                                <i class="fi-arrows-sort text-muted mt-n1 me-2"></i>مرتب سازی براساس:
                            </label>
                            <select class="form-select form-select-sm" id="sortby">
                                <option value="newest" selected>جدیدترین</option>
                                <option value="price_high">قیمت بالا</option>
                                <option value="price_low">قیمت پایین</option>
                                <option value="most_viewed">پربازدیدترین</option>
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
                        $cat = $p->category;
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

                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {

                $('#sortby').on('change', function() {
                    let sort = $(this).val();

                    $.ajax({
                        url: "{{ route('catalog') }}",
                        method: 'GET',
                        data: {
                            type: "{{ request('type', 'sale') }}",
                            sort: sort,
                            // سایر فیلترها بعداً اضافه می‌شوند
                        },
                        success: function(response) {
                            $('#properties-container').html(response.html);
                            $('#results-count').text(response.total + ' نتیجه یافت شد');
                        }
                    });
                });

            });
        </script>
        @include('partials.home.footer')