<!-- Sidebar-->
<aside class="col-lg-4 col-md-5 pe-xl-4 mb-5">
    <!-- Account nav-->
    <div class="card card-body border-0 shadow-sm pb-1 me-lg-1">
        <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4">
            <img class="rounded-circle" src="{{url('')}}/img/avatars/04.jpg" width="48" alt="">
            <div class="pt-md-2 pt-lg-0 ps-3 ps-md-0 ps-lg-3">

             @if(isset($user[0] -> name) && !empty($user[0] -> name))
                <h2 class="fs-lg mb-0">{{$user[0]->name}}</h2>
                <div class="fs-xs py-2">{{$user[0]->tel}}</div>
              @else
                {{$user[0]->tel}}
                <h2 class="fs-lg mb-0">{{$user[0]->tel}}</h2>
                <div class="fs-xs py-2">کاربر</div>
              @endif

                
                <!-- <span class="star-rating"><i class="star-rating-icon fi-star-filled active"></i>
                    <i class="star-rating-icon fi-star-filled active"></i>
                    <i class="star-rating-icon fi-star-filled active"></i>
                    <i class="star-rating-icon fi-star-filled active"></i>
                    <i class="star-rating-icon fi-star-filled active"></i>
                </span> -->
             

            </div>
        </div><a class="btn btn-primary btn-lg w-100 mb-3" href="{{url('/')}}/property/add"><i class="fi-plus me-2"></i> ثبت ملک</a><a class="btn btn-outline-secondary d-block d-md-none w-100 mb-3" href="real-estate-account-properties.html#account-nav" data-bs-toggle="collapse"><i class="fi-align-justify me-2"></i>منو</a>
        <div class="collapse d-md-block mt-3" id="account-nav">
            <div class="card-nav">
                <a class="card-nav-link" href="{{url('/')}}/user/profile"><i class="fi-user opacity-60 me-2"></i>اطلاعات حساب کاربری</a>
                <a class="card-nav-link" href="{{url('/')}}/user/myADS"><i class="fi-home opacity-60 me-2"></i>املاک من</a>
                <a class="card-nav-link" href="{{url('/')}}/user/favorite"><i class="fi-heart opacity-60 me-2"></i>موردعلاقه ها</a>
                <a class="card-nav-link" href="{{url('/')}}/page/faqs"><i class="fi-help opacity-60 me-2"></i>پشتیبانی</a>
                <a class="card-nav-link" href="{{url('/')}}/auth/logout"><i class="fi-logout opacity-60 me-2"></i>خروج</a>
            </div>
        </div>
    </div>
</aside>