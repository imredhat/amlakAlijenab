<!-- Item-->
<div class="card card-hover card-horizontal border-0 shadow-sm mb-4">
    <a class="card-img-top" href="{{url('/')}}/p/{{$p->id}}/{{str_replace(' ','-',$p->title)}}" style="background-image: url({{ getPropertyImage($p) }})">
        <div class="position-absolute start-0 top-0 pt-3 ps-3">
            <span class="d-table badge bg-info">{{$p -> status}}</span>
        </div>
    </a>
    <div class="card-body position-relative pb-3">
        <div class="dropdown position-absolute zindex-5 top-0 end-0 mt-3 me-3">
            <button class="btn btn-icon btn-light btn-xs rounded-circle shadow-sm" type="button" id="contextMenu{{$p->id}}" data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-dots-vertical"></i></button>
            <ul class="dropdown-menu my-1" aria-labelledby="contextMenu{{$p->id}}">
                <li><a class="dropdown-item" href="{{ url('/property/edit/' . $p->id) }}"><i class="fi-edit opacity-60 me-2"></i>ویرایش</a></li>
                <li><button class="dropdown-item" type="button" onclick="toggleFeature('{{$p->id}}')"><i class="fi-flame opacity-60 me-2"></i>نردبان</button></li>
                <li><button class="dropdown-item" type="button" onclick="toggleStatus('{{$p->id}}')"><i class="fi-power opacity-60 me-2"></i>غیرفعال</button></li>
                <li><button class="dropdown-item text-danger" type="button" onclick="confirmDelete('{{$p->id}}')"><i class="fi-trash opacity-60 me-2"></i>حذف</button></li>
            </ul>
        </div>
        <h4 class="mb-1 fs-sm fw-normal text-uppercase text-primary">{{getCat($p -> category)}}</h4>
        <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="{{url('/')}}/p/{{$p->id}}/{{str_replace(' ','-',$p->title)}}">{{$p -> title}} | {{$p -> area}} متری</a></h3>
        <p class="mb-2 fs-sm text-muted">{{$p -> address}}</p>
        <div><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>{{number_format($p -> mortgage)}} تومان</div>
        <div><i class="fi-rent mt-n1 me-2 lead align-middle opacity-70"></i>{{number_format($p -> rent)}} تومان</div>
        <div class="d-flex align-items-center justify-content-center justify-content-sm-start border-top pt-3 pb-2 mt-3 text-nowrap">
            <span class="d-inline-block me-4 fs-sm">{{$p->area}}<i class="fi-home ms-1 mt-n1 fs-lg text-muted"></i></span>
            <span class="d-inline-block me-4 fs-sm">{{$p->toilet}}<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span>
            <span class="d-inline-block me-4 fs-sm">{{$p->rooms}}<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span>
            <span class="d-inline-block fs-sm">{{$p->floor}}<i class="fi-layers ms-1 mt-n1 fs-lg text-muted"></i></span>
            <span class="d-inline-block ms-4 fs-sm">{{$p->year_built}}<i class="fi-calendar ms-1 mt-n1 fs-lg text-muted"></i></span>
        </div>
    </div>
</div>

<form id="delete-form-{{$p->id}}" action="{{ url('/property/delete/' . $p->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete(id) {
    if(confirm('آیا از حذف این آگهی مطمئن هستید؟')) {
        document.getElementById('delete-form-' + id).submit();
    }
}

function toggleStatus(id) {
    if(confirm('وضعیت این آگهی تغییر کند؟')) {
        $.ajax({
            url: '/property/toggle-status/' + id,
            type: 'POST',
            data: {_token: '{{ csrf_token() }}'},
            success: function(response) {
                location.reload();
            }
        });
    }
}

function toggleFeature(id) {
    $.ajax({
        url: '/property/toggle-feature/' + id,
        type: 'POST',
        data: {_token: '{{ csrf_token() }}'},
        success: function(response) {
            location.reload();
        }
    });
}
</script>