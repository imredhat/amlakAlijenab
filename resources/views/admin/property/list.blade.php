@include('admin.parts.header')

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fs-18 mb-0">لیست آگهی‌ها</h4>
                    <div>
                        <a href="" class="btn btn-primary btn-sm">
                            <i class="fi-plus me-1"></i> آگهی جدید
                        </a>
                    </div>
                </div>

                <div class="tab-pane fade show active" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
                    <div class="default-table-area members-list">
                        <div id="property-table-wrapper" data-list-url="{{ route('admin.property.list') }}">
                            {{-- جدول آگهی‌ها به صورت Ajax اینجا لود می‌شود --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>

{{-- Modal جزئیات آگهی --}}
<div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-16" id="propertyModalLabel">جزئیات آگهی</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
            </div>
            <div class="modal-body pt-2" id="propertyModalBody">
                <div class="d-flex justify-content-center align-items-center py-5 text-muted">
                    <div class="spinner-border text-primary ms-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    در حال بارگذاری جزئیات آگهی...
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// لود جدول آگهی‌ها با Ajax
function loadPropertyTable(url) {
    const wrapper = document.getElementById('property-table-wrapper');
    if (!wrapper) return;

    const defaultUrl = wrapper.getAttribute('data-list-url') || '/admin/property/list';

    wrapper.innerHTML = `
        <div class="d-flex justify-content-center align-items-center py-5 text-muted">
            <div class="spinner-border text-primary ms-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            در حال بارگذاری لیست آگهی‌ها...
        </div>
    `;

    fetch(url || defaultUrl, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            wrapper.innerHTML = html;

            // اگر از feather icons استفاده می‌کنید، بعد از لود دوباره اجرا شود
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        })
        .catch(error => {
            wrapper.innerHTML = `
                <div class="alert alert-danger mb-0">
                    خطا در بارگذاری لیست آگهی‌ها. لطفاً دوباره تلاش کنید.
                </div>
            `;
            console.error('Error loading property table:', error);
        });
}

// Share Property
function shareProperty(id) {
    const url = window.location.origin + '/p/' + id;
    if (navigator.share) {
        navigator.share({
            title: 'آگهی املاک',
            text: 'مشاهده آگهی املاک',
            url: url,
        });
    } else {
        copyLink(url);
        alert('لینک کپی شد!');
    }
}

// Copy Link
function copyLink(url) {
    navigator.clipboard.writeText(url).then(() => {
        alert('لینک در کلیپ‌بورد کپی شد!');
    });
}

// به‌روزرسانی وضعیت آگهی با Ajax
function updatePropertyStatus(id, status) {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = tokenMeta ? tokenMeta.getAttribute('content') : '';

    fetch('/admin/property/status/' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: new URLSearchParams({ status: status }).toString(),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json().catch(() => ({}));
        })
        .then(data => {
            // بعد از تغییر وضعیت، جدول دوباره لود می‌شود
            loadPropertyTable();
        })
        .catch(error => {
            alert('خطا در به‌روزرسانی وضعیت آگهی. لطفاً دوباره تلاش کنید.');
            console.error('Error updating property status:', error);
        });
}

// لود اولیه جدول بعد از آماده شدن صفحه
document.addEventListener('DOMContentLoaded', function () {
    loadPropertyTable();
});

// هندل کلیک روی لینک‌های صفحه‌بندی داخل جدول (Ajax)
document.addEventListener('click', function (e) {
    const wrapper = document.getElementById('property-table-wrapper');
    if (!wrapper) return;

    const link = e.target.closest('.pagination a');
    if (link && wrapper.contains(link)) {
        e.preventDefault();

        const wrapperEl = document.getElementById('property-table-wrapper');
        const defaultUrl = wrapperEl ? (wrapperEl.getAttribute('data-list-url') || '/admin/property/list') : '/admin/property/list';

        const page = link.getAttribute('data-page');
        if (page) {
            const separator = defaultUrl.includes('?') ? '&' : '?';
            const url = `${defaultUrl}${separator}page=${encodeURIComponent(page)}`;
            loadPropertyTable(url);
        }
    }
});

// باز کردن مودال و لود جزئیات آگهی
function openPropertyModal(event, id) {
    event.preventDefault();

    const modalEl = document.getElementById('propertyModal');
    const modalBody = document.getElementById('propertyModalBody');

    // متن لودینگ
    modalBody.innerHTML = `
        <div class="d-flex justify-content-center align-items-center py-5 text-muted">
            <div class="spinner-border text-primary ms-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            در حال بارگذاری جزئیات آگهی...
        </div>
    `;

    // نمایش مودال
    const bsModal = new bootstrap.Modal(modalEl);
    bsModal.show();

    // درخواست Ajax برای گرفتن HTML جزئیات آگهی
    fetch('/admin/property/view/' + id, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            modalBody.innerHTML = html;
        })
        .catch(error => {
            modalBody.innerHTML = `
                <div class="alert alert-danger mb-0">
                    خطا در بارگذاری جزئیات آگهی. لطفاً دوباره تلاش کنید.
                </div>
            `;
            console.error('Error loading property view:', error);
        });
}
</script>

<style>
.table-responsive {
    overflow-x: visible;
    -webkit-overflow-scrolling: touch;
}

.wh-44 {
    width: 44px;
    height: 44px;
    object-fit: cover;
}

.badge {
    font-size: 12px;
    padding: 4px 8px;
}
</style>

@include('admin.parts.footer')
