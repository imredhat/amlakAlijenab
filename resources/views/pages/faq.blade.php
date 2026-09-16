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


    <div class="container mt-5 mb-md-4 pt-5">
        <nav class="mb-3 pt-md-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page">سوالات متداول</li>
            </ol>
        </nav>
    </div>

    <!-- Page Header -->
    <section class="container mb-4 pb-lg-5">
        <h1 class="mx-auto mb-4 pb-2 text-center" style="max-width: 856px;">سوالات متداول</h1>
    </section>

    <!-- Main Content -->
    <section class="container mb-md-5 mb-4 pb-lg-5">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-xl-2 col-lg-3">
                <div class="offcanvas-lg offcanvas-end" id="help-sidebar">
                    <div class="offcanvas-header shadow-sm mb-2">
                        <h2 class="h5 mb-0">دسته‌بندی سوالات</h2>
                        <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#help-sidebar"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="nav nav-tabs navbar-nav flex-column m-0 text-lg-center" id="faq-tabs">
                            @php
                                $categories = \App\Models\FAQ::select('category')
                                    ->groupBy('category') 
                                    ->pluck('category');
                            @endphp
                            @foreach($categories as $cat)
                                <li class="nav-item px-0">
                                    <a class="nav-link px-3 {{ $loop->first ? 'active' : '' }}" 
                                       href="#{{ str_replace(' ', '-', $cat) }}" 
                                       data-bs-toggle="tab">
                                        {{ $cat ?? 'سایر سوالات' }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </aside>

            <!-- Content Area -->
            <div class="col-lg-9 offset-xl-1 col-lg-8">
                <div class="tab-content" id="faq-tab-content">
                    @foreach($categories as $category)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                             id="{{ str_replace(' ', '-', $category) }}">
                            
                            <h2 class="mb-md-4 mb-3 pb-md-2">{{ $category ?? 'سایر سوالات' }}</h2>
                            
                            @php
                                $faqs = \App\Models\FAQ::where('category', $category)->get();
                            @endphp

                            @forelse($faqs as $faq)
                                <div class="pb-md-4 mb-4 border-bottom">
                                    <h3 class="h5 mb-3">{{ $faq->question }}</h3>
                                    <div class="faq-answer">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">در این دسته سوالی ثبت نشده است.</p>
                            @endforelse
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="container mb-5 pb-lg-5">
        <div class="row align-items-sm-center">
            <div class="col-sm-5">
                <img src="{{ url('/') }}/img/real-estate/illustrations/support.svg" 
                     alt="Illustration" class="rotate-img">
            </div>
            <div class="col-md-6 offset-md-1 col-sm-7 text-sm-end text-center">
                <h2 class="mb-4 pb-md-3">چیزی را که به دنبالش هستید پیدا نمی‌کنید؟</h2>
                <a class="btn btn-lg btn-primary" href="{{ url('/page/contact') }}">
                    اکنون با ما تماس بگیرید!
                </a>
            </div>
        </div>
    </section>

</main>

@include('partials.home.footer')