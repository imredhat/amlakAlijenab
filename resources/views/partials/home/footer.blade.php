<footer class="footer bg-secondary pt-5">
      <div class="container pt-lg-4 pb-4">
        <!-- Links-->
        <div class="row mb-5 pb-md-3 pb-lg-4 d-none d-md-flex">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="d-flex flex-sm-row flex-column justify-content-between mx-n2">
              <div class="mb-sm-0 mb-4 px-2"><a class="d-inline-block mb-4" href="{{ url('/') }}"><img src="{{ url('/') }}{{ $siteLogo }}" width="116" alt="logo"></a>
                <ul class="nav flex-column mb-sm-4 mb-2">
                  @if(isset($footerContact) && $footerContact)
                    <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="mailto:{{ $footerContact->value1 ?? '' }}"><i class="fi-mail mt-n1 me-2 align-middle opacity-70"></i>{{ $footerContact->value1 ?? '' }}</a></li>
                    <li class="nav-item"><a class="nav-link p-0 fw-normal" href="tel:{{ $footerContact->value2 ?? '' }}"><i class="fi-device-mobile mt-n1 me-2 align-middle opacity-70"></i>{{ $footerContact->value2 ?? '' }}</a></li>
                  @else
                    <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="#"><i class="fi-mail mt-n1 me-2 align-middle opacity-70"></i>example@email.com</a></li>
                    <li class="nav-item"><a class="nav-link p-0 fw-normal" href="#"><i class="fi-device-mobile mt-n1 me-2 align-middle opacity-70"></i>(406) 555-0120</a></li>
                  @endif
                </ul>
                <div class="pt-2"><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="#"><i class="fi-facebook"></i></a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="#"><i class="fi-twitter"></i></a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="#"><i class="fi-viber"></i></a><a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="#"><i class="fi-telegram"></i></a></div>
              </div>
              <div class="mb-sm-0 mb-4 px-2">
                <h4 class="h5">لینک های سریع</h4>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/property/type/sale') }}">خرید یک ملک</a></li>
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/property/type/sale') }}">فروش یک ملک</a></li>
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/property/type/rent') }}">اجاره یک ملک</a></li>
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/property/add') }}">ثبت ملک</a></li>
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/blog') }}">مجله</a></li>
                </ul>
              </div>
              <div class="px-2">
                <h4 class="h5">درباره</h4>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/page/about') }}">درباره ما</a></li>
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/agents') }}">نمایندگان ما</a></li>
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/page/contact') }}">تماس با ما</a></li>
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/blog') }}">اخبار</a></li>
                  <li class="nav-item mb-2"><a class="nav-link p-0 fw-normal" href="{{ url('/page/faqs') }}">سوالات متداول</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-5 col-lg-6 offset-xl-1">
            <h4 class="h5">بلاگ های اخیر</h4>
            @if(isset($footerBlogs) && $footerBlogs->count() > 0)
              @foreach($footerBlogs as $blog)
              <article class="d-flex align-items-start" style="max-width: 640px;">
                @if($blog->image)
                <a class="d-none d-sm-block flex-shrink-0 me-sm-4 mb-sm-0 mb-3" href="{{ url('/blog/'.$blog->slug) }}">
                  <img class="rounded-3" src="{{ url('/') }}{{ $blog->image }}" width="100" height="70" style="object-fit: cover;" alt="{{ $blog->title }}">
                </a>
                @endif
                <div>
                  @if($blog->category)
                  <h6 class="mb-1 fs-sm fw-normal text-uppercase text-primary">{{ $blog->category }}</h6>
                  @endif
                  <h5 class="mb-2 fs-base"><a class="nav-link" href="{{ url('/blog/'.$blog->slug) }}">{{ Str::limit($blog->title, 50) }}</a></h5>
                  @if($blog->summary)
                  <p class="mb-2 fs-sm">{{ Str::limit($blog->summary, 80) }}</p>
                  @endif
                  @if($blog->published_at)
                  <a class="nav-link nav-link-muted d-inline-block me-3 p-0 fs-xs fw-normal"><i class="fi-calendar mt-n1 me-1 fs-sm align-middle opacity-70"></i>{{ verta($blog->published_at)->format('Y/m/d') }}</a>
                  @endif
                </div>
              </article>
              @if(!$loop->last)
              <hr class="text-dark opacity-10 my-4">
              @endif
              @endforeach
            @else
              <p class="text-muted fs-sm">هنوز مقاله‌ای منتشر نشده است.</p>
            @endif
          </div>
        </div>
        <div class="text-center fs-sm pt-4 mt-3 pb-2">&copy; تمام حقوق این سایت محفوظ است.</div>
      </div>
    </footer>
    <!-- Back to top button-->
     <a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted fs-sm ms-2">بالا</span><i class="btn-scroll-top-icon fi-chevron-up">   </i></a>
    <!-- Vendor scrits: {{ url('') }}/js/ libraries and plugins-->
    <script src="{{ url('') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ url('') }}/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="{{ url('') }}/vendor/nouislider/dist/nouislider.min.js"></script>
    <script src="{{ url('') }}/vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <!-- Main theme script-->
    <script src="{{ url('') }}/js/theme.min.js"></script>
    <style>

    .tns-liveregion.tns-visually-hidden {
    display: none;
}
    .favorite-btn.is-favorited {
        background-color: #e74c3c !important;
        border-color: #e74c3c !important;
    }
    .favorite-btn.is-favorited i {
        color: #fff !important;
    }
    </style>

    <script>
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.favorite-btn');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();

        var propertyId = btn.getAttribute('data-property-id');
        if (!propertyId) return;

        fetch('{{ url("/user/favorite/toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ property_id: propertyId })
        })
        .then(function(res) {
            if (res.status === 401) {
                var modal = document.getElementById('signin-modal');
                if (modal) {
                    var bsModal = new bootstrap.Modal(modal);
                    bsModal.show();
                } else {
                    window.location.href = '{{ url("/auth/login") }}';
                }
                return;
            }
            return res.json();
        })
        .then(function(data) {
            if (!data) return;
            if (data.status === 'added') {
                btn.classList.add('is-favorited');
            } else {
                btn.classList.remove('is-favorited');
            }
        })
        .catch(function() {});
    });

    // Mark already-favorited buttons on page load
    document.addEventListener('DOMContentLoaded', function() {
        var favoriteIds = @json($favoriteIds ?? []);
        if (favoriteIds.length > 0) {
            document.querySelectorAll('.favorite-btn').forEach(function(btn) {
                var pid = btn.getAttribute('data-property-id');
                if (pid && favoriteIds.indexOf(parseInt(pid)) !== -1) {
                    btn.classList.add('is-favorited');
                }
            });
        }
    });
    </script>
  </body>

</html>
