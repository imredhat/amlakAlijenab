@include('admin.parts.header')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">لیست کاربران</h4>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>شماره موبایل</th>
                            <th>نوع کاربر</th>
                            <th>تاریخ ثبت نام</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{{ !empty($user->avatar) ? asset('upload/user/' . $user->id . '/' . $user->avatar) : asset('img/avatars/default-user.svg') }}"
                                     class="rounded-circle" width="40" height="40" alt="{{ $user->name }}">
                                {{ $user->name ?? '-' }}
                            </td>
                            <td>{{ $user->lname ?? '-' }}</td>
                            <td>{{ $user->tel }}</td>
                            <td>
                                <span class="badge {{ $user->is_agent ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $user->is_agent ? 'مشاور' : 'کاربر عادی' }}
                                </span>
                            </td>
                            <td>{{ verta($user->created_at)->format('Y/m/d H:i') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-info me-2">
                                        <i class="fi-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fi-zoom-in"></i>
                                    </a>
                                    <form action="{{ route('admin.users.toggle-agent', $user->id) }}" method="POST" class="me-2">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $user->is_agent ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                            {{ $user->is_agent ? 'لغو مشاور' : 'تبدیل به مشاور' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.users.properties', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                        آگهی ها
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

@include('admin.parts.footer')