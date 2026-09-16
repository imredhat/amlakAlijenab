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
                <li class="breadcrumb-item active">مشاوران املاک</li>
            </ol>
        </nav>

        <h1 class="h2 mb-4">مشاوران املاک</h1>

        <div class="row g-4">
            @php
                $agents = \App\Models\User::where('is_agent', true)->paginate(12);
            $agentCount = \App\Models\User::where('is_agent', true)->count();
            $locations = \App\Models\Neighborhood::where('showInMenu', true)->get();
            $selectedLocation = request()->query('location');
            $selectedSort = request()->query('sort', 'newest');

            // Apply location filter if selected
            if ($selectedLocation) {
                $agents = \App\Models\User::where('is_agent', true)
                    ->where('address', 'like', '%' . $selectedLocation . '%')
                    ->paginate(12);
            }

            // Apply sorting
            if ($selectedSort === 'name') {
                $agents = $agents->sortBy(function($agent) {
                    return $agent->name . ' ' . ($agent->lname ?? '');
                });
            }
            @endphp

            <!-- Sidebar -->
            <aside class="col-lg-3 col-md-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">فیلترها</h5>

                        <!-- Location Filter -->
                        <div class="mb-4">
                            <label class="form-label mb-2">موقعیت</label>
                            <select class="form-select" id="locationFilter">
                                <option value="">همه موقعیت ها</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->name }}" {{ $selectedLocation === $location->name ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sorting -->
                        <div class="mb-4">
                            <label class="form-label mb-2">مرتب سازی</label>
                            <select class="form-select" id="sortFilter">
                                <option value="newest" {{ $selectedSort === 'newest' ? 'selected' : '' }}>جدیدترین</option>
                                <option value="name" {{ $selectedSort === 'name' ? 'selected' : '' }}>بر اساس نام</option>
                            </select>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Agents List -->
            <div class="col-lg-9 col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="text-muted fs-sm">
                        {{ $agentCount }} مشاور یافت شد
                    </div>
                </div>

                <div class="row g-4">
                    @foreach($agents as $agent)
                    <div class="col-sm-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <img style="height: 90px !important" class="d-block rounded-circle mx-auto mb-3 shadow-sm"
                                     src="{{ !empty($agent->avatar) ? asset('upload/user/' . $agent->id . '/' . $agent->avatar) : asset('img/avatars/default-agent.jpg') }}"
                                     width="100" height="100" alt="{{ $agent->name }}">
                                <h5 class="mb-1">{{ $agent->name }} {{ $agent->lname ?? '' }}</h5>
                                <p class="text-muted mb-3">{{ $agent->agency_name ?? 'مشاور املاک' }}</p>
                                <div class="d-flex justify-content-center mb-3">
                                    <span class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="star-rating-icon fi-star-filled active"></i>
                                        @endfor
                                    </span>
                                </div>
                                <a href="{{ url('/agent/' . $agent->tel) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fi-user me-2"></i>مشاهده پروفایل
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5">
                    {{ $agents->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.home.footer')

<script>
    $(document).ready(function() {
        // Location filter
        $('#locationFilter').on('change', function() {
            const location = $(this).val();
            const sort = $('#sortFilter').val();
            const query = {};

            if (location) query.location = location;
            if (sort) query.sort = sort;

            window.location.href = '{{ url("/agents") }}?' + $.param(query);
        });

        // Sort filter
        $('#sortFilter').on('change', function() {
            const sort = $(this).val();
            const location = $('#locationFilter').val();
            const query = {};

            if (location) query.location = location;
            if (sort) query.sort = sort;

            window.location.href = '{{ url("/agents") }}?' + $.param(query);
        });
    });
</script>