<!-- views/property/items/similar/pre-sale_similar.blade.php -->
<div class="card-body position-relative pb-3">
    <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary">
        <?= getCat($s->category) ?>
    </h4>
    <h3 class="h6 mb-2 fs-base">
        <a class="nav-link stretched-link" href="{{url('/')}}/p/{{$s->id}}/{{str_replace(' ','-',$s->title)}}">
            {{$s->title}} | {{$s->area}} متری
        </a>
    </h3>
    <p class="mb-2 fs-sm text-muted">{{$s->city}}</p>
    <div class="fw-bold">
        <i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>
        {{number_format($s->price)}} تومان
    </div>
    <div class="fw-bold mt-2">
        <i class="fi-calendar mt-n1 me-2 lead align-middle opacity-70"></i>
        تحویل: <?= $s->deliveryYear ?? '' ?> - <?= $s->deliveryMonth ?? '' ?>
    </div>
</div>
<div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap">
    <!-- متراژ -->
    <span class="d-inline-block me-4 fs-sm">
        <?= $s->area ?? '' ?> متر<i class="fi-home ms-1 mt-n1 fs-lg text-muted"></i>
    </span>

    <!-- تعداد طبقات -->
    <span class="d-inline-block me-4 fs-sm">
        <?= $s->totalFloors ?? '' ?> <i class="fi-layers ms-1 mt-n1 fs-lg text-muted"></i>
    </span>

    <!-- تعداد اتاق -->
    <span class="d-inline-block me-4 fs-sm">
        <?= $s->roomCount ?? '' ?> <i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i>
    </span>


  
</div>