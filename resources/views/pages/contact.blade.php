
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



<div class="container mt-5 mb-md-4 pt-5">
        <nav class="mb-3 pt-md-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="real-estate-home-v1.html">خانه</a></li>
            <li class="breadcrumb-item active" aria-current="page">تماس با ما</li>
          </ol>
        </nav>
      </div>









      <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row align-items-md-start align-items-center gy-4">
          <div class="col-lg-5 col-md-6">
            <div class="mx-md-0 mx-auto mb-md-5 mb-4 pb-md-4 text-md-start text-center" style="max-width: 416px;">
              <h1 class="mb-4 ">با ما در ارتباط باشید!</h1>
              <p class="mb-0 fs-base text-muted">فرم را تکمیل کنید و تیم ما سعی می کند در مدت 24 ساعت با شما تماس بگیرد.</p>
            </div><img class="d-block mx-auto rotate-img" src="{{ url('/') }}/img/real-estate/illustrations/contact.svg" alt="Illustration">
          </div>
          <div class="col-md-6 offset-lg-1">
            <div class="card border-0 bg-secondary p-sm-3 p-2">
              <div class="card-body m-1">
                <form class="needs-validation" method="post" action="{{ url('/admin/page/contact_form') }}" novalidate>
                  @csrf
                  <div class="mb-4">
                    <label class="form-label" for="c-name">نام خانوادگی</label>
                    <input class="form-control form-control-lg" id="c-name" type="text" required="">
                    <div class="invalid-tooltip mt-1">لطفا نام و نام خانوادگی خود را وارد کنید</div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label" for="c-tel">تلفن همراه</label>
                    <input class="form-control form-control-lg" id="c-tel" type="tel" required="">
                    <div class="invalid-tooltip mt-1">لطفا شماره تلفن همراه خود را وارد کنید</div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label" for="c-message">متن درخواست</label>
                    <textarea class="form-control form-control-lg" id="c-message" rows="4" placeholder="متن مورد نظر خود را بنویسید ..." required=""></textarea>
                    <div class="invalid-tooltip mt-1">لطفا پیام خود را وارد کنید</div>
                  </div>
                  <div class="pt-sm-2 pt-1">
                    <button class="btn btn-lg btn-primary w-sm-auto w-100" type="submit">ارسال فرم</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>







      <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row g-4">
          <!-- Item-->
          <div class="col-md-4"><a class="icon-box card card-hover h-100" href="mailto:example@email.com">
              <div class="card-body">
                <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3"><i class="fi-mail"></i></div><span class="d-block mb-1 text-body">{{ $contact->item1_title }}</span>
                <h3 class="h5 icon-box-title mb-0 opacity-90">{{ $contact->value1 }}</h3>
              </div></a></div>
          <!-- Item-->
          <div class="col-md-4"><a class="icon-box card card-hover h-100" href="tel:4065550120">
              <div class="card-body">
                <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3"><i class="fi-device-mobile"></i></div><span class="d-block mb-1 text-body">{{ $contact->item2_title }}</span>
                <h3 class="h5 icon-box-title mb-0 opacity-90 ltr">{{ $contact->value2 }}</h3>
              </div></a></div>
          <!-- Item-->
          <div class="col-md-4"><a class="icon-box card card-hover h-100" href="real-estate-contacts.html#">
              <div class="card-body">
                <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3"><i class="fi-instagram"></i></div><span class="d-block mb-1 text-body">{{ $contact->item3_title }}</span>
                <h3 class="h5 icon-box-title mb-0 opacity-90 ltr">{{ $contact->value3 }}</h3>
              </div></a></div>
        </div>
      </section>








      @include('partials.home.footer')