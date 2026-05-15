@include('admin.parts.header')

<style>
    body { direction: rtl; text-align: right; }
    .section-card { border-right: 4px solid #0d6efd; }
    .member-card, .testimonial-card, .why-card, .step-card {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
        position: relative;
    }
    .remove-btn {
        position: absolute;
        top: 8px;
        left: 8px;
    }
    .image-preview {
        width: 100%;
        max-width: 150px;
        border-radius: 8px;
        border: 1px solid #ddd;
        object-fit: cover;
        margin-top: 8px;
        display: block;
    }
    .add-btn { margin-top: 8px; }
</style>

<div class="container-fluid mt-4 mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fi-info-circle me-2"></i>ویرایش صفحه درباره ما</h5>
            <a href="{{ url('/admin/dashboard') }}" class="btn btn-light btn-sm">بازگشت</a>
        </div>

        <div class="card-body p-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ url('/admin/page/about') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ===================== بخش هرو ===================== --}}
                <div class="card section-card mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-primary">📌 بخش هرو (Hero)</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">عنوان اصلی *</label>
                                <input type="text" name="hero_title" class="form-control"
                                    value="{{ $about->hero_title ?? 'درباره سایت' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">متن دکمه</label>
                                <input type="text" name="hero_button_text" class="form-control"
                                    value="{{ $about->hero_button_text ?? 'تماس با ما' }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">توضیحات هرو *</label>
                                <textarea name="hero_description" class="form-control" rows="4" required>{{ $about->hero_description ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">لینک دکمه</label>
                                <input type="text" name="hero_button_link" class="form-control"
                                    value="{{ $about->hero_button_link ?? '' }}" placeholder="/page/contact">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">تصاویر اسلایدر هرو (می‌توانید چند تصویر انتخاب کنید)</label>
                                <input type="file" name="hero_images[]" class="form-control" multiple accept="image/*">
                                @if(!empty($about->hero_images))
                                    <div class="d-flex flex-wrap gap-2 mt-2">
                                        @foreach($about->hero_images as $img)
                                            <img src="{{ url('/') }}{{ $img }}" class="image-preview" style="max-width:80px;height:60px;object-fit:cover;">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===================== دلایل انتخاب ===================== --}}
                <div class="card section-card mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-primary">✅ بخش دلایل انتخاب</h6>
                        <div class="mb-3">
                            <label class="form-label">عنوان بخش</label>
                            <input type="text" name="why_title" class="form-control"
                                value="{{ $about->why_title ?? 'دلیل انتخاب شرکت ما' }}">
                        </div>
                        <div id="why-items-container">
                            @php $whyItems = $about->why_items ?? [['icon_svg'=>'','title'=>'','description'=>''],['icon_svg'=>'','title'=>'','description'=>''],['icon_svg'=>'','title'=>'','description'=>'']]; @endphp
                            @foreach($whyItems as $i => $item)
                                <div class="why-card">
                                    <span class="badge bg-primary mb-2">آیتم {{ $i + 1 }}</span>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">عنوان</label>
                                            <input type="text" name="why_item_title[{{ $i }}]" class="form-control"
                                                value="{{ $item['title'] ?? '' }}">
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <label class="form-label">توضیحات</label>
                                            <textarea name="why_item_desc[{{ $i }}]" class="form-control" rows="2">{{ $item['description'] ?? '' }}</textarea>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">کد SVG آیکون (اختیاری)</label>
                                            <textarea name="why_icon_svg[{{ $i }}]" class="form-control" rows="2" placeholder="<svg ...>...</svg>">{{ $item['icon_svg'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ===================== مراحل همکاری ===================== --}}
                <div class="card section-card mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-primary">🔢 مراحل همکاری</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">عنوان بخش</label>
                                <input type="text" name="steps_title" class="form-control"
                                    value="{{ $about->steps_title ?? 'روند همکاری مشاوران املاک' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">تصویر کنار مراحل</label>
                                <input type="file" name="steps_image" class="form-control" accept="image/*">
                                @if(!empty($about->steps_image))
                                    <img src="{{ url('/') }}{{ $about->steps_image }}" class="image-preview">
                                @endif
                            </div>
                        </div>
                        <div id="steps-container">
                            @php $stepsItems = $about->steps_items ?? [['title'=>'','description'=>''],['title'=>'','description'=>''],['title'=>'','description'=>'']]; @endphp
                            @foreach($stepsItems as $i => $step)
                                <div class="step-card">
                                    <span class="badge bg-success mb-2">مرحله {{ $i + 1 }}</span>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">عنوان</label>
                                            <input type="text" name="step_title[{{ $i }}]" class="form-control"
                                                value="{{ $step['title'] ?? '' }}">
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <label class="form-label">توضیحات</label>
                                            <textarea name="step_desc[{{ $i }}]" class="form-control" rows="2">{{ $step['description'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ===================== تیم ===================== --}}
                <div class="card section-card mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-primary">👥 اعضای تیم</h6>
                        <div class="mb-3">
                            <label class="form-label">عنوان بخش تیم</label>
                            <input type="text" name="team_title" class="form-control"
                                value="{{ $about->team_title ?? 'مشاوران با تجربه سایت املاک' }}">
                        </div>
                        <div id="team-container">
                            @php $members = $about->team_members ?? []; @endphp
                            @foreach($members as $i => $member)
                                <div class="member-card" id="member-{{ $i }}">
                                    <button type="button" class="btn btn-danger btn-xs remove-btn"
                                        onclick="removeMember({{ $i }})">×</button>
                                    <input type="hidden" name="delete_member[]" id="del-{{ $i }}" disabled>
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">نام</label>
                                            <input type="text" name="member_name[{{ $i }}]" class="form-control"
                                                value="{{ $member['name'] ?? '' }}">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">سمت</label>
                                            <input type="text" name="member_role[{{ $i }}]" class="form-control"
                                                value="{{ $member['role'] ?? '' }}">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">عکس</label>
                                            <input type="file" name="member_photo[{{ $i }}]" class="form-control" accept="image/*">
                                            @if(!empty($member['photo']))
                                                <img src="{{ url('/') }}{{ $member['photo'] }}" class="image-preview" style="max-width:60px;height:60px;border-radius:50%;">
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">اینستاگرام</label>
                                            <input type="text" name="member_instagram[{{ $i }}]" class="form-control"
                                                value="{{ $member['instagram'] ?? '' }}" placeholder="username">
                                            <label class="form-label mt-1">تلگرام/توییتر</label>
                                            <input type="text" name="member_twitter[{{ $i }}]" class="form-control"
                                                value="{{ $member['twitter'] ?? '' }}" placeholder="username">
                                            <label class="form-label mt-1">فیسبوک</label>
                                            <input type="text" name="member_facebook[{{ $i }}]" class="form-control"
                                                value="{{ $member['facebook'] ?? '' }}" placeholder="username">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm add-btn" onclick="addMember()">
                            + افزودن عضو جدید
                        </button>
                    </div>
                </div>

                {{-- ===================== نظرات ===================== --}}
                <div class="card section-card mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-primary">💬 نظرات مشتریان</h6>
                        <div class="mb-3">
                            <label class="form-label">عنوان بخش نظرات</label>
                            <input type="text" name="testimonials_title" class="form-control"
                                value="{{ $about->testimonials_title ?? 'نظرات مشتریان' }}">
                        </div>
                        <div id="testimonials-container">
                            @php $testimonials = $about->testimonials ?? []; @endphp
                            @foreach($testimonials as $i => $t)
                                <div class="testimonial-card">
                                    <span class="badge bg-info mb-2">نظر {{ $i + 1 }}</span>
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">متن نظر</label>
                                            <textarea name="testimonial_text[{{ $i }}]" class="form-control" rows="3">{{ $t['text'] ?? '' }}</textarea>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">نام شرکت</label>
                                            <input type="text" name="testimonial_company[{{ $i }}]" class="form-control"
                                                value="{{ $t['company'] ?? '' }}">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">نام شخص</label>
                                            <input type="text" name="testimonial_person[{{ $i }}]" class="form-control"
                                                value="{{ $t['person_name'] ?? '' }}">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">سمت شخص</label>
                                            <input type="text" name="testimonial_role[{{ $i }}]" class="form-control"
                                                value="{{ $t['person_role'] ?? '' }}">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">لوگو شرکت</label>
                                            <input type="file" name="testimonial_logo[{{ $i }}]" class="form-control" accept="image/*">
                                            @if(!empty($t['logo']))
                                                <img src="{{ url('/') }}{{ $t['logo'] }}" class="image-preview" style="max-width:60px;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-info btn-sm add-btn" onclick="addTestimonial()">
                            + افزودن نظر جدید
                        </button>
                    </div>
                </div>

                {{-- ===================== CTA ===================== --}}
                <div class="card section-card mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-primary">🚀 بخش پایانی (CTA)</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">عنوان</label>
                                <input type="text" name="cta_title" class="form-control"
                                    value="{{ $about->cta_title ?? 'با اطمینان ملک بخرید' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">متن دکمه</label>
                                <input type="text" name="cta_button_text" class="form-control"
                                    value="{{ $about->cta_button_text ?? 'ملک خود را پیدا کن!' }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">توضیحات</label>
                                <textarea name="cta_description" class="form-control" rows="3">{{ $about->cta_description ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">لینک دکمه</label>
                                <input type="text" name="cta_button_link" class="form-control"
                                    value="{{ $about->cta_button_link ?? '/browse/apartment' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">تصویر تزئینی</label>
                                <input type="file" name="cta_image" class="form-control" accept="image/*">
                                @if(!empty($about->cta_image))
                                    <img src="{{ url('/') }}{{ $about->cta_image }}" class="image-preview">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 py-3 fs-5">
                    💾 ذخیره تمام تغییرات
                </button>
            </form>
        </div>
    </div>
</div>

<script>
let memberCount = {{ count($about->team_members ?? []) }};
let testimonialCount = {{ count($about->testimonials ?? []) }};

function removeMember(index) {
    const card = document.getElementById('member-' + index);
    if (card) {
        card.style.display = 'none';
        const delInput = document.getElementById('del-' + index);
        if (delInput) delInput.disabled = false;
    }
}

function addMember() {
    const i = memberCount++;
    const container = document.getElementById('team-container');
    const div = document.createElement('div');
    div.className = 'member-card';
    div.id = 'member-' + i;
    div.innerHTML = `
        <button type="button" class="btn btn-danger btn-xs remove-btn" onclick="removeMember(${i})">×</button>
        <input type="hidden" name="delete_member[]" id="del-${i}" disabled>
        <div class="row">
            <div class="col-md-3 mb-2">
                <label class="form-label">نام</label>
                <input type="text" name="member_name[${i}]" class="form-control">
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">سمت</label>
                <input type="text" name="member_role[${i}]" class="form-control">
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">عکس</label>
                <input type="file" name="member_photo[${i}]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">اینستاگرام</label>
                <input type="text" name="member_instagram[${i}]" class="form-control" placeholder="username">
                <label class="form-label mt-1">توییتر</label>
                <input type="text" name="member_twitter[${i}]" class="form-control" placeholder="username">
                <label class="form-label mt-1">فیسبوک</label>
                <input type="text" name="member_facebook[${i}]" class="form-control" placeholder="username">
            </div>
        </div>`;
    container.appendChild(div);
}

function addTestimonial() {
    const i = testimonialCount++;
    const container = document.getElementById('testimonials-container');
    const div = document.createElement('div');
    div.className = 'testimonial-card';
    div.innerHTML = `
        <span class="badge bg-info mb-2">نظر جدید</span>
        <div class="row">
            <div class="col-12 mb-2">
                <label class="form-label">متن نظر</label>
                <textarea name="testimonial_text[${i}]" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">نام شرکت</label>
                <input type="text" name="testimonial_company[${i}]" class="form-control">
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">نام شخص</label>
                <input type="text" name="testimonial_person[${i}]" class="form-control">
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">سمت</label>
                <input type="text" name="testimonial_role[${i}]" class="form-control">
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">لوگو</label>
                <input type="file" name="testimonial_logo[${i}]" class="form-control" accept="image/*">
            </div>
        </div>`;
    container.appendChild(div);
}
</script>

@include('admin.parts.footer')
