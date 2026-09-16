@include('admin.parts.header')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">برترین مشاوران</h4>

    <div class="row">
        <!-- Form for adding new top agent -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">افزودن مشاور برتر</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.top-agents.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="user_id">مشاور</label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                <option value="">انتخاب مشاور</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }} {{ $agent->lname ?? '' }} ({{ $agent->tel }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="custom_text">متن سفارشی</label>
                            <textarea class="form-control" id="custom_text" name="custom_text" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="order">ترتیب</label>
                            <input type="number" class="form-control" id="order" name="order" required>
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- List of current top agents -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">لیست مشاوران برتر</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>نام مشاور</th>
                                    <th>متن سفارشی</th>
                                    <th>ترتیب</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody id="top-agents-list" data-url="{{ route('admin.top-agents.update-order') }}">
                                @foreach($topAgents as $topAgent)
                                <tr data-id="{{ $topAgent->id }}">
                                    <td>{{ $topAgent->user->name ?? '' }} {{ $topAgent->user->lname ?? '' }}</td>
                                    <td>{{ Str::limit($topAgent->custom_text, 30) }}</td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm order-input"
                                               value="{{ $topAgent->order }}" data-id="{{ $topAgent->id }}">
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.top-agents.destroy', $topAgent->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
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
    </div>
</div>

@include('admin.parts.footer')

<!-- Sortable JS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    // Update order when input changes
    document.querySelectorAll('.order-input').forEach(input => {
        input.addEventListener('change', function() {
            const id = this.getAttribute('data-id');
            const order = this.value;

            fetch('{{ route("admin.top-agents.update-order") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order: {
                        [id]: order
                    }
                })
            });
        });
    });
</script>