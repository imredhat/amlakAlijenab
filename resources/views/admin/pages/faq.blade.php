@include('admin.parts.header')

<style>
    body { direction: rtl; text-align: right; }
    .section-card { border-right: 4px solid #0d6efd; }
    .faq-card {
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
    .add-btn { margin-top: 8px; }
</style>

<div class="container-fluid mt-4 mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fi-info-circle me-2"></i>مدیریت سوالات متداول (FAQ)</h5>
            <a href="{{ url('/admin/dashboard') }}" class="btn btn-light btn-sm">بازگشت</a>
        </div>

        <div class="card-body p-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ url('/admin/page/faqs') }}" method="POST">
                @csrf
                @method('PUT') {{-- چون تک صفحه‌ای است و همیشه آپدیت می‌کنیم --}}

                {{-- بخش اصلی مدیریت سوالات --}}
                <div class="card section-card mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-primary">📋 سوالات متداول</h6>

                        <div id="faqs-container">
                            @php
                                $faqs = $faqs ?? old('faqs', \App\Models\FAQ::ordered()->get());
                            @endphp

                            @foreach($faqs as $i => $faq)
                                <div class="faq-card" id="faq-{{ $i }}">
                                    <button type="button" class="btn btn-danger btn-xs remove-btn" 
                                            onclick="removeFaq({{ $i }})">×</button>

                                    <input type="hidden" name="delete_faq[]" id="del-{{ $i }}" value="0">

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">دسته‌بندی</label>
                                            <input type="text" name="category[{{ $i }}]" 
                                                   class="form-control"
                                                   value="{{ $faq->category ?? '' }}"
                                                   placeholder="مثال: مستاجران و اجاره‌ها">
                                        </div>

                                        <div class="col-md-9 mb-3">
                                            <label class="form-label">سوال *</label>
                                            <input type="text" name="question[{{ $i }}]" 
                                                   class="form-control"
                                                   value="{{ $faq->question ?? '' }}" required>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label">پاسخ *</label>
                                            <textarea name="answer[{{ $i }}]" 
                                                      class="form-control" 
                                                      rows="4" required>{{ $faq->answer ?? '' }}</textarea>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">ترتیب نمایش</label>
                                            <input type="number" name="order[{{ $i }}]" 
                                                   class="form-control"
                                                   value="{{ $faq->order ?? $i }}" min="0">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">وضعیت</label>
                                            <select name="is_active[{{ $i }}]" class="form-select">
                                                <option value="1" {{ ($faq->is_active ?? true) ? 'selected' : '' }}>فعال</option>
                                                <option value="0" {{ !($faq->is_active ?? true) ? 'selected' : '' }}>غیرفعال</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-outline-primary btn-sm add-btn" onclick="addFaq()">
                            + افزودن سوال جدید
                        </button>
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
let faqCount = {{ count($faqs ?? []) }};

function removeFaq(index) {
    const card = document.getElementById('faq-' + index);
    if (card) {
        card.style.display = 'none';
        const delInput = document.getElementById('del-' + index);
        if (delInput) delInput.value = '1'; // علامت حذف
    }
}

function addFaq() {
    const i = faqCount++;
    const container = document.getElementById('faqs-container');

    const div = document.createElement('div');
    div.className = 'faq-card';
    div.id = 'faq-' + i;
    div.innerHTML = `
        <button type="button" class="btn btn-danger btn-xs remove-btn" onclick="removeFaq(${i})">×</button>
        <input type="hidden" name="delete_faq[]" id="del-${i}" value="0">

        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">دسته‌بندی</label>
                <input type="text" name="category[${i}]" class="form-control" placeholder="مثال: خریداران ملک">
            </div>

            <div class="col-md-9 mb-3">
                <label class="form-label">سوال *</label>
                <input type="text" name="question[${i}]" class="form-control" required>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">پاسخ *</label>
                <textarea name="answer[${i}]" class="form-control" rows="4" required></textarea>
            </div>

            <div class="col-md-3">
                <label class="form-label">ترتیب نمایش</label>
                <input type="number" name="order[${i}]" class="form-control" value="${i}" min="0">
            </div>

            <div class="col-md-3">
                <label class="form-label">وضعیت</label>
                <select name="is_active[${i}]" class="form-select">
                    <option value="1" selected>فعال</option>
                    <option value="0">غیرفعال</option>
                </select>
            </div>
        </div>`;
    
    container.appendChild(div);
}
</script>

@include('admin.parts.footer')