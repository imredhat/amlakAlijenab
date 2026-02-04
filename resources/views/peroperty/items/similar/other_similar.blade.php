<div class="card-body position-relative pb-3">
    <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary">
        <?= getCat($s->category) ?>
    </h4>

    <h3 class="h6 mb-2 fs-base">
        <a class="nav-link stretched-link"
           href="<?= url('/') ?>/p/<?= $s->id ?>/<?= str_replace(' ', '-', $s->title) ?>">
            <?= $s->title ?>
        </a>
    </h3>

    <p class="mb-2 fs-sm text-muted">
        <?= $s->province ?>، <?= $s->city ?>
    </p>

    <div class="fw-bold">
        <i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>
        <?= number_format($s->price) ?> تومان
    </div>
</div>

<div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap">
    <li class="d-inline-block mx-1 px-2 fs-sm">
        <b class="me-1"></b>
        <i class="fi-home ms-1 mt-n1 fs-lg text-muted"></i>
        <?= $s->area ?>
    </li>

    <li class="d-inline-block mx-1 px-2 fs-sm">
        <b class="me-1"></b>
        <i class="fi-house-chosen ms-1 mt-n1 fs-lg text-muted"></i>
        <?= $s->city ?>
    </li>
</div>
