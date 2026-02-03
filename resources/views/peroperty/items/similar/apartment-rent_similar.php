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
        <div>
            <i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>
            <?= number_format($s->mortgage) ?> تومان
        </div>
        <div>
            <i class="fi-rent mt-n1 me-2 lead align-middle opacity-70"></i>
            <?= number_format($s->rent) ?> تومان
        </div>
    </div>
</div>

<div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap">
    <span class="d-inline-block mx-1 px-2 fs-sm">
        <?= $s->area ?>
        <i class="fi-home ms-1 mt-n1 fs-lg text-muted"></i>
    </span>

    <span class="d-inline-block mx-1 px-2 fs-sm">
        <?= $s->toilet ?>
        <i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i>
    </span>

    <span class="d-inline-block mx-1 px-2 fs-sm">
        <?= $s->floors_count ?>
        <i class="fi-layers ms-1 mt-n1 fs-lg text-muted"></i>
    </span>

    <span class="d-inline-block mx-1 px-2 fs-sm">
        <?= $s->build_year ?>
        <i class="fi-calendar ms-1 mt-n1 fs-lg text-muted"></i>
    </span>
</div>
