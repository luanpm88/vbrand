@extends('backend.layouts.master')
@section('content')
<form method="post" enctype="multipart/form-data">
	@csrf
	<p>category: 
		<select name="category">
			@foreach( $posts as $item)
			<option value="{{ $item->id }}">{{ $item->title }}</option>
			@endforeach
		</select>
	</p>
	<p>title: <input type="text" name="title" value="{{ old('title') ?? $data->title ?? '' }}"></p>
	<p>keyword: <input type="text" name="keyword" value="{{ old('keyword') ?? $data->keyword ?? '' }}"></p>
	<p>description:<input type="text" name="description" value="{{ old('description') ?? $data->description ?? '' }}"></p>
	<p> Hình ảnh: 
		<input type="file" name="photo" value="{!! old('photo') !!}"> 
	</p>
	<p><input type="submit" name=" save "></p>
</form>
@endsection