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
    
    <!-- نمایش پیام‌ها -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page content-->
    <div class="row">
        @include('user.side')

        <div class="col-lg-8 col-md-7 mb-5 account">
            <!-- ✅ اصلاح 1: تغییر متد به POST و اضافه کردن @csrf -->
            <form action="{{ url('user/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- یا POST بسته به Route شما -->

                <h1 class="h2">اطلاعات حساب کاربری</h1>
                <div class="progress mb-4" style="height: .25rem;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
                <label class="form-label pt-2" for="account-bio">توضیح مختصر</label>
                <div class="row pb-2">
                    <div class="col-lg-9 col-sm-8 mb-4">
                        <textarea name="bio" class="form-control" id="account-bio" rows="6" placeholder="بیوگرافی خود را اینجا بنویسید">{{ $user[0]->bio ?? '' }}</textarea>
                    </div>
                    
                    <!-- آپلودر فایل باید داخل فرم باشد -->
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <div>
                            <label class="form-label fw-bold">تصویر پروفایل</label>
                            <input
                                id="avatar-input"
                                name="avatar"
                                class="form-control"
                                type="file"
                                accept="image/png, image/jpeg, image/gif"
                            >
                            <small class="text-muted d-block mt-1">حداکثر ۲ مگابایت</small>
                            <div id="avatar-preview" class="mt-2">
                                @if(!empty($user[0]->avatar))
                                    <img src="{{ asset('upload/user/' . $user[0]->id . '/' . $user[0]->avatar) }}"
                                         alt="تصویر پروفایل"
                                         class="img-thumbnail"
                                         style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;"
                                         onclick="document.getElementById('avatar-input').click();">
                                @else
                                    <img src="{{ asset('img/avatars/default-user.svg') }}"
                                         alt="تصویر پیشفرض"
                                         class="img-thumbnail"
                                         style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;"
                                         onclick="document.getElementById('avatar-input').click();">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- اطلاعات شخصی -->
                <div class="border rounded-3 p-3 mb-4" id="personal-info">
                    <!-- Name-->
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="ps-2">
                                <label class="form-label fw-bold">نام کامل</label>
                            </div>
                        </div>
                        <div class="collapse show" id="name-collapse" data-bs-parent="#personal-info">
                            <input name="name" class="form-control mt-3" type="text" value="{{ $user[0]->name ?? '' }}">
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
                            <input name="email" class="form-control mt-3" type="email" value="{{ $user[0]->email ?? '' }}">
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
                            <input name="tel" class="form-control mt-3" type="text" value="{{ $user[0]->tel ?? '' }}">
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
                            <input name="company" class="form-control mt-3" type="text" placeholder="نام شرکت" value="{{ $user[0]->company ?? '' }}">
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
                            <input name="address" class="form-control mt-3" type="text" placeholder="آدرس" value="{{ $user[0]->address ?? '' }}">
                        </div>
                    </div>
                </div>

                <!-- Socials-->
                <div class="pt-2">
                    <label class="form-label fw-bold mb-3">شبکه های اجتماعی</label>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3">
                        <i class="fi-instagram text-body"></i>
                    </div>
                    <input name="instagram" class="form-control" type="text" placeholder="اکانت اینستاگرام" value="{{ $user[0]->instagram ?? '' }}">
                </div>
                
                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3">
                        <i class="fi-whatsapp text-body"></i>
                    </div>
                    <input name="whatsapp" class="form-control" type="text" placeholder="اکانت واتساپ" value="{{ $user[0]->whatsapp ?? '' }}">
                </div>
                
                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3">
                        <i class="fi-telegram text-body"></i>
                    </div>
                    <input name="telegram" class="form-control" type="text" placeholder="اکانت تلگرام" value="{{ $user[0]->telegram ?? '' }}">
                </div>

                <div class="d-flex align-items-center justify-content-between border-top mt-4 pt-4 pb-1">
                    <button class="btn btn-primary px-3 px-sm-4" type="submit">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('avatar-input').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('avatar-preview').innerHTML =
                '<img src="' + event.target.result + '" alt="پیش‌نمایش" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" onclick="document.getElementById(\'avatar-input\').click();">';
        };
        reader.readAsDataURL(file);
    }
});
</script>

@include('partials.footer')