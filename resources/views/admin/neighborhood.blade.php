@include('admin.parts.header')


<script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>

<script src="{{ url ('/') }}/assets/js/sidebar-menu.js"></script>
<script src="{{ url ('/') }}/assets/js/custom/custom.js"></script>

<style>
    body {
        direction: rtl;
        text-align: right;
    }

    .table th,
    .table td {
        text-align: right;
        vertical-align: middle;
    }

    .table thead th {
        background-color: #f8f9fa;
    }

    .action-buttons form {
        display: inline-block;
        margin-left: 5px;
    }
    
    .city-badge {
        background-color: #17a2b8;
        color: white;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
    }
</style>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">لیست محله‌ها</h5>
            <a href="{{ route('neighborhood.create') }}" class="btn btn-light btn-sm">افزودن محله جدید</a>
        </div>

        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($neighborhoods->isEmpty())
            <div class="alert alert-info text-center">
                هیچ محله‌ای هنوز اضافه نشده است.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام محله</th>
                            <th scope="col">شهر</th>
                            <th scope="col">تگ</th>
                            <th scope="col">ترتیب</th>
                                    <th scope="col">نمایش در منو</th> 

                            <th scope="col">تصویر</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($neighborhoods as $neighborhood)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $neighborhood->name }}</td>
                            <td>
                                <span class="city-badge">
                                    {{ $neighborhood->city->name ?? '—' }}
                                </span>
                            </td>
                            <td>{{ $neighborhood->tag ?? '—' }}</td>
                            <td>{{ $neighborhood->order }}</td>

                             <td>
            @if($neighborhood->showInMenu)
                <span class="badge bg-success">فعال</span>
            @else
                <span class="badge bg-secondary">غیرفعال</span>
            @endif
        </td>
                            <td>
                                @if($neighborhood->image)
                                <img src="{{ url('/') }}{{ $neighborhood->image }}" alt="تصویر محله" width="50" height="50" class="rounded" style="object-fit: cover;">
                                @else
                                <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="action-buttons">
                                <div>
                                    <form action="{{ route('neighborhood.destroy', $neighborhood->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این محله مطمئن هستید؟');">
                                        <a href="{{ route('neighborhood.edit', $neighborhood->id) }}" class="btn btn-sm btn-primary me-1">ویرایش</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- مودال حذف -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">تأیید حذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                آیا مطمئن هستید که می‌خواهید این محله را حذف کنید؟ این عملیات غیرقابل بازگشت است.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(neighborhoodId) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/neighborhood/${neighborhoodId}`;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>