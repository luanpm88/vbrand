@extends('backend.layouts.master')
@section('content')
<form method="post" enctype="multipart/form-data">
	@csrf
	<p>title: <input type="text" name="title" value="{{ old('title',isset($data->title) ? $data->title : '') }}"></p>
	<p>keyword: <input type="text" name="keyword" value="{{ old('keyword') ?? $data->keyword ?? '' }}"></p>
	<p><input type="text" name="description"value="{{ old('description') ?? $data->description ?? '' }}"></p>
	<p><textarea name="content">{{ old('content') ?? $data->content ?? '' }}</textarea></p>
	<p><input type="submit" name=" save "></p>
</form>
@endsection