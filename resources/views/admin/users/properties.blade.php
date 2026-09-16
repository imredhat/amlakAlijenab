@include('admin.parts.header')


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        آگهی های کاربر: {{ $user->name }} {{ $user->lname ?? '' }} ({{ $user->tel }})
    </h4>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>نوع ملک</th>
                            <th>قیمت</th>
                            <th>متراژ</th>
                            <th>آدرس</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                        <tr>
                            <td>{{ Str::limit($property->title, 30) }}</td>
                            <td>{{ getCat($property->category) }}</td>
                            <td>{{ number_format($property->price) }} تومان</td>
                            <td>{{ $property->area }} متر</td>
                            <td>{{ Str::limit($property->address, 30) }}</td>
                            <td>{{ verta($property->created_at)->format('Y/m/d') }}</td>
                            <td>
                                <a href="{{ url('/admin/property/edit/' . $property->id) }}" class="btn btn-sm btn-outline-primary">
                                    ویرایش
                                </a>
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
        {{ $properties->links() }}
    </div>
</div>

@include('admin.parts.footer')