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

    <!-- Page container -->
    <div class="container mt-5 mb-md-4 py-5">
        <!-- Breadcrumb -->
        <nav class="mb-3 pt-md-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page">مقالات</li>
            </ol>
        </nav>

        <!-- Page title -->
        <h1 class="h3 d-flex align-items-end justify-content-between mb-4">اخبار املاک</h1>

        <!-- Search bar + filters -->
        <div class="row gy-3 mb-4 pb-2">
            <div class="col-md-4 order-md-1 order-2">
                <div class="position-relative">
                    <form action="{{ url('/blog') }}" method="GET">
                        <input class="form-control pe-5" type="text" name="q" placeholder="جستجو مقاله براساس کلمات کلیدی" value="{{ request('q') }}">
                        <i class="fi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-8 offset-lg-2 order-md-2 order-1">
                <div class="row gy-3">
                    <div class="col-6 d-flex flex-sm-row flex-column align-items-sm-center">
                        <label class="d-inline-block ms-sm-2 mb-sm-0 mb-2 text-nowrap" for="categories">
                            <i class="fi-align-left fi-rotate mt-n1 me-2 align-middle opacity-70"></i>دسته بندی:
                        </label>
                        <select class="form-select" id="categories" onchange="window.location.href='{{ url('/blog') }}?category='+this.value">
                            <option value="">همه</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 d-flex flex-sm-row flex-column align-items-sm-center">
                        <label class="d-inline-block m-sm-2 mb-sm-0 mb-2 text-nowrap" for="sortby">
                            <i class="fi-arrows-sort mt-n1 me-2 align-middle opacity-70"></i>مرتب سازی براساس:
                        </label>
                        <select class="form-select" id="sortby">
                            <option value="newest">جدیدترین</option>
                            <option value="oldest">قدیمی ترین</option>
                            <option value="most_viewed">پربازدید</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles grid -->
        @if($blogs->count() > 0)
        <div class="row row-cols-md-2 row-cols-1 gy-md-5 gy-4 mb-lg-5 mb-4 blog-list">
            @foreach($blogs as $blog)
            <article class="col pb-2 pb-md-1">
                @if($blog->image)
                <a class="d-block position-relative mb-3" href="{{ url('/blog/'.$blog->slug) }}">
                    @if($loop->first)
                    <span class="badge bg-info position-absolute top-0 start-0 m-3 fs-sm">جدید</span>
                    @endif
                    <img class="d-block rounded-3 w-100" src="{{ url('/') }}{{ $blog->image }}" alt="{{ $blog->title }}" style="height: 220px; object-fit: cover;">
                </a>
                @endif
                @if($blog->category)
                <a class="fs-sm text-uppercase text-decoration-none" href="{{ url('/blog?category='.$blog->category) }}">{{ $blog->category }}</a>
                @endif
                <h3 class="h5 mb-2 pt-1">
                    <a class="nav-link" href="{{ url('/blog/'.$blog->slug) }}">{{ $blog->title }}</a>
                </h3>
                @if($blog->summary)
                <p class="mb-3">{{ Str::limit($blog->summary, 150) }}</p>
                @endif
                <div class="d-flex text-body fs-sm">
                    @if($blog->published_at)
                    <span class="me-2 pe-1"><i class="fi-calendar-alt opacity-70 mt-n1 me-1 align-middle"></i>{{ verta($blog->published_at)->format('j F') }}</span>
                    @endif
                    <span><i class="fi-eye opacity-70 mt-n1 me-1 align-middle"></i>{{ $blog->views_count }} بازدید</span>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <nav class="pt-4 pb-2 border-top" aria-label="Blog pagination">
            {{ $blogs->withQueryString()->links('pagination::persian') }}
        </nav>

        @else
        <div class="text-center py-5">
            <i class="fi-file-empty fs-1 text-muted mb-3 d-block"></i>
            <h5 class="text-muted">مقاله‌ای یافت نشد</h5>
            <p class="text-muted">هنوز مقاله‌ای منتشر نشده است.</p>
        </div>
        @endif
    </div>

@include('partials.home.footer')
</main>
