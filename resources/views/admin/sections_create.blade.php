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
</style>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">افزودن Section جدید</h5>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">موقعیت</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">عنوان</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                 

                    <div class="col-12 mb-3">
                        <label class="form-label">توضیحات</label>
                        <textarea name="desc" class="form-control" rows="3"></textarea>
                    </div>

                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">عنوان لینک</label>
                        <input type="text" name="link_title" class="form-control">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">لینک</label>
                        <input type="text" name="link" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">آپلود تصویر</label>
                        <input type="file" name="pic" class="form-control" id="pic-input">
                    </div>

                    <div class="col-md-4 mt-2">
                        <img id="preview-image" class="image-preview" alt="Preview">
                    </div>

                </div>

                <button type="submit" class="btn btn-success w-100 py-2 mt-3">ثبت اطلاعات</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('pic-input').addEventListener('change', function (event) {
        const preview = document.getElementById('preview-image');
        const file = event.target.files[0];

        if (file) {
            preview.style.display = "block";
            preview.src = URL.createObjectURL(file);
        } else {
            preview.style.display = "none";
            preview.src = "";
        }
    });
</script>

