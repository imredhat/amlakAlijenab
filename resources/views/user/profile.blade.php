@include('partials.header')
@include('partials.home.menu')


<!-- Page content-->
<div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
    <!-- Breadcrumb-->
    <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="real-estate-home-v1.html">خانه</a></li>
            <li class="breadcrumb-item"><a href="real-estate-account-info.html">حساب کاربری</a></li>
            <li class="breadcrumb-item active" aria-current="page">املاک من</li>
        </ol>
    </nav>
    <!-- Page content-->
    <div class="row">



        @include('user.side')


        <div class="col-lg-8 col-md-7 mb-5 account">
        <form action="{{ url('user/update') }}" method="get" autocomplete="on">

                <h1 class="h2">اطلاعات حساب کاربری</h1>
                <div class="progress mb-4" style="height: .25rem;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <label class="form-label pt-2" for="account-bio">توضیح مختصر</label>
                <div class="row pb-2">
                    <div class="col-lg-9 col-sm-8 mb-4">
                        <textarea name="bio" class="form-control" id="account-bio" rows="6" placeholder="بیوگرافی خود را اینجا بنویسید">{{$user[0]->bio}}</textarea>
                    </div>
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <input class="file-uploader bg-secondary" type="file" accept="image/png, image/jpeg" data-label-idle="&lt;i class=&quot;d-inline-block fi-camera-plus fs-2 text-muted mb-2&quot;&gt;&lt;/i&gt;&lt;br&gt;&lt;span class=&quot;fw-bold&quot;&gt; تغییر تصویر پروفایل&lt;/span&gt;" data-style-panel-layout="compact" data-image-preview-height="160" data-image-crop-aspect-ratio="1:1" data-image-resize-target-width="200" data-image-resize-target-height="200">
                    </div>
                </div>
                <div class="border rounded-3 p-3 mb-4" id="personal-info">
                    <!-- Name-->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="ps-2">
                                <label class="form-label fw-bold">نام کامل</label>
                            </div>
                        </div>
                        <div class="collapse show" id="name-collapse" data-bs-parent="#personal-info" style="">
                            <input name="name" class="form-control mt-3" type="text" data-bs-binded-element="#name-value" data-bs-unset-value="Not specified" value="{{$user[0] -> name}}">
                        </div>
                    </div>
                    <!-- Email-->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="ps-2">
                                <label class="form-label fw-bold">پست الکترونیکی</label>
                            </div>
                        </div>
                        <div class="collapse show" id="email-collapse" data-bs-parent="#personal-info">
                            <input name="email" class="form-control mt-3" type="email" data-bs-binded-element="#email-value" data-bs-unset-value="Not specified" value="{{$user[0] -> email}}">
                        </div>
                    </div>
                    <!-- Phone number-->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="ps-2">
                                <label class="form-label fw-bold">شماره تماس</label>
                            </div>
                        </div>
                        <div class="collapse show" id="phone-collapse" data-bs-parent="#personal-info">
                            <input name="tel" disabled class="form-control mt-3" type="text" data-bs-binded-element="#phone-value" data-bs-unset-value="Not specified" value="{{$user[0] -> tel}}">
                        </div>
                    </div>
                    <!-- Company name-->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="ps-2">
                                <label class="form-label fw-bold">نام شرکت</label>
                            </div>
                        </div>
                        <div class="collapse show" id="company-collapse" data-bs-parent="#personal-info">
                            <input name="company" class="form-control mt-3" type="text" data-bs-binded-element="#company-value" data-bs-unset-value="Not specified" placeholder="نام شرکت" value="{{$user[0] -> company}}">
                        </div>
                    </div>
                    <!-- Address-->
                    <div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="ps-2">
                                <label class="form-label fw-bold">آدرس</label>
                            </div>
                        </div>
                        <div class="collapse show" id="address-collapse" data-bs-parent="#personal-info">
                            <input name="address" class="form-control mt-3" type="text" data-bs-binded-element="#address-value" data-bs-unset-value="Not specified" placeholder="آدرس" value="{{$user[0] -> address}}">
                        </div>
                    </div>
                </div>
                <!-- Socials-->
                <div class="pt-2">
                    <label class="form-label fw-bold mb-3">شبکه های اجتماعی</label>
                </div>



                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-instagram text-body"></i></div>
                    <input name="instagram" class="form-control" type="text" placeholder="اکانت اینستاگرام" value="{{$user[0] -> instagram}}">
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-whatsapp text-body"></i></div>
                    <input name="whatsapp" class="form-control" type="text" placeholder="اکانت واتساپ" value="{{$user[0] -> whatsapp}}">
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-telegram text-body"></i></div>
                    <input name="telegram" class="form-control" type="text" placeholder="اکانت تلگرام"  value="{{$user[0] -> telegram}}">
                </div>

                <div class="d-flex align-items-center justify-content-between border-top mt-4 pt-4 pb-1">
                    <button class="btn btn-primary px-3 px-sm-4" type="submit">ذخیره تغییرات</button>
                </div>

            </form>
        </div>
    </div>
</div>

@include('partials.footer')