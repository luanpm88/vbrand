@extends('backend.layouts.master')
@section('content')
 	<a href="{{ url('admin/video/add') }}"> Add New </a>
	@foreach($data as $row)
	 <p>
	 	{{ $row->title }} - 
	 	<?php $post = DB::table('posts')->where('id',$row->post_id)->first(); ?>
        @if (!empty($post->title))
            {{ $post->title }}
        @else
            {{  NULL }}
        @endif 
        - 
        @if (!empty($row->src))
        	<img style="width: 100px" src="{{ asset('upload/video/'.$row->src) }}">
        @endif
	 	<a href="{{ url('admin/video/edit',$row->id) }}" class="btn btn-info">Edit</a>
	 	<a href="{{ url('admin/video/del',$row->id) }}" onclick="javascript:pront('Xóa danh mục này ?')" class="btn btn-info">Delete</a> - 
	 	<a href="{{ url('admin/video/show',$row->id) }}" class="btn btn-info">show</a>
	 </p>
	@endforeach
	<p>Phan trang:: {{ $data->links() }}</p>
@endsection()