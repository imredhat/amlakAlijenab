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





  <!-- Hero-->
  <section class="container pt-5 my-5 pb-lg-4">
    <div class="row pt-0 pt-md-2 pt-lg-0">
      <div class="col-xl-7 col-lg-6 col-md-5 order-md-2 mb-4 mb-lg-3"><img src="{{url('/')}}{{$header[0]['pic']}}" alt="{{$header[0]['title']}}"></div>
      <div class="col-xl-5 col-lg-6 col-md-7 order-md-1 pt-xl-5 pe-lg-0 mb-3 text-md-start text-center">
        <h1 class="display-4 mt-lg-5 mb-md-4 mb-3 pt-md-4 pb-lg-2">{{$header[0]['title']}}</h1>
        <p class="position-relative lead ms-lg-n5 fs-6">{{$header[0]['desc']}}</p>
      </div>
      <!-- Search property form group-->
      <div class="col-xl-8 col-lg-10 order-3 mt-lg-n5" style="z-index: 9">
        <form class="form-group d-block panel-search">
          <div class="row g-0 ms-sm-n2">
            <div class="col-md-8 d-sm-flex align-items-center">
              <div class="dropdown w-sm-50 border-end-sm" data-bs-toggle="select">
                <button class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button" data-bs-toggle="dropdown"><i class="fi-home me-2"></i><span class="dropdown-toggle-label">اجاره</span></button>
                <input type="hidden">
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" data-type="rent"><span class="dropdown-item-label">اجاره</span></a></li>
                  <li><a class="dropdown-item" data-type="sale"><span class="dropdown-item-label">فروش</span></a></li>
                </ul>
              </div>
              <hr class="d-sm-none my-2">
              <div class="dropdown w-sm-50 border-end-sm" data-bs-toggle="select">
                <button class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button" data-bs-toggle="dropdown"><i class="fi-map-pin me-2"></i><span class="dropdown-toggle-label">موقعیت</span></button>
                <input type="hidden">
                <ul class="dropdown-menu">
                  @foreach ($city as $c)
                  <li><a class="dropdown-item"><span class="dropdown-item-label">{{ $c -> name }}</span></a></li>
                  @endforeach
                </ul>
              </div>
              <hr class="d-sm-none my-2">
              <div class="dropdown w-sm-50 border-end-md" data-bs-toggle="select">
                <button class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button" data-bs-toggle="dropdown"><i class="fi-list me-2"></i><span class="dropdown-toggle-label">نوع ملک</span></button>
                <input type="hidden">
                <ul class="dropdown-menu">
                  <li><a data-type="apartment" class="dropdown-item"><span class="dropdown-item-label">آپارتمان</span></a></li>
                  <li><a data-type="commercial" class="dropdown-item"><span class="dropdown-item-label">تجاری و اداری</span></a></li>
                  <li><a data-type="villa" class="dropdown-item"><span class="dropdown-item-label">ویلا و سوئیت</span></a></li>
                  <li><a data-type="land" class="dropdown-item"><span class="dropdown-item-label">زمین</span></a></li>
                  <li><a data-type="pre-sale" class="dropdown-item"><span class="dropdown-item-label">پیش فروش</span></a></li>
                  <li><a data-type="other" class="dropdown-item"><span class="dropdown-item-label">سایر</span></a></li>



                </ul>
              </div>
            </div>
            <hr class="d-md-none mt-2">
            <div class="col-md-4 d-sm-flex align-items-center pt-4 pt-md-0">
              <div class="d-flex align-items-center w-100 pt-2 pb-4 py-sm-0 ps-2 ps-sm-3"><i class="fi-cash fs-lg text-muted me-2"></i><span class="text-muted me-2">قیمت</span>
                <div class="range-slider ps-0" data-start-min="450" data-min="0" data-max="1000" data-dirction="rtl" data-step="1">
                  <div class="range-slider-ui"></div>
                  <input class="form-control range-slider-value-min" type="hidden">
                </div>
              </div>
              <button class="btn btn-icon btn-primary px-3 w-100 w-sm-auto flex-shrink-0" type="button"><i class="fi-search"></i><span class="d-sm-none d-inline-block ms-2"> جستجو</span></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- Property categories-->
  <section class="container mb-5">
    <div class="row row-cols-lg-6 row-cols-sm-3 row-cols-2 g-3 g-xl-4">

      <div class="col"><a class="icon-box card card-body h-100 border-0 shadow-sm card-hover h-100 text-center" href="{{ url('/') }}/browse/apartment">
          <div class="icon-box-media bg-faded-primary text-primary rounded-circle mb-3 mx-auto"><i class="fi-apartment"></i></div>
          <h3 class="icon-box-title fs-base mb-0">آپارتمان</h3>
        </a></div>
      <div class="col"><a class="icon-box card card-body h-100 border-0 shadow-sm card-hover h-100 text-center" href="{{ url('/') }}/browse/commercial">
          <div class="icon-box-media bg-faded-primary text-primary rounded-circle mb-3 mx-auto"><i class="fi-shop"></i></div>
          <h3 class="icon-box-title fs-base mb-0">تجاری و اداری</h3>
        </a></div>

      <div class="col"><a class="icon-box card card-body h-100 border-0 shadow-sm card-hover h-100 text-center" href="{{ url('/') }}/browse/villa">
          <div class="icon-box-media bg-faded-primary text-primary rounded-circle mb-3 mx-auto"><i class="fi-real-estate-house"></i></div>
          <h3 class="icon-box-title fs-base mb-0">ویلا</h3>
        </a></div>

      <div class="col"><a class="icon-box card card-body h-100 border-0 shadow-sm card-hover h-100 text-center" href="{{ url('/') }}/browse/land">
          <div class="icon-box-media bg-faded-primary text-primary rounded-circle mb-3 mx-auto"><i class="fi-map"></i></div>
          <h3 class="icon-box-title fs-base mb-0">زمین</h3>
        </a></div>

        <div class="col"><a class="icon-box card card-body h-100 border-0 shadow-sm card-hover h-100 text-center" href="{{ url('/') }}/browse/pre-sale">
          <div class="icon-box-media bg-faded-primary text-primary rounded-circle mb-3 mx-auto"><i class="fi-pre-sale"></i></div>
          <h3 class="icon-box-title fs-base mb-0">پیش فروش</h3>
        </a></div>


      <div class="col">
        <div class="dropdown h-100"><a class="icon-box card card-body h-100 border-0 shadow-sm card-hover text-center" href="real-estate-home-v1.html#" data-bs-toggle="dropdown">
            <div class="icon-box-media bg-faded-primary text-primary rounded-circle mb-3 mx-auto"><i class="fi-dots-horisontal"></i></div>
            <h3 class="icon-box-title fs-base mb-0">سایر</h3>
          </a>
          <div class="dropdown-menu dropdown-menu-end my-1"><a class="dropdown-item" href="real-estate-catalog-sale.html"><i class="fi-single-bed fs-base opacity-60 me-2"></i>سوئیت</a><a class="dropdown-item" href="real-estate-catalog-rent.html"><i class="fi-computer fs-base opacity-60 me-2"></i>دفتر کار</a><a class="dropdown-item" href="real-estate-catalog-sale.html"><i class="fi-real-estate-buy fs-base opacity-60 me-2"></i>زمین</a><a class="dropdown-item" href="real-estate-catalog-rent.html"><i class="fi-parking fs-base opacity-60 me-2"></i>خانه حیاط دار</a></div>
        </div>
      </div>
    </div>
  </section>
  <!-- Services-->
  <section class="container mb-5 mt-n3 mt-lg-0">
    <div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush mx-n2" dir="ltr">
      <div class="tns-carousel-inner row gx-4 mx-0 py-3" data-carousel-options="{&quot;items&quot;: 3, &quot;controls&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}}}">

        @if(isset($catalog))
        @foreach($catalog as $c)
        <div class="col">
          <div class="card card-hover border-0 h-100 pb-2 pb-sm-3 px-sm-3 text-center"><img class="d-block mx-auto my-3" src="{{url('/')}}{{$c -> pic}}" width="256" alt="Illustration">
            <div class="card-body">
              <h2 class="h5 card-title">{{$c -> title}}</h2>
              <p class="card-text fs-sm">{{$c -> desc}}</p>
            </div>
            <div class="card-footer pt-0 border-0"><a class="btn btn-outline-primary stretched-link" href="{{$c -> link}}">{{$c -> link_title}}</a></div>
          </div>

        </div>
        @endforeach;
        @endif;



      </div>
    </div>
  </section>
  <hr class="mt-n1 mb-5 d-md-none">
  <!-- Top offers (carousel)-->


  @include('partials.home.recent')



  <!-- Recently added-->





  @if(isset($special))
  <section class="container pb-4 pt-1 mb-5">
    <div class="d-flex align-items-end align-items-lg-center justify-content-between mb-4 pb-md-2">
      <div class="d-flex w-100 align-items-center justify-content-between justify-content-lg-start">
        <h2 class="h3 mb-0 me-md-4 ">ملک های جدید اضافه شده</h2>
        <div class="dropdown d-md-none" data-bs-toggle="select">
          <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"><span class="dropdown-toggle-label">خانه</span></button>
          <input type="hidden">
          <div class="dropdown-menu"><a class="dropdown-item" href="real-estate-home-v1.html#"><span class="dropdown-item-label">آپارتمان</span></a><a class="dropdown-item" href="real-estate-home-v1.html#"><span class="dropdown-item-label">خانه</span></a><a class="dropdown-item" href="real-estate-home-v1.html#"><span class="dropdown-item-label">سوئیت</span></a><a class="dropdown-item" href="real-estate-home-v1.html#"><span class="dropdown-item-label">دفتر تجاری</span></a></div>
        </div>
        <!-- <ul class="nav nav-tabs d-none d-md-flex ps-lg-2 mb-0">
          <li class="nav-item"><a class="nav-link fs-sm mb-2 mb-md-0" href="real-estate-home-v1.html#">آپارتمان</a></li>
          <li class="nav-item"><a class="nav-link fs-sm active mb-2 mb-md-0" href="real-estate-home-v1.html#">خانه</a></li>
          <li class="nav-item"><a class="nav-link fs-sm mb-2 mb-md-0" href="real-estate-home-v1.html#">سوئیت</a></li>
          <li class="nav-item"><a class="nav-link fs-sm mb-2 mb-md-0" href="real-estate-home-v1.html#">دفتر تجاری</a></li>
        </ul> -->
      </div><a class="btn btn-link fw-normal d-none d-lg-block p-0" href="real-estate-catalog-rent.html">مشاهده همه <i class="fi-arrow-long-left me-2"></i></a>
    </div>


    <div class="row g-4">
      <div class="col-md-6">


        @for($i=0;$i < 2; $i++)
          <?php

          $padd = '';
          $s = $special[$i];
          $img = url('/') . "/img/blank.png";
          $image = json_decode($s->media);

          $media = [""];
          if (isset($s->media) && count(json_decode($s->media)) > 0) {
            $media = json_decode($s->media);

            $img = url('/') . "/img/blank.png";
            if (isset($media[0]) && !empty($media[0])) {
              $img = url('/') . "/upload/property/" . $s->id . "/" . $media[0];
            }
          }

          $padd = $i ? 0 : 'mb-4';


          ?>

          <div class="card bg-size-cover bg-position-center border-0 overflow-hidden {{ $padd }}" style="background-image: url('{{ $img }}');"><span class="img-gradient-overlay"></span>
          <div class="card-body content-overlay pb-0"><span class="badge bg-info fs-sm">جدید</span></div>
          <div class="card-footer content-overlay border-0 pt-0 pb-4">
            <div class="d-sm-flex justify-content-between align-items-end pt-5 mt-2 mt-sm-5"><a class="text-decoration-none text-light pe-2" href="{{url('/')}}/p/{{$s->id}}/{{str_replace(' ','-',$s->title)}}">
                <div class="fs-sm text-uppercase pt-2 mb-1">اجاره ای</div>
                <h3 class="h5 text-light mb-1">{{ $s -> title }}</h3>
                <div class="fs-sm opacity-70"><i class="fi-map-pin me-1"></i> {{ $s -> address }}</div>
              </a>
              <div class="btn-group ms-n2 ms-sm-0 mt-3"><a class="btn btn-primary px-3" href="{{url('/')}}/p/{{$s->id}}/{{str_replace(' ','-',$s->title)}}" style="height: 2.75rem;"> {{ number_format($s -> price) }} تومان</a>
              </div>
            </div>
          </div>
      </div>
      @endfor




    </div>



    @for($i=2;$i < 3; $i++)
      <?php

      $s = $special[$i];
      $img = url('/') . "/img/blank.png";
      $image = json_decode($s->media);

      $media = [""];
      if (isset($s->media) && count(json_decode($s->media)) > 0) {
        $media = json_decode($s->media);

        $img = url('/') . "/img/blank.png";
        if (isset($media[0]) && !empty($media[0])) {
          $img = url('/') . "/upload/property/" . $s->id . "/" . $media[0];
        }
      }


      ?>
      <div class="col-md-6">
      <div class="card bg-size-cover bg-position-center border-0 overflow-hidden h-100" style="background-image: url('{{ $img }}');"><span class="img-gradient-overlay"></span>
        <div class="card-body content-overlay pb-0">
          <div class="d-flex"><span class="badge bg-success fs-sm me-2">تایید</span><span class="badge bg-info fs-sm">جدید</span></div>
        </div>
        <div class="card-footer content-overlay border-0 pt-0 pb-4">
          <div class="d-sm-flex justify-content-between align-items-end pt-5 mt-2 mt-sm-5"><a class="text-decoration-none text-light pe-2" href="{{url('/')}}/p/{{$s->id}}/{{str_replace(' ','-',$s->title)}}">
              <h3 class="h5 text-light mb-1">{{ $s -> title }}</h3>
              <div class="fs-sm opacity-70"><i class="fi-map-pin me-1"></i> {{ $s -> address }}</div>
            </a>
            <div class="btn-group ms-n2 ms-sm-0 mt-3"><a class="btn btn-primary px-3" href="{{url('/')}}/p/{{$s->id}}/{{str_replace(' ','-',$s->title)}}" style="height: 2.75rem;"> {{ number_format($s -> price) }} تومان</a>
            </div>
          </div>
        </div>
      </div>
      </div>

      @endfor


      </div>
  </section>

  @endif
  <!-- Property cost calculator-->

  @if(isset($banner))
  @foreach($banner as $b)
  <section class="container mb-5 pb-2 pb-lg-4">
    <div class="row align-items-center">
      <div class="col-md-5"><img class="d-block mx-md-0 mx-auto mb-md-0 mb-4 rotate-img" src="img/real-estate/illustrations/calculator.svg" width="416" alt="Illustration"></div>
      <div class="col-xxl-6 col-md-7 text-md-start text-center">
        <h2 class="">{{ $b -> title }}</h2>
        <p class="pb-3 fs-base"> {{ $b -> desc }}</p><a class="btn btn-lg btn-primary" href="{{ $b -> link }}" data-bs-toggle="modal"><i class="fi-calculator me-2"></i>{{ $b -> link_title }}</a>
      </div>
    </div>
  </section>

  @endforeach
  @endif



  <style>
    .card-img-top img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      display: block;
    }
  </style>

  <!-- Cities (carousel)-->
  <section class="container mb-5 pb-2">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="h3 mb-0 ">شهرهای پیشنهادی ما</h2><a class="btn btn-link fw-normal ms-md-3 pb-0 px-0" href="real-estate-catalog-rent.html">مشاهده همه <i class="fi-arrow-long-left ms-2"></i></a>
    </div>
    <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-nav-outside-flush mx-n2" dir="ltr">
      <div class="tns-carousel-inner row gx-4 mx-0 py-md-4 py-3" data-carousel-options="{&quot;items&quot;: 4, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;992&quot;:{&quot;items&quot;:4}}}">

        <!-- Item-->
        @foreach ($city as $c)


        <div class="col">
          <a class="card shadow-sm card-hover border-0" href="{{ url('/') }}/city/{{ $c -> tag }}">
            <div class="card-img-top card-img-hover"><span class="img-overlay opacity-65"></span>
              <img src="{{ url('/') }}{{ $c -> image }}" alt="{{ $c -> name }}">
              <div class="content-overlay start-0 top-0 d-flex align-items-center justify-content-center w-100 h-100 p-3">
                <div class="w-100 p-1">
                  <div class="mb-2">
                    <h4 class="mb-2 fs-xs fw-normal text-light"><i class="fi-wallet mt-n1 me-2 fs-sm align-middle"></i>ملک برای فروش</h4>
                    <div class="d-flex align-items-center">
                      <div class="progress progress-light w-100">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                      </div><span class="text-light fs-sm ps-1 ms-2">268</span>
                    </div>
                  </div>
                  <div class="pt-1">
                    <h4 class="mb-2 fs-xs fw-normal text-light"><i class="fi-home mt-n1 me-2 fs-sm align-middle"></i>ملک برای اجاره</h4>
                    <div class="d-flex align-items-center">
                      <div class="progress progress-light w-100">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div><span class="text-light fs-sm ps-1 ms-2">1540</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body text-center">
              <h3 class="mb-0 fs-base text-nav">{{ $c -> name }}</h3>
            </div>
          </a>
        </div>

        @endforeach


      </div>
    </div>
  </section>
  <!-- Partners (carousel)-->
  <section class="container mb-5 pb-2 pb-lg-4">
    <h2 class="h3 mb-4 text-right  text-md-start">مشاوران املاک </h2>
    <div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush" dir="ltr">
      <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 6, &quot;controls&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;500&quot;:{&quot;items&quot;:4}, &quot;992&quot;:{&quot;items&quot;:5, &quot;gutter&quot;: 16}, &quot;1200&quot;:{&quot;items&quot;:6, &quot;gutter&quot;: 24}}}">
        <div><a class="swap-image" href="real-estate-home-v1.html#"><img class="swap-to" src="img/real-estate/brands/01_color.svg" alt="Logo" width="196"><img class="swap-from" src="img/real-estate/brands/01_gray.svg" alt="Logo" width="196"></a></div>
        <div><a class="swap-image" href="real-estate-home-v1.html#"><img class="swap-to" src="img/real-estate/brands/02_color.svg" alt="Logo" width="196"><img class="swap-from" src="img/real-estate/brands/02_gray.svg" alt="Logo" width="196"></a></div>
        <div><a class="swap-image" href="real-estate-home-v1.html#"><img class="swap-to" src="img/real-estate/brands/03_color.svg" alt="Logo" width="196"><img class="swap-from" src="img/real-estate/brands/03_gray.svg" alt="Logo" width="196"></a></div>
        <div><a class="swap-image" href="real-estate-home-v1.html#"><img class="swap-to" src="img/real-estate/brands/04_color.svg" alt="Logo" width="196"><img class="swap-from" src="img/real-estate/brands/04_gray.svg" alt="Logo" width="196"></a></div>
        <div><a class="swap-image" href="real-estate-home-v1.html#"><img class="swap-to" src="img/real-estate/brands/05_color.svg" alt="Logo" width="196"><img class="swap-from" src="img/real-estate/brands/05_gray.svg" alt="Logo" width="196"></a></div>
        <div><a class="swap-image" href="real-estate-home-v1.html#"><img class="swap-to" src="img/real-estate/brands/06_color.svg" alt="Logo" width="196"><img class="swap-from" src="img/real-estate/brands/06_gray.svg" alt="Logo" width="196"></a></div>
      </div>
    </div>
  </section>
  <!-- Top agents (lnked carousel)-->
  <section class="container mb-5 pb-2 pb-lg-4">
    <h2 class="h3 mb-4 pb-3 text-right  text-md-start">برترین مشاوران املاک</h2>
    <div class="tns-carousel-wrapper">
      <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 1, &quot;mode&quot;: &quot;gallery&quot;, &quot;controlsContainer&quot;: &quot;#agents-carousel-controls&quot;, &quot;nav&quot;: false}">
        <div>
          <div class="row align-items-center">
            <div class="col-xl-4 d-none d-xl-block"><img class="rounded-3" src="img/real-estate/agents/01.jpg" alt="Agent picture"></div>
            <div class="col-xl-4 col-md-5 col-sm-4"><img class="rounded-3" src="img/real-estate/agents/02.jpg" alt="Agent picture"></div>
            <div class="col-xl-4 col-md-7 col-sm-8 px-4 px-sm-3 px-md-0 ms-md-n4 mt-n5 mt-sm-0 py-3">
              <div class="card border-0 shadow-sm ms-sm-n5">
                <blockquote class="blockquote card-body">
                  <h4 style="max-width: 22rem;font-family:vazir-bold">&quot;من بهترین اقامتگاه را برای شما انتخاب می کنم&quot;</h4>
                  <p class="d-sm-none d-lg-block">لورم ایپسوم ساختار چاپ و متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است. لورم ایپسوم ساختار چاپ و متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است.</p>
                  <footer class="d-flex justify-content-between">
                    <div class="pe-3"><a class="text-decoration-none" href="real-estate-vendor-properties.html">
                        <h6 class="mb-0">فلوید مایلز</h6>
                        <div class="text-muted fw-normal fs-sm mb-3">نماینده گروه امپراتوری املاک</div>
                      </a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="real-estate-home-v1.html#"><i class="fi-facebook"></i></a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="real-estate-home-v1.html#"><i class="fi-twitter"></i></a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="real-estate-home-v1.html#"><i class="fi-linkedin"></i></a></div>
                    <div><span class="star-rating"><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i></span>
                      <div class="text-muted fs-sm mt-1">45 نظر</div>
                    </div>
                  </footer>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div class="row align-items-center">
            <div class="col-xl-4 d-none d-xl-block"><img class="rounded-3" src="img/real-estate/agents/02.jpg" alt="Agent picture"></div>
            <div class="col-xl-4 col-md-5 col-sm-4"><img class="rounded-3" src="img/real-estate/agents/03.jpg" alt="Agent picture"></div>
            <div class="col-xl-4 col-md-7 col-sm-8 px-4 px-sm-3 px-md-0 ms-md-n4 mt-n5 mt-sm-0 py-3">
              <div class="card border-0 shadow-sm ms-sm-n5">
                <blockquote class="blockquote card-body">
                  <h4 style="max-width: 22rem;font-family:vazir-bold">&quot;بیش از 10 سال تجربه به عنوان مشاور املاک&quot;</h4>
                  <p class="d-sm-none d-lg-block">لورم ایپسوم ساختار چاپ و متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است. لورم ایپسوم ساختار چاپ و متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است.</p>
                  <footer class="d-flex justify-content-between">
                    <div class="pe-3"><a class="text-decoration-none" href="real-estate-vendor-properties.html">
                        <h6 class="mb-0">کریستین واتسون</h6>
                        <div class="text-muted fw-normal fs-sm mb-3">نماینده گروه امپراتوری املاک</div>
                      </a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="real-estate-home-v1.html#"><i class="fi-facebook"></i></a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="real-estate-home-v1.html#"><i class="fi-twitter"></i></a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="real-estate-home-v1.html#"><i class="fi-linkedin"></i></a></div>
                    <div><span class="star-rating"><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i></span>
                      <div class="text-muted fs-sm mt-1">24 نظر</div>
                    </div>
                  </footer>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div class="row align-items-center">
            <div class="col-xl-4 d-none d-xl-block"><img class="rounded-3" src="img/real-estate/agents/03.jpg" alt="Agent picture"></div>
            <div class="col-xl-4 col-md-5 col-sm-4"><img class="rounded-3" src="img/real-estate/agents/01.jpg" alt="Agent picture"></div>
            <div class="col-xl-4 col-md-7 col-sm-8 px-4 px-sm-3 px-md-0 ms-md-n4 mt-n5 mt-sm-0 py-3">
              <div class="card border-0 shadow-sm ms-sm-n5">
                <blockquote class="blockquote card-body">
                  <h4 style="max-width: 22rem;font-family:vazir-bold">&quot;من نه نمی گویم ، من فقط راهی برای کار کردن پیدا کردم&quot;</h4>
                  <p class="d-sm-none d-lg-block">لورم ایپسوم ساختار چاپ و متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است. لورم ایپسوم ساختار چاپ و متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است.</p>
                  <footer class="d-flex justify-content-between">
                    <div class="pe-3"><a class="text-decoration-none" href="real-estate-vendor-properties.html">
                        <h6 class="mb-0">گای هاوکینز</h6>
                        <div class="text-muted fw-normal fs-sm mb-3">نماینده گروه امپراتوری املاک</div>
                      </a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="real-estate-home-v1.html#"><i class="fi-facebook"></i></a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="real-estate-home-v1.html#"><i class="fi-twitter"></i></a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="real-estate-home-v1.html#"><i class="fi-linkedin"></i></a></div>
                    <div><span class="star-rating"><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i></span>
                      <div class="text-muted fs-sm mt-1">16 نظر</div>
                    </div>
                  </footer>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tns-carousel-controls justify-content-center justify-content-md-start my-2 mt-md-4" id="agents-carousel-controls">
      <button class="mx-2" type="button"><i class="fi-chevron-left"></i></button>
      <button class="mx-2" type="button"><i class="fi-chevron-right"></i></button>
    </div>
  </section>
</main>
<!-- Footer-->
@include('partials.home.footer')