@include('admin.parts.header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fs-18 mb-0">لیست آگهی‌ها</h4>
                   
                </div>

                {{-- دکمه‌های فیلتر --}}
                <div class="filter-buttons mb-4">
                    <div class="btn-group flex-wrap gap-2">
                        <a href="javascript:void(0)" 
                           class="btn btn-sm filter-btn {{ request()->query('q', 'all') == 'all' ? 'btn-primary active' : 'btn-outline-primary' }}" 
                           data-filter="all">
                            <i class="fi-list me-1"></i> همه آگهی‌ها
                        </a>
                        <a href="javascript:void(0)" 
                           class="btn btn-sm filter-btn {{ request()->query('q') == 'accepted' ? 'btn-success active' : 'btn-outline-success' }}" 
                           data-filter="accepted">
                            <i class="fi-check-circle me-1"></i> تایید شده‌ها
                        </a>
                        <a href="javascript:void(0)" 
                           class="btn btn-sm filter-btn {{ request()->query('q') == 'notaccepted' ? 'btn-warning active' : 'btn-outline-warning' }}" 
                           data-filter="notaccepted">
                            <i class="fi-clock me-1"></i> در انتظار تایید
                        </a>
                        <a href="javascript:void(0)" 
                           class="btn btn-sm filter-btn {{ request()->query('q') == 'expired' ? 'btn-danger active' : 'btn-outline-danger' }}" 
                           data-filter="expired">
                            <i class="fi-x-circle me-1"></i> رد شده‌ها
                        </a>
                    </div>
                    
                    {{-- نمایش آمار --}}
                    <div class="mt-3" id="stats-wrapper">
                        <small class="text-muted">
                            <i class="fi-info-circle"></i> 
                            <span id="stats-text">در حال بارگذاری آمار...</span>
                        </small>
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
// متغیر برای نگهداری فیلتر فعلی
let currentFilter = '{{ request()->query("q", "all") }}';

// لود جدول آگهی‌ها با Ajax
function loadPropertyTable(url) {
    const wrapper = document.getElementById('property-table-wrapper');
    if (!wrapper) return;

    let defaultUrl = wrapper.getAttribute('data-list-url') || '/admin/property/list';
    
    // اضافه کردن فیلتر به URL
    if (currentFilter && currentFilter !== 'all') {
        const separator = defaultUrl.includes('?') ? '&' : '?';
        defaultUrl = `${defaultUrl}${separator}q=${encodeURIComponent(currentFilter)}`;
    }
    
    const finalUrl = url || defaultUrl;

    wrapper.innerHTML = `
        <div class="d-flex justify-content-center align-items-center py-5 text-muted">
            <div class="spinner-border text-primary ms-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            در حال بارگذاری لیست آگهی‌ها...
        </div>
    `;

    fetch(finalUrl, {
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
            
            // بروزرسانی URL بدون ریلود صفحه
            const newUrl = new URL(window.location.href);
            if (currentFilter && currentFilter !== 'all') {
                newUrl.searchParams.set('q', currentFilter);
            } else {
                newUrl.searchParams.delete('q');
            }
            window.history.pushState({}, '', newUrl);
            
            // به‌روزرسانی کلاس active دکمه‌ها
            updateActiveFilterButton();
            
            // لود آمار
            loadStats();
            
            // اگر از feather icons استفاده می‌کنید
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

// لود آمار وضعیت آگهی‌ها
function loadStats() {
    const statsWrapper = document.getElementById('stats-wrapper');
    if (!statsWrapper) return;
    
    fetch('/admin/property/stats', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.error) {
            statsWrapper.innerHTML = `
                <small class="text-muted">
                    <i class="fi-info-circle"></i> 
                    <span>مجموع: ${data.all} | </span>
                    <span class="text-success">تایید شده: ${data.accepted} | </span>
                    <span class="text-warning">در انتظار: ${data.notaccepted} | </span>
                    <span class="text-danger">رد شده: ${data.expired}</span>
                </small>
            `;
        }
    })
    .catch(error => {
        console.error('Error loading stats:', error);
    });
}

// به‌روزرسانی کلاس active دکمه‌های فیلتر
function updateActiveFilterButton() {
    document.querySelectorAll('.filter-btn').forEach(btn => {
        const filterValue = btn.getAttribute('data-filter');
        if (filterValue === currentFilter) {
            btn.classList.add('active');
            // تغییر کلاس‌های رنگ
            if (filterValue === 'all') {
                btn.classList.remove('btn-outline-primary');
                btn.classList.add('btn-primary');
            } else if (filterValue === 'accepted') {
                btn.classList.remove('btn-outline-success');
                btn.classList.add('btn-success');
            } else if (filterValue === 'notaccepted') {
                btn.classList.remove('btn-outline-warning');
                btn.classList.add('btn-warning');
            } else if (filterValue === 'expired') {
                btn.classList.remove('btn-outline-danger');
                btn.classList.add('btn-danger');
            }
        } else {
            btn.classList.remove('active');
            // برگرداندن کلاس‌های اولیه
            if (filterValue === 'all') {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-outline-primary');
            } else if (filterValue === 'accepted') {
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-success');
            } else if (filterValue === 'notaccepted') {
                btn.classList.remove('btn-warning');
                btn.classList.add('btn-outline-warning');
            } else if (filterValue === 'expired') {
                btn.classList.remove('btn-danger');
                btn.classList.add('btn-outline-danger');
            }
        }
    });
}

// تغییر فیلتر
function changeFilter(filter) {
    currentFilter = filter;
    loadPropertyTable();
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
    
    let confirmMessage = status === 'تایید شده' ? 'آیا از تایید این آگهی مطمئن هستید؟' : 'آیا از رد این آگهی مطمئن هستید؟';
    if (!confirm(confirmMessage)) {
        return;
    }

    fetch('/admin/property/status/' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ status: status }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // بعد از تغییر وضعیت، جدول دوباره لود می‌شود
                loadPropertyTable();
                // نمایش پیام موفقیت
                showToast('success', data.message || 'وضعیت آگهی با موفقیت تغییر کرد');
            } else {
                showToast('error', data.message || 'خطا در به‌روزرسانی وضعیت');
            }
        })
        .catch(error => {
            showToast('error', 'خطا در به‌روزرسانی وضعیت آگهی. لطفاً دوباره تلاش کنید.');
            console.error('Error updating property status:', error);
        });
}

