@extends('backend.layouts.master')
@section('content')
<form method="post" enctype="multipart/form-data">
	@csrf
	<p>title: <input type="text" name="title" value="{{ old('title') ?? $category->title ?? '' }}"></p>
	<p>keyword: <input type="text" name="keyword" value="{{ old('keyword') ?? $category->keyword ?? '' }}"></p>
	<p>description:<input type="text" name="description"value="{{ old('description') ?? $category->description ?? '' }}"></p>
	<p>content: <textarea name="content">{{ old('content') ?? $category->content ?? '' }}</textarea></p>
	<p><input type="submit" name=" save "></p>
</form>
@endsection