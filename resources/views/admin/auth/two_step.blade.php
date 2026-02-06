<!DOCTYPE html>


<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="HTML5,CSS3,HTML,Template,multi-page,Farol - Bootstrap 5 Admin Dashboard Template">
    <meta name="description" content="Farol - Bootstrap 5 Admin Dashboard Template">
    <meta name="author" content="Barat Hadian">

    <link rel="stylesheet" href="{{url('/')}}/assets/css/style.css">
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/favicon.png">
    <title> ورود به سایت</title>

    <meta http-equiv="imagetoolbar" content="no" />

</head>

<body data-theme="dark">

    <div class="container-fluid">
        <div class="main-content d-flex flex-column px-0">
            <div class="m-auto mw-510 py-5">
                <form action="{{url('/')}}/admin/changepass" method="post">
                    @csrf



                    <div class="d-flex align-items-center gap-4 mb-3">
                        <h4 class="fs-3 mb-0">فراموشی اطلاعات کاربری</h4> <a href="index.html"> <img
                                src="{{url('/')}}/assets/images/logo.svg" alt="logo"> </a>
                    </div>
                    <p class="fs-18 mb-5">اطلاعات خود را با دقت وارد کنید

                    </p>
                    <div style="width: 500px;" class="d-sm-flex gap-10 py-10"> </div>

                    @if(session('error'))
                        <div class="alert alert-danger mb-3">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="form-group mb-4">
                                <label class="label">کد ارسالی را وارد کنید </label>
                                <input type="text" name="code" class="form-control h-58" placeholder="کد">
                            </div>

                            <div class="form-group mb-4">
                                <label class="label">گذرواژه جدید</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password" name="password" id="password" class="form-control h-58 text-dark" placeholder="گذرواژه جدید"">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group mb-0">
                                <label class="label">تکرار گذرواژه جدید</label>
                                <div class="form-group">
                                    <div class="password-wrapper position-relative">
                                        <input type="password" name="repassword" id="password" class="form-control h-58 text-dark" placeholder="تکرار گذرواژه جدید"">
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                    <button type="submit" class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-70"> تایید </button>
                    <a onclick="history.back() " class="btn btn-secondary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-30"> بازگشت </a>
                </form>
            </div>
        </div>
    </div>



    <script src="{{url('/')}}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/assets/js/custom/custom.js"></script>
</body>

</html>
