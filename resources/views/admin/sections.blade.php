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
            <h5 class="mb-0">لیست Section‌ها</h5>
            <a href="{{ route('sections.create') }}" class="btn btn-light btn-sm">افزودن جدید</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="sectionsTable" class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>جایگاه</th>
                            <th>توضیحات</th>
                            <th>تصویر</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $index => $section)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $section->title }}</td>
                            <td>{{ $section->position }}</td>
                            <td>{{ Str::limit($section->desc, 40) }}</td>
                            <td>
                                @if($section->pic)
                                <img src="{{url('/')}}{{ $section->pic }}" alt="تصویر" width="50" height="50" class="rounded">
                                @else
                                -
                                @endif
                            </td>
                            <td><a href="{{url('/')}}/admin/sections/{{$section->id}}/edit" class="btn btn-primary">ویرایش</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#sectionsTable').DataTable({
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
                zeroRecords: "هیچ داده‌ای یافت نشد",
            }
        });
    });
</script>