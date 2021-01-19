@extends('backend.layouts.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Category</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/category') }}">Category</a></li>
                <li class="breadcrumb-item active">List Category</li>
            </ol>
        </div>
        <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
                <div class=""> 
                    <a href="{{ url('admin/category/add') }}" class="btn btn-primary">
                        <i class="mdi mdi-settings mr-2"></i> Add New Category
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Danh sách Category</h4>
                @if (Session::has('messenge'))
                <div class="alert alert-success" role="alert">
                    <strong> {{ Session::get('messenge') }}</strong>.
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>HOme</th>
                            <th>Chỉnh sửa</th>
                            <th>Xóa bỏ</th>
                            </tr>
                        </thead>
                        <tbody>
                    		@foreach($data as $row)
                    		<tr>
                			<th scope="row">1</th>
						 	<td>{{ $row->title }} </td>
                            <td>-- </td>
                            <td>
                            @if($row->home==1) 
                                    <label class="switch switch-text switch-success">
                                        <input type="checkbox" class="switch-input switch-home" data-token="{{ csrf_token() }}" checked="true" value="{{ $row->id }}">
                                        <span data-on="On" data-off="Off" class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                            @else
                                    <label class="switch switch-text switch-success">
                                        <input type="checkbox" class="switch-input switch-home" data-token="{{ csrf_token() }}" value="{{ $row->id }}">
                                        <span data-on="On" data-off="Off" class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                            @endif  
                        </td>
						 	<td><a href="{{ url('admin/category/edit',$row->id) }}" class="btn btn-info">Edit</a></td>
						 	<td><a href="{{ url('admin/category/del',$row->id) }}" onclick="javascript:pront('Xóa danh mục này ?')" class="btn btn-info">Delete</a></td>
							 </p>
							@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
            	<p>{{ $data->links() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection()