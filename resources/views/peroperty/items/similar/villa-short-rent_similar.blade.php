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
        <div><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i><?= number_format($s->daily_rent ?? 0) ?> تومان / شب</div>
    </div>
</div>
<div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap">
    <span class="d-inline-block me-4 fs-sm">
        <?= $s->area ?? '' ?><i class="fi-home ms-1 mt-n1 fs-lg text-muted"></i>
    </span>
    <span class="d-inline-block me-4 fs-sm">
        <?= $s->capacity ?? '' ?><i class="fi-users ms-1 mt-n1 fs-lg text-muted"></i>
    </span>
    <span class="d-inline-block me-4 fs-sm">
        <?= $s->rooms ?? '' ?><i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i>
    </span>
    <span class="d-inline-block fs-sm">
        <?= $s->floor_count ?? '' ?><i class="fi-layers ms-1 mt-n1 fs-lg text-muted"></i>
    </span>
</div>
