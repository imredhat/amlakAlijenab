@include('auth/header')

<!-- Page content-->
<div class="container-fluid d-flex h-100 align-items-center justify-content-center py-4 py-sm-5">
  <div class="card card-body" style="max-width: 940px"><a class="position-absolute top-0 end-0 nav-link fs-sm py-1 px-2 mt-3 me-3" href="signin-light.html#" onclick="window.history.go(-1); return false;"><i class="fi-arrow-long-right fs-base me-2"></i>برگشت</a>
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
@include('auth/footer')