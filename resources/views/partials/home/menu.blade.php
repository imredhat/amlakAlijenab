<!-- Navbar-->
<header class="navbar navbar-expand-lg navbar-light bg-light fixed-top navbar-stuck" data-scroll-header="">
  <div class="container"><a class="navbar-brand ms-3 ms-xl-4 logo" href="{{url('/')}}"><img class="d-block" src="{{url('')}}/img/logo/logo-dark.svg" width="116" alt="Finder"></a>
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span></button>

    @if(isset($user))
    <div class="dropdown d-none d-lg-block order-lg-3 my-n2 me-3">
      <a class="d-block py-2" href="{{url('/')}}/user/profile">
        <img class="rounded-circle" src="{{url('/')}}/img/avatars/04.jpg" width="40" alt=""></a>
      <div class="dropdown-menu dropdown-menu-end">
        <div class="d-flex align-items-start border-bottom px-3 py-1 mb-2" style="width: 16rem;">
          <img class="rounded-circle" src="{{url('/')}}/img/avatars/04.jpg" width="48" alt="">
          <div class="ps-2 text-end">
            <h6 class="fs-base mb-0">
              @if(isset($user[0] -> name) && !empty($user[0] -> name))
              {{$user[0]->name}}
              <div class="fs-xs py-2">{{$user[0]->tel}}</div>
              @else
              {{$user[0]->tel}}
              <div class="fs-xs py-2">کاربر</div>
              @endif

            </h6>
            <!-- <span class="star-rating star-rating-sm">
              <i class="star-rating-icon fi-star-filled active"></i>
              <i class="star-rating-icon fi-star-filled active"></i>
              <i class="star-rating-icon fi-star-filled active"></i>
              <i class="star-rating-icon fi-star-filled active"></i>
              <i class="star-rating-icon fi-star-filled active"></i>
            </span> -->

          </div>
        </div>
        <a class="dropdown-item" href="{{url('/')}}/user/profile"><i class="fi-user opacity-60 me-2"></i> اطلاعات حساب کاربری</a>
        <a class="dropdown-item" href="{{url('/')}}/user/myADS"><i class="fi-home opacity-60 me-2"></i>املاک من</a>
        <a class="dropdown-item" href="{{url('/')}}/user/favorite"><i class="fi-heart opacity-60 me-2"></i>موردعلاقه ها</a>
        <div class="dropdown-divider"></div><a class="dropdown-item" href="{{url('/')}}/page/faqs">پشتیبانی</a>
        <a class="dropdown-item" href="{{url('/')}}/auth/logout"> خروج</a>
      </div>
    </div>
    @else

    <a class="btn btn-sm text-primary d-none d-lg-block order-lg-3" href="#signin-modal" data-bs-toggle="modal">
      <i class="fi-user me-2"></i>ورود به حساب کاربری</a>
    @endif
    <a class="btn btn-primary btn-sm ms-2 order-lg-3" href="{{url('/')}}/property/add"><i class="fi-plus me-2">
      </i>ثبت<span class="d-none d-sm-inline"> ملک</span>
    </a>
    <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
      <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
        <!-- Demos switcher-->

        <!-- Menu items-->
        <li class="nav-item  active"><a class="nav-link " href="{{ url('/') }}" role="button" aria-expanded="false">خانه</a>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">آپارتمان</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ url('property/type/rent/') }}">آپارتمان برای اجاره</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/sale/') }}">آپارتمان برای فروش</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/under-100m/') }}">آپارتمان زیر 100 متر</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/above-100m/') }}">آپارتمان بالای 100 متر</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/sea-side/') }}">آپارتمان ویو دریا</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/sea-side/') }}">آپارتمان ویو دریا</a></li>

          </ul>
        </li>


        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">بر اساس مکان</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ url('property/location/west-babol/') }}">آپارتمان محدوده کمربندی غربی</a></li>
            <li><a class="dropdown-item" href="{{ url('property/location/east-babol/') }}">آپارتمان محدوده کمربندی شرقی</a></li>
            <li><a class="dropdown-item" href="{{ url('property/location/shariati/') }}">آپارتمان محدوده شریعتی</a></li>
            <li><a class="dropdown-item" href="{{ url('property/location/modares/') }}">آپارتمان محدوده مدرس</a></li>
            <li><a class="dropdown-item" href="{{ url('property/location/helal-ahmar/') }}">آپارتمان محدوده میدان هلال احمر</a></li>
            <li><a class="dropdown-item" href="{{ url('property/location/istgah-amol/') }}">آپارتمان محدوده ایستگاه آمل</a></li>
            <li><a class="dropdown-item" href="{{ url('property/location/park-noshirvani/') }}">آپارتمان محدوده پارک نوشیروانی</a></li>
            <li><a class="dropdown-item" href="{{ url('property/location/jadde-ghaemshahr/') }}">آپارتمان محدوده جاده قائمشهر</a></li>
            <li><a class="dropdown-item" href="{{ url('property/location/hamze-kola/') }}">آپارتمان محدوده حمزه کلا</a></li>

          </ul>
        </li>

        <li class="nav-item "><a class="nav-link " href="{{ url('/blog/') }}" role="button" aria-expanded="false">مجله</a>
        <li class="nav-item "><a class="nav-link " href="{{ url('/page/faqs') }}" role="button" aria-expanded="false">سوالات متداول</a>
        <li class="nav-item "><a class="nav-link " href="{{ url('/page/about') }}" role="button" aria-expanded="false">درباره ما</a>
        <li class="nav-item "><a class="nav-link " href="{{ url('/page/contact') }}" role="button" aria-expanded="false">تماس با ما</a>



        <li class="nav-item d-lg-none">
          <a class="nav-link" href="#signin-modal" data-bs-toggle="modal"><i class="fi-user me-2"></i>ورود به حساب کاربری</a>
        </li>
      </ul>
    </div>
  </div>
</header>