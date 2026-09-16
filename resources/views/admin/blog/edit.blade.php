@include('admin.parts.header')


<script src="{{url('/')}}/assets/js/jquery-3.6.0.min.js"></script>
<script src="{{url('/')}}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{url('/')}}/assets/js/quill.min.js"></script>

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
    }
    #editor {
        min-height: 300px;
        overflow: hidden;
        position: relative;
    }
    .ql-toolbar.ql-snow {
        z-index: 1;
        position: relative;
    }
    .ql-container.ql-snow {
        z-index: 0;
        position: relative;
    }
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }
    .file-input-wrapper input[type=file] {
        font-size: 16px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
    }
    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 8px 12px;
        border: 1px dashed #7a6dff;
        border-radius: 6px;
        background: rgba(122,109,255,0.05);
        color: #7a6dff;
        cursor: pointer;
        transition: all 0.2s;
        min-height: 38px;
    }
    .file-input-label:hover {
        background: rgba(122,109,255,0.12);
        border-color: #5b4fd6;
    }
</style>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">ویرایش مقاله</h5>
            <a href="{{ url('/admin/blog') }}" class="btn btn-light btn-sm">بازگشت</a>
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

            <form action="{{ url('/admin/blog/'.$blog->id.'/update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">عنوان مقاله *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">نامک (Slug) *</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $blog->slug) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">دسته‌بندی</label>
                        <input type="text" name="category" class="form-control" value="{{ old('category', $blog->category) }}" placeholder="مثال: اخبار، نکات، تحلیل بازار">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">برچسب‌ها (با کاما جدا کنید)</label>
                        <input type="text" name="tags" class="form-control" value="{{ old('tags', implode(',', $blog->tags ?? [])) }}" placeholder="مثال: مسکن، سرمایه‌گذاری، تهران">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">وضعیت *</label>
                        <select name="status" class="form-control" required>
                            <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>پیش‌نویس</option>
                            <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>منتشر شده</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">تاریخ انتشار</label>
                        <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', $blog->published_at ? date('Y-m-d\TH:i', strtotime($blog->published_at)) : '') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">تصویر شاخص</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="image" id="image-input" accept="image/*">
                            <label for="image-input" class="file-input-label">
                                <i class="ri-image-add-line"></i>
                                <span id="file-name">انتخاب تصویر</span>
                            </label>
                        </div>
                        @if($blog->image)
                            <small class="text-muted d-block mt-1">تصویر فعلی: در صورت انتخاب تصویر جدید، تصویر قبلی جایگزین می‌شود.</small>
                        @endif
                    </div>

                    <div class="col-12 mb-3">
                        <img id="preview-image" class="image-preview" alt="Preview" src="{{ $blog->image ? url('/').$blog->image : '' }}" style="{{ $blog->image ? '' : 'display:none;' }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">خلاصه</label>
                        <textarea name="summary" class="form-control" rows="3">{{ old('summary', $blog->summary) }}</textarea>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">محتوای مقاله</label>
                        <div id="editor"></div>
                        <textarea name="content" id="content" style="display:none;">{{ old('content', $blog->content) }}</textarea>
                    </div>

                </div>

                <button  style="    margin-top: 100px !important;" type="submit" class="btn btn-success w-100 py-2 mt-3">بروزرسانی مقاله</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('image-input').addEventListener('change', function (event) {
        const preview = document.getElementById('preview-image');
        const fileName = document.getElementById('file-name');
        const file = event.target.files[0];

        if (file) {
            preview.style.display = "block";
            preview.src = URL.createObjectURL(file);
            fileName.textContent = file.name;
        }
    });

    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'محتوای مقاله را اینجا بنویسید...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'font': [] }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'direction': 'rtl' }],
                ['blockquote', 'code-block'],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    var existingContent = document.getElementById('content').value;
    if (existingContent) {
        quill.root.innerHTML = existingContent;
    }

    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('content').value = quill.root.innerHTML;
    });
</script>

@include('admin.parts.footer')
