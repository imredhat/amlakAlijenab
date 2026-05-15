@csrf
<div class="row">

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ*</label>
        <input type="text" class="form-control" id="area" name="area" value="{{ old('area', $property->area ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="price">قیمت (تومان)</label>
        <input type="text" inputmode="numeric" class="form-control price-input" id="price" name="price" value="{{ old('price', number_format($property->price ?? 0)) }}">
    </div>

</div>