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
            <h5 class="mb-0">مدیریت نظرات بلاگ</h5>
            <a href="{{ url('/admin/blog') }}" class="btn btn-light btn-sm">بازگشت</a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ request('tab', 'pending') === 'pending' ? 'active' : '' }}" href="{{ url('/admin/blog/comments?tab=pending') }}">
                        در انتظار تایید <span class="badge bg-warning text-dark">{{ $pendingCount }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('tab') === 'approved' ? 'active' : '' }}" href="{{ url('/admin/blog/comments?tab=approved') }}">
                        تایید شده <span class="badge bg-success">{{ $approvedCount }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('tab') === 'all' ? 'active' : '' }}" href="{{ url('/admin/blog/comments?tab=all') }}">
                        همه
                    </a>
                </li>
            </ul>

            <div class="table-responsive">
                <table id="commentsTable" class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>مقاله</th>
                            <th>نام</th>
                            <th>تلفن</th>
                            <th>پیام</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $index => $comment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ Str::limit($comment->blog->title ?? '-', 30) }}</td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->tel ?? '-' }}</td>
                            <td>{{ Str::limit($comment->message, 50) }}</td>
                            <td>{{ verta($comment->created_at)->format('Y/m/d H:i') }}</td>
                            <td>
                                @if($comment->is_approved)
                                    <span class="badge bg-success">تایید شده</span>
                                @else
                                    <span class="badge bg-warning text-dark">در انتظار</span>
                                @endif
                            </td>
                            <td>
                                @if(!$comment->is_approved)
                                <form action="{{ url('/admin/blog/comments/'.$comment->id.'/approve') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">تایید</button>
                                </form>
                                @else
                                <form action="{{ url('/admin/blog/comments/'.$comment->id.'/reject') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">لغو تایید</button>
                                </form>
                                @endif

                                <form action="{{ url('/admin/blog/comments/'.$comment->id.'/delete') }}" method="POST" style="display:inline;" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                    @csrf
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
        $('#commentsTable').DataTable({
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
