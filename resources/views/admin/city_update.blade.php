{{-- resources/views/admin/cities/edit.blade.php --}}

{{-- شامل هدر اصلی --}}
@include('admin.parts.header')

{{-- اسکریپت‌ها و استایل‌های مورد نیاز --}}
<script src="{{url('/')}}/assets/js/jquery-3.6.0.min.js"></script>
<script src="{{url('/')}}/assets/js/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/assets/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{url('/')}}/assets/css/jquery.dataTables.min.css">
<script src="{{ url ('/') }}/assets/js/sidebar-menu.js"></script>
<script src="{{ url ('/') }}/assets/js/custom/custom.js"></script>

{{-- استایل‌های سفارشی --}}
<style>
    body {
        direction: rtl;
        text-align: right;
    }

    .image-preview-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        border: 1px solid #ccc;
        margin-top: 10px;
        margin-bottom: 10px;
        background-color: #f8f8f8;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .image-preview-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .image-preview-wrapper .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(255, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10;
        /* اطمینان از اینکه روی تصویر قرار گیرد */
    }

    /* برای اطمینان از اینکه برچسب دکمه فایل زیر عکس قرار نگیرد */
    .custom-file-upload {
        display: block;
        margin-top: 5px;
    }

    /* استایل برای کارت و فیلدها */
    .card {
        margin-top: 20px;
        /* فاصله از بالای صفحه */
        margin-bottom: 20px;
    }

    .card-header {
        border-radius: 0.3rem 0.3rem 0 0;
        /* گوشه های گرد برای هدر */
    }

    .form-label {
        font-weight: bold;
        /* پررنگ کردن برچسب ها */
    }

    .invalid-feedback {
        font-size: 0.875em;
        /* اندازه کوچکتر برای پیام خطا */
    }
</style>

{{-- محتوای اصلی صفحه --}}
<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0">
        {{-- هدر کارت --}}
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            {{-- عنوان ویو ویرایش --}}
            <h5 class="mb-0">ویرایش شهر: {{ $city->name }}</h5>
            {{-- دکمه بازگشت --}}
            <a href="{{ route('city.index') }}" class="btn btn-light btn-sm">بازگشت به لیست</a>
        </div>

        {{-- بدنه کارت --}}
        <div class="card-body">

            {{-- نمایش پیام موفقیت --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- فرم ویرایش --}}
            {{-- توجه: برای ویرایش از POST با _method: PUT استفاده می‌کنیم --}}
            <form action="{{ route('city.update', $city->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST') {{-- یا PATCH، بسته به Route::resource شما --}}

                <div class="row">

                    {{-- فیلد نام شهر --}}
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">نام شهر</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $city->name) }}"
                            required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">ترتیب</label>
                        <input
                            type="text"
                            name="order"
                            id="order"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('order', $city->order) }}"
                            required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- فیلد تصویر شهر --}}
                    <div class="col-md-6 mb-3">
                        <label for="imageUpload" class="form-label">تصویر شهر</label>
                        <input
                            type="file"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror"
                            id="imageUpload"
                            accept="image/*">

                        {{-- پیش‌نمایش عکس فعلی --}}
                        @if ($city->image)
                        <div id="currentImagePreviewContainer" class="image-preview-wrapper mt-2">
                            <img src="{{url('/')}}{{ $city->image }}" alt="تصویر" width="100%" height="100%" class="rounded">
                            {{-- دکمه حذف عکس فعلی (اگر لازم است) --}}
                            {{-- <button type="button" class="remove-image" onclick="removeCurrentImage({{ $city->id }})">X</button> --}}
                        </div>
                        @endif

                        {{-- پیش‌نمایش تصویر جدید --}}
                        <div id="newImagePreviewContainer" class="image-preview-wrapper" style="display: none;">
                            <img id="newImagePreview" src="#" alt="پیش‌نمایش تصویر جدید">
                            <button type="button" class="remove-image" onclick="removeNewImagePreview()">X</button>
                        </div>

                        @error('image')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div> {{-- نمایش خطا --}}
                        @enderror
                    </div>

                </div>

                {{-- دکمه ذخیره --}}
                <button type="submit" class="btn btn-success w-100 py-2 mt-3">ذخیره تغییرات</button>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript برای پیش‌نمایش تصویر --}}
<script>
    const imageUpload = document.getElementById('imageUpload');
    const newImagePreview = document.getElementById('newImagePreview');
    const newImagePreviewContainer = document.getElementById('newImagePreviewContainer');

    // تابع برای نمایش پیش‌نمایش تصویر جدید
    imageUpload.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                newImagePreview.src = e.target.result;
                newImagePreviewContainer.style.display = 'flex';
                // اگر عکس فعلی وجود دارد، آن را مخفی کن تا فقط پیش‌نمایش جدید دیده شود
                const currentImageContainer = document.getElementById('currentImagePreviewContainer');
                if (currentImageContainer) {
                    currentImageContainer.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        } else {
            // اگر فایلی انتخاب نشده یا پاک شده، کانتینر پیش‌نمایش جدید را مخفی کن
            removeNewImagePreview();
        }
    });

    // تابع برای حذف پیش‌نمایش تصویر جدید
    function removeNewImagePreview() {
        imageUpload.value = ''; // پاک کردن مقدار input file
        newImagePreviewContainer.style.display = 'none';
        newImagePreview.src = '#';

        // نمایش مجدد عکس فعلی در صورت وجود
        const currentImageContainer = document.getElementById('currentImagePreviewContainer');
        if (currentImageContainer) {
            currentImageContainer.style.display = 'flex';
        }
    }

    // تابع اختیاری برای حذف عکس فعلی از دیتابیس (اگر نیاز باشد)
    function removeCurrentImage(cityId) {
        if (confirm('آیا از حذف عکس فعلی مطمئن هستید؟')) {
            // باید یک route و متد در کنترلر برای حذف عکس ایجاد کنید
            fetch(`/admin/cities/${cityId}/remove-image`, {
                    method: 'POST',
                    ...
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('currentImagePreviewContainer').style.display = 'none';
                    }
                });
        }
    }

    // اگر در فرم، خطا وجود داشت و نیاز بود که صفحه با همان خطا و عکس فعلی بارگذاری شود
    // اطمینان حاصل کنید که عکس فعلی نمایش داده می‌شود
    document.addEventListener('DOMContentLoaded', (event) => {
        const hasError = document.querySelector('.is-invalid');
        const currentImageContainer = document.getElementById('currentImagePreviewContainer');
        if (hasError && currentImageContainer) {
            // اگر خطایی وجود دارد و عکس فعلی هست، آن را نمایش بده
            if (!imageUpload.value) { // اگر فایل جدیدی آپلود نشده
                currentImageContainer.style.display = 'flex';
            } else { // اگر فایل جدید آپلود شده اما خطا دارد
                newImagePreviewContainer.style.display = 'flex';
            }
        } else if (currentImageContainer && !imageUpload.value) {
            // اگر خطایی نیست و عکس فعلی وجود دارد، نمایش بده
            currentImageContainer.style.display = 'flex';
        }
    });
</script>