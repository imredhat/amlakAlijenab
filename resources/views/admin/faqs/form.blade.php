@extends('admin.layout')

@section('content')
<div class="container">
    <h3>{{ isset($faq) ? 'ویرایش سوال' : 'افزودن سوال' }}</h3>

    <form method="POST" action="{{ isset($faq) ? '/admin/faqs/'.$faq->_id.'/update' : '/admin/faqs/store' }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">سوال</label>
            <input name="question" class="form-control" value="{{ $faq->question ?? old('question') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">پاسخ (HTML مجاز)</label>
            <textarea name="answer" class="form-control" rows="6">{{ $faq->answer ?? old('answer') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">دسته</label>
            <input name="category" class="form-control" value="{{ $faq->category ?? old('category') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">ترتیب</label>
            <input name="order" type="number" class="form-control" value="{{ $faq->order ?? old('order') }}">
        </div>
        <button class="btn btn-primary">ذخیره</button>
    </form>
</div>
@endsection
