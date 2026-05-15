@extends('admin.layout')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>سوالات متداول</h3>
        <a href="/admin/faqs/create" class="btn btn-primary">افزودن سوال جدید</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>سوال</th>
                <th>دسته</th>
                <th>ترتیب</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
            <tr>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->category ?? '-' }}</td>
                <td>{{ $faq->order ?? '-' }}</td>
                <td>
                    <a href="/admin/faqs/{{ $faq->_id }}/edit" class="btn btn-sm btn-secondary">ویرایش</a>
                    <form method="POST" action="/admin/faqs/{{ $faq->_id }}" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
