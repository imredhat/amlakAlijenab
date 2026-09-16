@include('partials.home.header')

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

    <!-- Navbar-->
    @include('partials.home.menu')

    <main class="page-wrapper">
        <div class="container mt-5 pt-5 px-3 px-xl-4 px-xxl-5">

            <!-- Breadcrumb -->
            <nav class="mb-3 pt-md-2" aria-label="Breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? '' }}</li>
                </ol>
            </nav>

            <!-- عنوان صفحه -->
            <div class="d-flex align-items-center justify-content-between pb-3 pb-sm-4">
                <h1 class="h4 mb-sm-0">{{ $pageTitle ?? '' }}</h1>
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
    </main>

    <script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function applySort() {
                var params = {};
                var sort = $('#sortby').val();
                if (sort) params.sort = sort;

                var url = window.location.pathname;
                var queryString = $.param(params, true);
                if (queryString) url += '?' + queryString;

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#properties-container').css('opacity', '0.5');
                    },
                    success: function(response) {
                        $('#properties-container').html(response.html).css('opacity', '1');
                        $('#results-count').text(response.total + ' نتیجه یافت شد');
                        window.history.pushState({}, '', url);
                    },
                    error: function() {
                        $('#properties-container').css('opacity', '1');
                    }
                });
            }

            $(document).on('change', '#sortby', function() {
                applySort();
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
                        window.history.pushState({}, '', url);
                        $('html, body').animate({ scrollTop: 0 }, 300);
                    }
                });
            });
        });
    </script>
    @include('partials.home.footer')

    <style>
        .page-link-static { cursor: default; }
    </style>
