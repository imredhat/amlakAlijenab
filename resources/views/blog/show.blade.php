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
                <li class="breadcrumb-item"><a href="{{ url('/blog') }}">وبلاگ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </nav>

        <!-- Post category -->
        @if($blog->category)
        <a class="nav-link d-inline-block fw-normal text-uppercase px-0 mb-2" href="{{ url('/blog?category='.$blog->category) }}">{{ $blog->category }}</a>
        @endif

        <!-- Post title -->
        <h1 class="h2 mb-4">{{ $blog->title }}</h1>

        <!-- Post meta -->
        <div class="mb-4 pb-1">
            <ul class="list-unstyled d-flex flex-wrap mb-0 text-nowrap">
                @if($blog->published_at)
                <li class="me-3"><i class="fi-calendar-alt me-2 mt-n1 opacity-60"></i>{{ verta($blog->published_at)->format('j F Y') }}</li>
                <li class="me-3 border-end"></li>
                @endif
                <li class="me-3"><i class="fi-eye me-2 mt-n1 opacity-60"></i>{{ $blog->views_count }} بازدید</li>
            </ul>
        </div>

        <!-- Post image -->
        @if($blog->image)
        <div class="mb-4 pb-md-3">
            <img class="rounded-3 w-100" src="{{ url('/') }}{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 500px; object-fit: cover;">
        </div>
        @endif

        <div class="row">
            <!-- Sharing sidebar -->
            <div class="col-lg-2 col-md-1 mb-md-0 mb-4 mt-md-n5">
                <div class="sticky-top py-md-5 mt-md-5">
                    <div class="d-flex flex-md-column align-items-center my-2 mt-md-4 pt-md-5">
                        <div class="d-md-none fw-bold text-nowrap me-2 pe-1">اشتراک گذاری</div>
                        <a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle mb-md-2 me-md-0 me-2"
                           href="https://t.me/share/url?url={{ urlencode(url('/blog/'.$blog->slug)) }}&text={{ urlencode($blog->title) }}"
                           target="_blank" data-bs-toggle="tooltip" title="اشتراک در تلگرام">
                            <i class="fi-telegram"></i>
                        </a>
                        <a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle mb-md-2 me-md-0 me-2"
                           href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . url('/blog/'.$blog->slug)) }}"
                           target="_blank" data-bs-toggle="tooltip" title="اشتراک در واتساپ">
                            <i class="fi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Post content -->
            <div class="col-lg-8 col-md-10">
                <!-- Summary -->
                @if($blog->summary)
                <h6 class="mb-3">{{ $blog->summary }}</h6>
                @endif

                <!-- Content -->
                <div class="blog-content mb-4" style="line-height: 2; font-size: 1rem;">
                    {!! $blog->content !!}
                </div>

                <!-- Tags -->
                @if(!empty($blog->tags) && count($blog->tags) > 0)
                <div class="d-flex align-items-center my-md-5 my-4 py-md-4 py-3 border-top">
                    <div class="fw-bold text-nowrap mb-2 me-2 pe-1">برچسب:</div>
                    <div class="d-flex flex-wrap">
                        @foreach($blog->tags as $tag)
                        <span class="btn btn-xs btn-outline-secondary rounded-pill fs-sm fw-normal me-2 mb-2">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Related posts -->
                @if($related->count() > 0)
                <div class="border-top pt-4 mt-4">
                    <h4 class="h5 mb-4">مقالات مرتبط</h4>
                    <div class="row row-cols-1 row-cols-sm-2 g-4">
                        @foreach($related as $item)
                        <div class="col">
                            <article class="d-flex align-items-start">
                                @if($item->image)
                                <a href="{{ url('/blog/'.$item->slug) }}" class="flex-shrink-0 me-3">
                                    <img class="rounded-3" src="{{ url('/') }}{{ $item->image }}" width="100" height="70" alt="{{ $item->title }}" style="object-fit: cover;">
                                </a>
                                @endif
                                <div>
                                    @if($item->category)
                                    <h6 class="mb-1 fs-xs fw-normal text-uppercase text-primary">{{ $item->category }}</h6>
                                    @endif
                                    <h5 class="mb-2 fs-base">
                                        <a class="nav-link" href="{{ url('/blog/'.$item->slug) }}">{{ Str::limit($item->title, 60) }}</a>
                                    </h5>
                                    @if($item->published_at)
                                    <a class="nav-link nav-link-muted d-inline-block me-3 p-0 fs-xs fw-normal" href="#">
                                        <i class="fi-calendar mt-n1 me-1 fs-sm align-middle opacity-70"></i>{{ verta($item->published_at)->format('j F') }}
                                    </a>
                                    @endif
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Back to blog -->
                <div class="border-top pt-4 mt-4">
                    <a href="{{ url('/blog') }}" class="btn btn-outline-primary">
                        <i class="fi-arrow-right me-1"></i>بازگشت به مجله
                    </a>
                </div>

                <!-- Comments Section -->
                <div class="border-top pt-4 mt-4">
                    <h4 class="h5 mb-4">نظرات ({{ $comments->count() }})</h4>

                    @if(session('comment_success'))
                    <div class="alert alert-success">{{ session('comment_success') }}</div>
                    @endif

                    @if($comments->count() > 0)
                        @foreach($comments as $comment)
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <strong>{{ $comment->name }}</strong>
                                       
                                    </div>
                                    <span style="direction: ltr;" class="text-muted fs-sm">{{ verta($comment->created_at)->format('Y/m/d H:i') }}</span>
                                </div>
                                <p class="mb-0">{{ $comment->message }}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted">هنوز نظری ثبت نشده است.</p>
                    @endif

                    <!-- Comment Form -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body">
                            <h5 class="mb-3">ثبت نظر</h5>
                            <form action="{{ url('/blog/'.$blog->slug.'/comment') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">نام <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required maxlength="255" placeholder="نام خود را وارد کنید">
                                        @error('name')
                                        <div class="text-danger fs-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">تلفن</label>
                                        <input type="text" name="tel" class="form-control" maxlength="20" placeholder="شماره تلفن (اختیاری)">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">پیام <span class="text-danger">*</span></label>
                                        <textarea name="message" class="form-control" rows="4" required maxlength="2000" placeholder="نظر خود را بنویسید..."></textarea>
                                        @error('message')
                                        <div class="text-danger fs-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fi-send me-1"></i>ارسال نظر
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('partials.home.footer')
</main>
