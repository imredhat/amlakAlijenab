@include('admin.parts.header')



<script src="{{url('/')}}/assets/js/jquery-3.6.0.min.js"></script>
<script src="{{url('/')}}/assets/js/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/assets/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{url('/')}}/assets/css/jquery.dataTables.min.css">


<script src="{{ url ('/') }}/assets/js/sidebar-menu.js"></script>
<script src="{{ url ('/') }}/assets/js/custom/custom.js"></script>




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
        overflow: hidden; /* برای جلوگیری از بیرون زدن عکس */
    }
    .image-preview-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* یا 'cover' بسته به نیاز */
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
    }
     /* برای اطمینان از اینکه برچسب دکمه فایل زیر عکس قرار نگیرد */
    .custom-file-upload {
        display: block;
        margin-top: 5px;
    }
</style>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">افزودن شهر جدید</h5>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- اضافه کردن enctype برای آپلود فایل --}}
            <form action="{{ route('city.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- Name --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">نام شهر</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tag --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">تگ (اختیاری)</label>
                        <input
                            type="text"
                            name="tag"
                            class="form-control @error('tag') is-invalid @enderror"
                            value="{{ old('tag') }}">
                        @error('tag')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Order --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ترتیب نمایش</label>
                        <input
                            type="number"
                            name="order"
                            class="form-control @error('order') is-invalid @enderror"
                            value="{{ old('order', 0) }}"
                            required>
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image Upload Field --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">تصویر شهر</label>
                        <input
                            type="file"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror"
                            id="imageUpload"
                            accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="imagePreviewContainer" class="image-preview-wrapper" style="display: none;">
                            <img id="imagePreview" src="#" alt="پیش‌نمایش تصویر">
                            <button type="button" class="remove-image" onclick="removeImagePreview()">X</button>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-success w-100 py-2 mt-3">ثبت اطلاعات</button>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript برای پیش‌نمایش تصویر --}}
<script>
    const imageUpload = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');

    imageUpload.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewContainer.style.display = 'flex';
            }
            reader.readAsDataURL(file);
        } else {
            // اگر فایلی انتخاب نشده یا پاک شده، کانتینر را مخفی کن
            imagePreviewContainer.style.display = 'none';
            imagePreview.src = '#';
        }
    });

    function removeImagePreview() {
        imageUpload.value = ''; // پاک کردن مقدار input file
        imagePreviewContainer.style.display = 'none';
        imagePreview.src = '#';
    }
</script>
