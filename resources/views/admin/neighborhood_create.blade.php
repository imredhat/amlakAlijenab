@include('admin.parts.header')

<script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>
<script src="{{ url('/') }}/assets/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/assets/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{ url('/') }}/assets/css/jquery.dataTables.min.css">

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
    }
    
    .custom-file-upload {
        display: block;
        margin-top: 5px;
    }
    
    .required-star {
        color: red;
    }
</style>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">افزودن محله جدید</h5>
            <a href="{{ route('neighborhood.index') }}" class="btn btn-light btn-sm">بازگشت به لیست</a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('neighborhood.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- Name --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            نام محله <span class="required-star">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="مثال: الهیه"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- City Selection --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            نام شهر <span class="required-star">*</span>
                        </label>
                        <select
                            name="city_id"
                            class="form-control @error('city_id') is-invalid @enderror"
                            required>
                            <option value="">انتخاب شهر...</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
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
                            value="{{ old('tag') }}"
                            placeholder="مثال: شمال شهر">
                        @error('tag')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Order --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            ترتیب نمایش <span class="required-star">*</span>
                        </label>
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

                    <div class="col-md-6 mb-3">
                    <div class="form-check form-switch mt-4 pt-2">
                        <input 
                            type="checkbox" 
                            name="showInMenu" 
                            class="form-check-input" 
                            id="showInMenu" 
                            value="1"
                            {{ old('showInMenu') ? 'checked' : '' }}>
                        <label class="form-check-label" for="showInMenu">
                            نمایش در منو
                        </label>
                        <small class="text-muted d-block">در صورت فعال بودن، این محله در منوی اصلی سایت نمایش داده می‌شود</small>
                    </div>
                </div>

                    {{-- Image Upload Field --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">تصویر محله (اختیاری)</label>
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
                            <button type="button" class="remove-image" onclick="removeImagePreview()">×</button>
                        </div>
                        <small class="text-muted">فرمت‌های مجاز: jpeg, png, jpg, gif, svg (حداکثر 2 مگابایت)</small>
                    </div>

                </div>

                <button type="submit" class="btn btn-success w-100 py-2 mt-3">
                    <i class="fas fa-save"></i> ثبت اطلاعات
                </button>
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
            imagePreviewContainer.style.display = 'none';
            imagePreview.src = '#';
        }
    });

    function removeImagePreview() {
        imageUpload.value = '';
        imagePreviewContainer.style.display = 'none';
        imagePreview.src = '#';
    }
</script>