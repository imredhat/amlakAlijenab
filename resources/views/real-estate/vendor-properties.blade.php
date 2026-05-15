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

        <div class="container mt-5 mb-md-4 py-5">
            <!-- Breadcrumb -->
            <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('agents.index') }}">مشاوران</a></li>
                    <li class="breadcrumb-item active">{{ $agent->name }} {{ $agent->lname ?? '' }}</li>
                </ol>
            </nav>

            <div class="row">
                <!-- Sidebar اطلاعات مشاور -->
                <aside class="col-lg-3 col-md-4 mb-5">
                    <div class="pe-lg-3 text-center text-md-start">
                        <img class="d-block rounded-circle mx-auto mx-md-0 mb-3 shadow-sm"
                            src="{{ $agent->avatar ?? asset('img/avatars/default-agent.jpg') }}"
                            width="130" height="130" alt="{{ $agent->name }}">

                        <h2 class="h4 mb-1 font-vazir">{{ $agent->name }} {{ $agent->lname ?? '' }}</h2>
                        <p class="text-muted mb-3">{{ $agent->agency_name ?? 'مشاور املاک' }}</p>

                        <div class="d-flex justify-content-center justify-content-md-start border-bottom pb-4 mb-4">
                            <span class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="star-rating-icon fi-star-filled active"></i>
                                    @endfor
                            </span>
                        </div>

                        <div class="border-bottom pb-4 mb-4">
                            <p class="fs-sm">{{ $agent->bio ?? 'مشاور با تجربه در زمینه خرید، فروش و اجاره املاک مسکونی و تجاری.' }}</p>
                        </div>

                        <ul class="list-unstyled mb-4">
                            @if(!empty($agent->tel))
                            <li class="mb-2">
                                <a class="nav-link p-0" href="tel:{{ $agent->tel }}">
                                    <i class="fi-phone text-primary me-2"></i> {{ $agent->tel }}
                                </a>
                            </li>
                            @endif
                        </ul>

                        <!-- <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#messageModal">
                            <i class="fi-chat-left me-2"></i>ارسال پیام
                        </button> -->
                    </div>
                </aside>

                <!-- محتوای اصلی -->
                <div class="col-lg-9 col-md-8">
                    <h1 class="h2 mb-4 font-vazir">
                        املاک {{ $agent->name }}
                        <small class="fs-5 text-muted">({{ $properties->total() }} آگهی)</small>
                    </h1>

                    <!-- مرتب‌سازی -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <label class="fs-sm me-2">مرتب‌سازی براساس:</label>
                            <select class="form-select form-select-sm d-inline-block w-auto" id="sortby">
                                <option value="newest">جدیدترین</option>
                                <option value="price_high">گران‌ترین</option>
                                <option value="price_low">ارزان‌ترین</option>
                            </select>
                        </div>
                        <div class="text-muted fs-sm">
                            {{ $properties->total() }} نتیجه یافت شد
                        </div>
                    </div>

                    <!-- لیست املاک -->
                    <div class="row g-4">


                        <?php
                        function getCat($type)
                        {
                            switch ($type) {
                                case 'other':
                                    return "سایر";
                                    break;
                                case 'pre-sale':
                                    return "پیش فروش";
                                    break;
                                case 'villa-sale':
                                    return "خرید و فروش ویلا";
                                    break;
                                case 'apartment-rent':
                                    return "رهن و اجاره خانه و آپارتمان";
                                    break;
                                case 'apartment-sale':
                                    return "خرید و فروش خانه و آپارتمان";
                                    break;
                                case 'villa-short-rent':
                                    return "اجاره کوتاه مدت ویلا، سوئیت";
                                    break;
                                case 'commercial-rent':
                                    return "رهن و اجاره اداری، تجاری و صنعتی";
                                    break;
                                case 'commercial-sale':
                                    return "خرید و فروش اداری، تجاری و صنعتی";
                                    break;
                                case 'land':
                                    return "زمین و باغ";
                                    break;
                                case 'pre-sale':
                                    return "پیش فروش و مشارکت در ساخت";
                                    break;

                                default:
                                    break;
                            }
                        }
                        ?>


                        @if(isset($properties))
                        @foreach($properties as $p)

                        <?php
                        $media = [""];
                        $cat = $p->category;
                        if (isset($p->media) && count(json_decode($p->media)) > 0) {
                            $media = json_decode($p->media);
                        }

                        ?>

                        @include("peroperty.vendor.".$cat)

                        @endforeach

                        @else

                        <div class="col-12 text-center py-5">
                            <p class="text-muted fs-5">این مشاور هنوز هیچ آگهی ثبت نکرده است.</p>
                        </div>
                        @endif








                    </div>

                    <!-- Pagination -->
                    <div class="mt-5">
                        {{ $properties->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal ارسال پیام -->
        <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ارسال پیام به {{ $agent->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" rows="6" placeholder="متن پیام خود را اینجا بنویسید..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        <button type="button" class="btn btn-primary">ارسال پیام</button>
                    </div>
                </div>
            </div>
        </div>





        @include('partials.home.footer')



        <script src="{{ url('/') }}/vendor/jquery-3.6.0.js"></script>

        <script>
            $(document).ready(function() {
                $('#sortby').on('change', function() {
                    const sortValue = $(this).val();
                    const agentId = "{{ $agent->tel }}";

                    window.location.href = "{{ url('/agent') }}/{{ $agent->tel }}/" + sortValue;
                });
            });
        </script>