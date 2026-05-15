
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

    <!-- Breadcrumb -->
    <div class="container mt-5 mb-md-4 pt-5">
        <nav class="mb-3 pt-md-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page">درباره ما</li>
            </ol>
        </nav>
    </div>

    {{-- ===== بخش هرو ===== --}}
    <section class="container mb-5 pb-2">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-4 col-md-5 col-sm-9 order-md-1 order-2 text-md-start text-center">
                <h1 class="mb-4">{{ $about->hero_title ?? 'درباره سایت' }}</h1>
                <p class="mb-4 pb-3 fs-lg">{{ $about->hero_description ?? '' }}</p>
                @if(!empty($about->hero_button_text))
                    <a class="btn btn-lg btn-primary" href="{{ $about->hero_button_link ?? '#' }}">
                        {{ $about->hero_button_text }}
                    </a>
                @endif
            </div>

            <div class="col-lg-7 col-md-6 offset-md-1 col-12 order-md-2 order-1">
                @php $heroImages = $about->hero_images ?? []; @endphp
                @if(count($heroImages) > 0)
                    <div class="tns-carousel-wrapper tns-controls-static tns-nav-outside">
                        <div class="tns-carousel-inner" data-carousel-options='{"loop": true, "gutter": 16}'>
                            @foreach($heroImages as $img)
                                <div><img class="rounded-3 w-100" src="{{ url('/') }}{{ $img }}" alt="{{ $about->hero_title ?? '' }}"></div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <img class="rounded-3 w-100" src="{{ url('/') }}/img/real-estate/about/hero/01.jpg" alt="{{ $about->hero_title ?? '' }}">
                @endif
            </div>
        </div>
    </section>

    {{-- ===== دلایل انتخاب ===== --}}
    @php $whyItems = $about->why_items ?? []; @endphp
    @if(count($whyItems) > 0)
    <section class="container mb-2 mb-xl-5 pb-lg-4">
        <h2 class="h3 mb-4">{{ $about->why_title ?? 'دلیل انتخاب شرکت ما' }}</h2>
        <div class="tns-carousel-wrapper tns-nav-outside">
            <div class="tns-carousel-inner" data-carousel-options='{"loop": false, "controls": false, "responsive": {"0":{"items":1,"gutter":16},"500":{"items":2,"gutter":20},"768":{"items":3,"gutter":24}}}'>
                @foreach($whyItems as $item)
                    <div>
                        <div class="card border-0">
                            <div class="card-body">
                                @if(!empty($item['icon_svg']))
                                    <div class="mb-3">{!! $item['icon_svg'] !!}</div>
                                @else
                                    <i class="fi-star fs-2 text-primary mb-3 d-block"></i>
                                @endif
                                <h3 class="h5 card-title pb-1">{{ $item['title'] ?? '' }}</h3>
                                <p class="card-text">{{ $item['description'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== مراحل همکاری ===== --}}
    @php $stepsItems = $about->steps_items ?? []; @endphp
    @if(count($stepsItems) > 0)
    <section class="container mb-5 pb-2 pb-lg-4">
        <div class="row gy-4">
            <div class="col-md-5 col-12">
                @if(!empty($about->steps_image))
                    <img class="d-block mx-auto rotate-img img-fluid" src="{{ url('/') }}{{ $about->steps_image }}" alt="مراحل همکاری">
                @else
                    <img class="d-block mx-auto rotate-img" src="{{ url('/') }}/img/real-estate/illustrations/find.svg" alt="مراحل">
                @endif
            </div>
            <div class="col-lg-6 offset-lg-1 col-md-7 col-12">
                <h2 class="h3 mb-lg-5 mb-sm-4">{{ $about->steps_title ?? 'روند همکاری مشاوران املاک' }}</h2>
                <div class="steps steps-vertical">
                    @foreach($stepsItems as $step)
                        <div class="step active">
                            <div class="step-progress">
                                <span class="step-number">{{ $step['number'] ?? ($loop->index + 1) }}</span>
                            </div>
                            <div class="step-label me-4">
                                <h3 class="h5 mb-2 pb-1">{{ $step['title'] ?? '' }}</h3>
                                <p class="mb-0">{{ $step['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===== تیم ===== --}}
    @php $teamMembers = $about->team_members ?? []; @endphp
    @if(count($teamMembers) > 0)
    <section class="container mb-5 pb-2 pb-lg-4">
        <div class="d-flex align-items-end justify-content-sm-between justify-content-center mb-3">
            <h2 class="h3 mb-0 text-sm-start text-center">
                {{ $about->team_title ?? 'مشاوران با تجربه سایت املاک' }}
            </h2>
        </div>
        <div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush mx-n2">
            <div class="tns-carousel-inner row gx-4 mx-0 pt-3 pb-4"
                data-carousel-options='{"responsive":{"0":{"items":1},"500":{"items":2},"768":{"items":3},"992":{"items":4,"nav":false}}}'>
                @foreach($teamMembers as $index => $member)
                    <div class="col">
                        <div class="card border-0 shadow-sm {{ $index % 2 == 0 ? 'mt-md-4' : '' }}">
                            @if(!empty($member['photo']))
                                <img class="card-img-top" src="{{ url('/') }}{{ $member['photo'] }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    style="height:220px;object-fit:cover;">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height:220px;">
                                    <i class="fi-user fs-1 text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body text-center">
                                <h3 class="h5 card-title mb-2">{{ $member['name'] ?? '' }}</h3>
                                <span class="d-inline-block mb-3 fs-sm">{{ $member['role'] ?? '' }}</span>
                                <div class="pt-1">
                                    @if(!empty($member['facebook']))
                                        <a class="btn btn-icon btn-light-primary btn-xs rounded-circle shadow-sm mx-2"
                                            href="https://facebook.com/{{ $member['facebook'] }}">
                                            <i class="fi-facebook"></i>
                                        </a>
                                    @endif
                                    @if(!empty($member['twitter']))
                                        <a class="btn btn-icon btn-light-primary btn-xs rounded-circle shadow-sm mx-2"
                                            href="https://twitter.com/{{ $member['twitter'] }}">
                                            <i class="fi-twitter"></i>
                                        </a>
                                    @endif
                                    @if(!empty($member['instagram']))
                                        <a class="btn btn-icon btn-light-primary btn-xs rounded-circle shadow-sm mx-2"
                                            href="https://instagram.com/{{ $member['instagram'] }}">
                                            <i class="fi-instagram"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== نظرات مشتریان ===== --}}
    @php $testimonials = $about->testimonials ?? []; @endphp
    @if(count($testimonials) > 0)
    <section class="container mb-5 pb-xl-5 pb-md-2">
        <h2 class="h3 mb-3 text-center">{{ $about->testimonials_title ?? 'نظرات مشتریان' }}</h2>
        <div class="tns-carousel-wrapper tns-controls-outside-lg tns-nav-outside tns-nav-outside-flush col-lg-10 mx-auto px-0">
            <div class="tns-carousel-inner" data-carousel-options='{"gutter":24}'>
                @foreach($testimonials as $t)
                    <div class="d-flex flex-md-row flex-column align-items-md-start mx-3 py-3">
                        @if(!empty($t['logo']))
                            <img class="d-md-block d-none ms-4 rounded-3"
                                src="{{ url('/') }}{{ $t['logo'] }}" width="306" alt="{{ $t['company'] ?? '' }}">
                        @endif
                        <div class="card border-0 shadow-sm h-100">
                            <blockquote class="blockquote card-body">
                                <p>{{ $t['text'] ?? '' }}</p>
                                <footer class="d-flex align-items-center">
                                    <div class="pe-3">
                                        <h6 class="fs-base mb-0">{{ $t['company'] ?? '' }}</h6>
                                        <div class="text-muted fw-normal fs-sm">
                                            {{ $t['person_name'] ?? '' }}، {{ $t['person_role'] ?? '' }}
                                        </div>
                                    </div>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== CTA ===== --}}
    @if(!empty($about->cta_title))
    <section class="container mb-5 pb-sm-3 pb-lg-4">
        <div class="bg-secondary rounded-3">
            <div class="col-md-11 col-12 offset-md-1 p-md-0 p-2 d-flex align-items-center justify-content-between">
                <div class="me-md-5 py-md-5 px-md-0 p-4" style="max-width:526px;">
                    <h2 class="mb-md-4">{{ $about->cta_title }}</h2>
                    <p class="mb-4 pb-md-3 fs-lg">{{ $about->cta_description ?? '' }}</p>
                    @if(!empty($about->cta_button_text))
                        <a class="btn btn-lg btn-primary" href="{{ $about->cta_button_link ?? '#' }}">
                            <i class="fi-search me-2"></i>{{ $about->cta_button_text }}
                        </a>
                    @endif
                </div>
                @if(!empty($about->cta_image))
                    <div class="col-4 d-md-block d-none align-self-end px-0">
                        <img class="mt-n5 img-fluid" src="{{ url('/') }}{{ $about->cta_image }}" alt="">
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif

</main>

      @include('partials.home.footer')