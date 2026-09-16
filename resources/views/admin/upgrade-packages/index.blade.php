@include('admin.parts.header')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">پکیج‌های ارتقا (نردبان)</h4>
        <a href="{{ route('admin.upgrade-packages.create') }}" class="btn btn-primary">
            <i class="ri-add-line me-1"></i>افزودن پکیج جدید
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>نام پکیج</th>
                            <th>قیمت (تومان)</th>
                            <th>مدت (روز)</th>
                            <th>ضریب بازدید</th>
                            <th>لیست اول</th>
                            <th>نشان ویژه</th>
                            <th>وضعیت</th>
                            <th>ترتیب</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $index => $package)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $package->name }}</strong></td>
                            <td>{{ number_format($package->price) }}</td>
                            <td>{{ $package->duration_days }}</td>
                            <td>{{ $package->view_multiplier }}x</td>
                            <td>
                                @if($package->is_top_listed)
                                    <span class="badge bg-success">بله</span>
                                @else
                                    <span class="badge bg-secondary">خیر</span>
                                @endif
                            </td>
                            <td>
                                @if($package->is_special_badge)
                                    <span class="badge bg-success">بله</span>
                                @else
                                    <span class="badge bg-secondary">خیر</span>
                                @endif
                            </td>
                            <td>
                                @if($package->is_active)
                                    <span class="badge bg-success">فعال</span>
                                @else
                                    <span class="badge bg-danger">غیرفعال</span>
                                @endif
                            </td>
                            <td>{{ $package->order }}</td>
                            <td>
                                <a href="{{ route('admin.upgrade-packages.edit', $package->id) }}" class="btn btn-sm btn-primary">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <form action="{{ route('admin.upgrade-packages.destroy', $package->id) }}" method="POST" class="d-inline" onsubmit="return confirm('آیا از حذف این پکیج مطمئن هستید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                هیچ پکیجی تعریف نشده است.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.parts.footer')
