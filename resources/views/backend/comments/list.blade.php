@extends('backend.layouts.master')
@section('content')
 	@foreach($data as $row)
	 <p>
	 	{{ $row->title }} - 
	 	{{ $row->user_id }} - 
	 	{{ $row->post_id }} - 
	 	
	 	<a href="{{ url('admin/comments/edit',$row->id) }}" class="btn btn-info">Active</a> -
	 	<a href="{{ url('admin/comments/del',$row->id) }}" onclick="javascript:pront('Xóa danh mục này ?')" class="btn btn-info">Delete</a>
	 </p>
	@endforeach
	<p>Phan trang:: {{ $data->links() }}</p>
@endsection()