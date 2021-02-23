<select name="ward_id" class="custom-select d-block w-100" id="country" required="">
    <option value="">Chọn...</option>
    @foreach($wards as $ward)
      <option value="{{ $ward->id }}">{{ $ward->name }}</option>
    @endforeach
</select>