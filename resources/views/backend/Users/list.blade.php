@extends('backend.layouts.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">    
        <div class="col-sm-6">
            <h4 class="page-title">Quản trị Người dùng</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Người dùng</a></li>
                <li class="breadcrumb-item active">Danh sách người dùng</li>
            </ol>
        </div>
        <div class="col-sm-6">
            <div class="float-right d-none d-md-block"> 
                <a href="{{ url('admin/user/add') }}" class="btn btn-primary arrow-none waves-effect waves-light"> <i class="mdi mdi-settings mr-2"></i> Thêm mới thành viên </a> 
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-lg-12">        
 <div class="card">
    <div class="card-body">
        <h4>Danh sách thành viên</h4>
        <p class="text-muted">
            @if (Session::has('messenge'))
		    <div class="alert alert-success" role="alert">
		        <strong> {{ Session::get('messenge') }}</strong>.
		    </div>
		    @endif
        </p>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Tên thành viên</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Trạng thái</th>
                        <th>Quyền hạn</th>
                        <th>Ngày đăng ký</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($data as $row)
                	<tr>
                        <th scope="row">{{ $row->id }}</th>
                        <td>
                        	@if (!empty($row->avatar))
				        	<img style="width: 100px" src="{{ asset('upload/Avatar/'.$row->avatar) }}">
				        	@endif
                        </td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>                        
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->status }}</td>
                        <td>
                        	@if($row->is_admin ==1)
                        		Admin
                        	@else
                        		Member
                        	@endif
                        </td>
                        <td>{{ $row->created_at }}</td>
                        <td>
                        	<a href="{{ url('admin/user/edit',$row->id) }}" class="btn btn-info">Edit</a>
                        	<a href="{{ url('admin/user/del',$row->id) }}" onclick="javascript:pront('Xóa danh mục này ?')" class="btn btn-info">Delete</a> 
                        	<a href="{{ url('admin/user/show',$row->id) }}" class="btn btn-info">show</a>
                        </td>
                    </tr>
					@endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
    	 {{ $data->links() }}
    </div>
</div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection()