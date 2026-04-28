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
            <h5 class="mb-0">ویرایش آیتم های تماس</h5>
        </div>

        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert alert-warning">{{ session('error') }}</div>
            @endif

            <form action="{{ url('/admin/page/contact') }}" method="POST">
                @csrf

                <div class="row">

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
    document.getElementById('pic-input').addEventListener('change', function(event) {
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



@include('admin.parts.footer')