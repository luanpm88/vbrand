@extends('backend.layouts.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        
        <div class="col-sm-6">
            <h4 class="page-title">Quản trị bài viết</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">bài viết</a></li>
                <li class="breadcrumb-item active">Danh sách bài viết</li>
            </ol>
        </div>
        <div class="col-sm-6">
            <div class="float-right d-none d-md-block"> 
                <a href="{{ url('admin/posts/add') }}" class="btn btn-primary arrow-none waves-effect waves-light"> <i class="mdi mdi-settings mr-2"></i> Thêm bài viết </a> 

            </div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">

    <div class="col-lg-12">
        
 <div class="card">
    <div class="card-body">
        <h4>Title</h4>
        <p class="text-muted">
            mesenger
        </p>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hình ảnh</th>
                        <th>Title</th>
                        <th>Chuyên mục</th>
                        <th>Chức năng</th>
                        <th>Chức năng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($data as $row)
                	<?php $category = DB::table('category')->where('id',$row->category_id)->first(); ?>
                	<tr>
                        <th scope="row">1</th>
                        <td>
                        	@if (!empty($row->photo))
				        	<img style="width: 100px" src="{{ asset('upload/Post/'.$row->photo) }}">
				        	@endif
                        </td>
                        <td>{{ $row->title }}</td>
                        <td>
                        	@if (!empty($category->title))
					            {{ $category->title }}
					        @else
					            {{  NULL }}
					        @endif 
                        </td>
                        <td>
                        	<a href="{{ url('admin/posts/edit',$row->id) }}" class="btn btn-info">Edit</a>
                        </td>
                        <td>
                        	<a href="{{ url('admin/posts/del',$row->id) }}" onclick="javascript:pront('Xóa danh mục này ?')" class="btn btn-info">Delete</a>
                        </td>
                        <td>
                        	<a href="{{ url('admin/posts/show',$row->id) }}" class="btn btn-info">show</a>
                        </td>
                    </tr>
					@endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="card-footer">
    	 {{ $data->links() }}
    	<!--nav aria-label="Page navigation example">
		  <ul class="pagination">
		    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
		    <li class="page-item"><a class="page-link" href="#">1</a></li>
		    <li class="page-item"><a class="page-link" href="#">2</a></li>
		    <li class="page-item"><a class="page-link" href="#">3</a></li>
		    <li class="page-item"><a class="page-link" href="#">Next</a></li>
		  </ul>
		</nav-->

    </div>
</div> 

    </div> <!-- end col -->
</div> <!-- end row -->

 
@endsection()