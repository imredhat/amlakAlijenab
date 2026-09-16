@include('partials.home.header')

<div class="page-loading active">
    <div class="page-loading-inner">
        <div class="page-spinner"></div><span>لطفا منتظر باشید</span>
    </div>
</div>

<main class="page-wrapper">
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

    <div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
        <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page">املاک ویژه</li>
            </ol>
        </nav>

        <div class="d-flex align-items-center justify-content-between pb-3 pb-sm-4">
            <h1 class="h4 mb-sm-0"><i class="fi-flame text-primary me-2"></i>املاک ویژه (نردبان)</h1>
        </div>

        @if($properties->count() > 0)
        <div class="row g-4 py-4">
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
        </div>

        @if($properties->hasPages())
        <nav class="border-top pb-md-4 pt-4 mt-2" aria-label="Pagination">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="text-muted small">
                    نمایش {{ $properties->firstItem() }} تا {{ $properties->lastItem() }} از {{ $properties->total() }} نتیجه
                </div>
                <div>
                    {{ $properties->links('pagination::persian') }}
                </div>
            </div>
        </nav>
        @endif

        @else
        <div class="text-center py-5">
            <i class="fi-flame fs-1 text-muted"></i>
            <p class="text-muted fs-5 mt-3">هنوز آگهی ویژه‌ای وجود ندارد.</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-2">مشاهده آگهی‌ها</a>
        </div>
        @endif
    </div>
</main>

@include('partials.home.footer')
