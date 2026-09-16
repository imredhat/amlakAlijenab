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

    table.dataTable thead th {
        text-align: right;
    }
</style>


<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">پیام‌های تماس</h5>
            <a href="{{ url('/admin/page/contact') }}" class="btn btn-light btn-sm">ویرایش اطلاعات تماس</a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table id="submissionsTable" class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>تلفن</th>
                            <th>پیام</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $index => $sub)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sub->name }}</td>
                            <td class="ltr">{{ $sub->tel }}</td>
                            <td>{{ Str::limit($sub->message, 60) }}</td>
                            <td>{{ $sub->date_created ? verta($sub->date_created)->format('Y/m/d H:i') : '-' }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $index }}">مشاهده</button>

                                <form action="{{ url('/admin/page/contact-submissions/'.$sub->id.'/delete') }}" method="POST" style="display:inline;" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
@foreach($submissions as $index => $sub)
<div class="modal fade" id="modal-{{ $index }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">پیام از {{ $sub->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
            </div>
            <div class="modal-body">
                <p><strong>نام:</strong> {{ $sub->name }}</p>
                <p><strong>تلفن:</strong> {{ $sub->tel }}</p>
                <p><strong>تاریخ:</strong> {{ $sub->date_created ? verta($sub->date_created)->format('Y/m/d H:i') : '-' }}</p>
                <hr>
                <p><strong>متن پیام:</strong></p>
                <p>{{ $sub->message }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
@endforeach



<script>
    $(document).ready(function() {
        $('#submissionsTable').DataTable({
            language: {
                search: "جستجو:",
                lengthMenu: "نمایش _MENU_ رکورد",
                info: "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                paginate: {
                    first: "اول",
                    last: "آخر",
                    next: "بعدی",
                    previous: "قبلی"
                },
                zeroRecords: "هیچ پیامی یافت نشد",
            }
        });
    });
</script>
