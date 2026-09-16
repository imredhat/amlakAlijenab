@if(isset($properties) && $properties->count() > 0)
    @foreach($properties as $p)
        <?php
        $media = [];
        $cat = $p->category;
        if (isset($p->media) && !empty($p->media)) {
            $decoded = json_decode($p->media, true);
            if (is_array($decoded)) {
                $media = $decoded;
            }
        }
        ?>
        @include("peroperty.vendor.".$cat)
    @endforeach
@else
    <div class="col-12 text-center py-5">
        <i class="fi-star fs-1 text-muted"></i>
        <p class="text-muted fs-5 mt-3">آگهی ویژه‌ای یافت نشد.</p>
    </div>
@endif
