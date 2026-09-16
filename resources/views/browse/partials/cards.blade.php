@if(isset($properties) && $properties->count() > 0)
    @foreach($properties as $p)
        <?php
        $media = [""];
        $cat = $p->category;
        if (isset($p->media) && count(json_decode($p->media)) > 0) {
            $media = json_decode($p->media);
        }
        ?>
        @include("peroperty.vendor.".$cat)
    @endforeach
@else
    <div class="col-12 text-center py-5">
        <i class="fi-folder-open fs-1 text-muted"></i>
        <p class="text-muted fs-5 mt-3">آگهی‌ای یافت نشد.</p>
    </div>
@endif
