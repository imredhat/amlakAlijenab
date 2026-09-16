@include('admin.parts.header')


<style>
    body {
        direction: rtl;
        text-align: right;
    }

    .image-preview {
        width: 100%;
        max-width: 250px;
        border-radius: 10px;
        border: 1px solid #ddd;
        object-fit: cover;
        display: none;
    }

    .logo-upload-area {
        border: 2px dashed #ccc;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: #f8f9fa;
    }

    .logo-upload-area:hover {
        border-color: #7a6dff;
        background: #f0f0ff;
    }

    .logo-upload-area .upload-icon {
        font-size: 48px;
        color: #999;
        margin-bottom: 10px;
    }

    .logo-upload-area .upload-text {
        color: #666;
        font-size: 14px;
    }
</style>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">ویرایش آیتم های تماس</h5>
        </div>

        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert alert-warning">{{ session('error') }}</div>
            @endif

            <form action="{{ url('/admin/page/contact') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">لوگوی سایت</label>
                        <label class="logo-upload-area d-block" for="logo-input" id="logo-upload-label">
                            <div class="upload-icon"><i class="ri-image-add-line"></i></div>
                            <div class="upload-text" id="upload-text">کلیک کنید یا فایل را بکشید</div>
                            <div class="text-muted small">PNG, JPG, SVG</div>
                        </label>
                        <input type="file" name="logo" id="logo-input" accept="image/*" class="d-none">
                        @if(isset($contact->logo) && $contact->logo)
                            <small class="text-muted mt-2 d-block">تصویر فعلی</small>
                        @endif
                    </div>

                    <div class="col-md-4 mt-2">
                        <img id="preview-logo" class="image-preview rounded" alt="Preview"
                             src="{{ (isset($contact->logo) && $contact->logo) ? url('/') . $contact->logo : '' }}"
                             style="{{ (isset($contact->logo) && $contact->logo) ? 'display:block;' : 'display:none;' }}">
                    </div>

                    <div class="col-12 mb-3">
                        <hr>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">عنوان اول</label>
                        <input type="text" name="item1_title" class="form-control" required value="{{ $contact->item1_title }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">متن</label>
                        <input type="text" name="value1" class="form-control" required value="{{ $contact->value1 }}">
                    </div>



                    <div class="col-md-6 mb-3">
                        <label class="form-label">عنوان دوم</label>
                        <input type="text" name="item2_title" class="form-control" required value="{{ $contact->item2_title }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">متن</label>
                        <input type="text" name="value2" class="form-control" required value="{{ $contact->value2 }}">
                    </div>



                    <div class="col-md-6 mb-3">
                        <label class="form-label">عنوان سوم</label>
                        <input type="text" name="item3_title" class="form-control" required value="{{ $contact->item3_title }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">متن</label>
                        <input type="text" name="value3" class="form-control" required value="{{ $contact->value3 }}">
                    </div>



                    <input type="hidden" value="contact" name="slug" />





                </div>

                <button type="submit" class="btn btn-success w-100 py-2 mt-3">ثبت اطلاعات</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('logo-input').addEventListener('change', function(event) {
        const preview = document.getElementById('preview-logo');
        const uploadText = document.getElementById('upload-text');
        const uploadLabel = document.getElementById('logo-upload-label');
        const file = event.target.files[0];

        if (file) {
            preview.style.display = "block";
            preview.src = URL.createObjectURL(file);
            uploadText.textContent = file.name;
            uploadLabel.style.borderColor = '#28a745';
            uploadLabel.style.background = '#f0fff4';
        } else {
            preview.style.display = "none";
            preview.src = "";
            uploadText.textContent = 'کلیک کنید یا فایل را بکشید';
            uploadLabel.style.borderColor = '#ccc';
            uploadLabel.style.background = '#f8f9fa';
        }
    });
</script>



@include('admin.parts.footer')