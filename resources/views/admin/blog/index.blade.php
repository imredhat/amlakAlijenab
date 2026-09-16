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
            <h5 class="mb-0">لیست مقالات</h5>
            <a href="{{ url('/admin/blog/create') }}" class="btn btn-light btn-sm">افزودن مقاله جدید</a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table id="blogTable" class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>دسته‌بندی</th>
                            <th>وضعیت</th>
                            <th>بازدید</th>
                            <th>تاریخ انتشار</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $index => $blog)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($blog->image)
                                <img src="{{ url('/') }}{{ $blog->image }}" alt="تصویر" width="50" height="50" class="rounded" style="object-fit: cover;">
                                @else
                                -
                                @endif
                            </td>
                            <td>{{ Str::limit($blog->title, 40) }}</td>
                            <td>{{ $blog->category ?? '-' }}</td>
                            <td>
                                @if($blog->status === 'published')
                                    <span class="badge bg-success">منتشر شده</span>
                                @else
                                    <span class="badge bg-warning text-dark">پیش‌نویس</span>
                                @endif
                            </td>
                            <td>{{ $blog->views_count }}</td>
                            <td>{{ $blog->published_at ? verta($blog->published_at)->format('Y/m/d') : '-' }}</td>
                            <td>
                                <a href="{{ url('/admin/blog/'.$blog->id.'/edit') }}" class="btn btn-primary btn-sm">ویرایش</a>

                                <form action="{{ url('/admin/blog/'.$blog->id.'/toggle-status') }}" method="POST" style="display:inline;">
                                    @csrf
                                    @if($blog->status === 'published')
                                        <button type="submit" class="btn btn-warning btn-sm">پیش‌نویس</button>
                                    @else
                                        <button type="submit" class="btn btn-success btn-sm">انتشار</button>
                                    @endif
                                </form>

                                <form action="{{ url('/admin/blog/'.$blog->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('آیا مطمئن هستید؟')">
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



<script>
    $(document).ready(function() {
        $('#blogTable').DataTable({
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