// نمایش پیام toast (اگر toastr ندارید، می‌توانید از alert استفاده کنید)
function showToast(type, message) {
    if (typeof toastr !== 'undefined') {
        if (type === 'success') {
            toastr.success(message);
        } else {
            toastr.error(message);
        }
    } else {
        alert(message);
    }
}

// باز کردن مودال و لود جزئیات آگهی
function openPropertyModal(event, id) {
    event.preventDefault();

    const modalEl = document.getElementById('propertyModal');
    const modalBody = document.getElementById('propertyModalBody');

    modalBody.innerHTML = `
        <div class="d-flex justify-content-center align-items-center py-5 text-muted">
            <div class="spinner-border text-primary ms-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            در حال بارگذاری جزئیات آگهی...
        </div>
    `;

    const bsModal = new bootstrap.Modal(modalEl);
    bsModal.show();

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

// لود اولیه جدول بعد از آماده شدن صفحه
document.addEventListener('DOMContentLoaded', function () {
    loadPropertyTable();
    loadStats();
    
    // رویداد برای دکمه‌های فیلتر
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const filter = this.getAttribute('data-filter');
            changeFilter(filter);
        });
    });
});

// هندل کلیک روی لینک‌های صفحه‌بندی داخل جدول (Ajax)
document.addEventListener('click', function (e) {
    const wrapper = document.getElementById('property-table-wrapper');
    if (!wrapper) return;

    const link = e.target.closest('.pagination a');
    if (link && wrapper.contains(link)) {
        e.preventDefault();
        const url = link.getAttribute('href');
        if (url) {
            loadPropertyTable(url);
        }
    }
});
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

.filter-buttons .btn-group {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.filter-buttons .btn {
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 13px;
    transition: all 0.3s ease;
}

.filter-buttons .btn.active {
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.filter-buttons .btn-outline-warning {
    color: #ffc107;
    border-color: #ffc107;
}

.filter-buttons .btn-outline-warning:hover {
    background-color: #ffc107;
    color: #000;
}

.filter-buttons .btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
}

.filter-buttons .btn-outline-danger:hover {
    background-color: #dc3545;
    color: #fff;
}
</style>

@include('admin.parts.footer')