@extends('backend.layouts.master')
@section('content')
<form method="post" enctype="multipart/form-data">
	@csrf
	<p>post: 
		<select name="post">
			@foreach( $posts as $item)
			@if($data->post_id == $item->id)
				<option value="{{ $item->id }}" selected>{{ $item->title }}</option>
			@else
				<option value="{{ $item->id }}" >{{ $item->title }}</option>
			@endif
			@endforeach
		</select>
	</p>
	<p>title: <input type="text" name="title" value="{{ old('title',isset($data->title) ? $data->title : '') }}"></p>
	<p>keyword: <input type="text" name="keyword" value="{{ old('keyword') ?? $data->keyword ?? '' }}"></p>
	<p>Code: <input type="text" name="price" value="{{ old('code') ?? $data->code ?? '' }}"></p>
	<p><input type="text" name="description" value="{{ old('description') ?? $data->description ?? '' }}"></p>
	<p> Hình ảnh: 
		<input type="file" name="photo" value="{!! old('photo') !!}"> 
	</p>

	<p><input type="submit" name=" save "></p>
</form>
@endsection