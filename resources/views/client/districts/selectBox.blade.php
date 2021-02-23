<select name="district_id" class="custom-select d-block w-100" id="country" required="">
    <option value="">Chọn...</option>
    @foreach($districts as $district)
      <option value="{{ $district->id }}">{{ $district->name }}</option>
    @endforeach
</select>