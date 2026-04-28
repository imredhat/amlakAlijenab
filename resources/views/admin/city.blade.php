@include('admin.parts.header')

<style>
    body {
        direction: rtl;
        text-align: right;
    }

    /* استایل‌های جدول و دکمه‌ها را اینجا اضافه کن اگر لازم است */
    .table th,
    .table td {
        text-align: right;
        /* اطمینان از راست‌چین بودن سلول‌ها */
        vertical-align: middle;
        /* وسط‌چین بودن عمودی محتوا */
    }

    .table thead th {
        background-color: #f8f9fa;
        /* رنگ پس‌زمینه هدر جدول */
    }

    .action-buttons form {
        display: inline-block;
        /* برای نمایش دکمه حذف در کنار دکمه ویرایش */
        margin-left: 5px;
    }
</style>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">لیست شهرها</h5>
            <a href="{{ route('city.create') }}" class="btn btn-light btn-sm">افزودن شهر جدید</a>
        </div>

        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($cities->isEmpty())
            <div class="alert alert-info text-center">
                هیچ شهری هنوز اضافه نشده است.
            </div>
            @else
            <div class="table-responsive"> {{-- برای ریسپانسیو شدن جدول --}}
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام شهر</th>
                            <th scope="col">تگ</th>
                            <th scope="col">ترتیب</th>
                            <th scope="col">تصویر</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $city->name }}</td>
                            <td>{{ $city->tag ?? '—' }}</td>
                            <td>{{ $city->order }}</td>
                            <td>
                                @if($city->image)
                                <img src="{{url('/')}}{{ $city->image }}" alt="تصویر" width="50" height="50" class="rounded">
                                @else
                                -
                                @endif
                            </td>
                            <td class="action-buttons">
                                {{-- فرم حذف درون یک div قرار گرفت --}}
                                <div>
                                    <form action="{{ route('city.destroy', $city->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این شهر مطمئن هستید؟');">
                                        <a href="{{ route('city.edit', $city->id) }}" class="btn btn-sm btn-primary me-1">ویرایش</a>

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

{{-- اگر بخواهی از Modal استفاده کنی، کد Modal را اینجا یا در admin.parts.footer قرار بده --}}
{{-- مثال Modal حذف --}}

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">تأیید حذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                آیا مطمئن هستید که می‌خواهید این شهر را حذف کنید؟ این عملیات غیرقابل بازگشت است.
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
    // اگر از Modal استفاده می‌کنی، این اسکریپت را هم فعال کن
    function confirmDelete(cityId) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/city/${cityId}`;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>