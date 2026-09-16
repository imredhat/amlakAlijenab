<!-- Navbar-->
<header class="navbar navbar-expand-lg navbar-light bg-light fixed-top navbar-stuck" data-scroll-header="">
  <div class="container"><a class="navbar-brand ms-3 ms-xl-4 logo" href="{{url('/')}}"><img class="d-block" src="{{ url('/') }}{{ $siteLogo }}" width="116" alt="Finder"></a>
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span></button>




    @if(isset($user) )
    <div class="dropdown d-none d-lg-block order-lg-3 my-n2 me-3">
      <a class="d-block py-2" href="{{url('/')}}/user/profile">
        @if(isset($user[0] -> avatar) && !empty($user[0] -> avatar))
        <img class="rounded-circle" src="{{url('')}}/upload/user/{{ $user[0] -> id }}/{{ $user[0] -> avatar }}" style="height: 48px;" width="48" alt="{{ $user[0] -> name .' '.$user[0] -> lname.' '.$user[0] -> bio }}">

        @else
        <img class="rounded-circle" src="{{url('')}}/img/avatars/04.jpg" width="48" alt="">

        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-end">
        <div class="d-flex align-items-start border-bottom px-3 py-1 mb-2" style="width: 16rem;">

          @if(isset($user[0] -> avatar) && !empty($user[0] -> avatar))
          <img class="rounded-circle" src="{{url('')}}/upload/user/{{ $user[0] -> id }}/{{ $user[0] -> avatar }}" style="height: 48px;" width="48" alt="{{ $user[0] -> name .' '.$user[0] -> lname.' '.$user[0] -> bio }}">

          @else
          <img class="rounded-circle" src="{{url('')}}/img/avatars/04.jpg" width="48" alt="">

          @endif


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
    <button type="button" class="btn btn-sm btn-outline-primary ms-2 order-lg-3" onclick="document.getElementById('search-modal').style.display='flex'" title="جستجو" aria-label="Search">
      <i class="ri-search-line"></i>
    </button>
    <a class="btn btn-primary btn-sm ms-2 order-lg-3" href="{{url('/')}}/property/add"><i class="fi-plus me-2">
      </i>ثبت<span class="d-none d-sm-inline"> ملک</span>
    </a>
    <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
      <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
        <!-- Demos switcher-->

        <!-- Menu items-->
        <li class="nav-item active"><a class="nav-link " href="{{ url('/') }}" role="button" aria-expanded="false">خانه</a>
        </li>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">آپارتمان</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ url('property/type/rent/') }}">آپارتمان برای اجاره</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/sale/') }}">آپارتمان برای فروش</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/under-100m/') }}">آپارتمان زیر 100 متر</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/above-100m/') }}">آپارتمان بالای 100 متر</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/view-sea/') }}">آپارتمان ویو دریا</a></li>
            <li><a class="dropdown-item" href="{{ url('property/type/view-jungle/') }}">آپارتمان ویو جنگل</a></li>

          </ul>
        </li>


        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">بر اساس مکان</a>
          <ul class="dropdown-menu">
            @foreach($locations as $loc)
            <li><a class="dropdown-item" href="{{ url('property/location/'.$loc -> tag.'/') }}">آپارتمان محدوده {{ $loc -> name }}</a></li>
            @endforeach
          </ul>
        </li>

        <li class="nav-item "><a class="nav-link " href="{{ url('/blog/') }}" role="button" aria-expanded="false">مجله</a>
        <li class="nav-item "><a class="nav-link " href="{{ url('/agents') }}" role="button" aria-expanded="false">مشاوران</a>
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

<!-- Fullscreen Search Modal -->
<style>
  #search-modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.85);
    align-items: center;
    justify-content: center;
  }
  #search-modal .search-box {
    width: 90%;
    max-width: 600px;
  }
  #search-modal .search-close {
    position: absolute;
    top: 1.5rem;
    left: 1.5rem;
    background: none;
    border: none;
    color: #fff;
    font-size: 2rem;
    cursor: pointer;
    line-height: 1;
  }
  #search-modal .search-close:hover {
    opacity: 0.7;
  }
  #search-modal input[type="search"] {
    width: 100%;
    padding: 1rem 1.25rem;
    font-size: 1.15rem;
    border: 2px solid #fff;
    border-radius: 0 0.5rem 0.5rem 0;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    outline: none;
  }
  #search-modal input[type="search"]::placeholder {
    color: rgba(255, 255, 255, 0.6);
  }
  #search-modal input[type="search"]:focus {
    border-color: var(--bs-primary, #0d6efd);
  }
  #search-modal .search-btn {
    padding: 1rem 2rem;
    font-size: 1.15rem;
    border: 2px solid var(--bs-primary, #0d6efd);
    border-radius: 0.5rem 0 0 0.5rem;
    background: var(--bs-primary, #0d6efd);
    color: #fff;
    cursor: pointer;
    white-space: nowrap;
  }
  #search-modal .search-btn:hover {
    opacity: 0.9;
  }
  #search-modal .search-input-group {
    display: flex;
    align-items: stretch;
  }
</style>

<div id="search-modal">
  <button type="button" class="search-close" onclick="document.getElementById('search-modal').style.display='none'" aria-label="Close">&times;</button>
  <div class="search-box">
    <form action="{{ url('/search') }}" method="GET" class="search-input-group">
      <input type="search" name="q" placeholder="جستجو کنید..." autofocus required>
      <button type="submit" class="search-btn">
        <i class="ri-search-line me-1"></i> جستجو
      </button>
    </form>
  </div>
</div>

<script>
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      document.getElementById('search-modal').style.display = 'none';
    }
  });
  var searchModal = document.getElementById('search-modal');
  searchModal.addEventListener('click', function(e) {
    if (e.target === searchModal) {
      searchModal.style.display = 'none';
    }
  });
</script>