@extends('backend.layouts.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">    
        <div class="col-sm-6">
            <h4 class="page-title">Quản trị Liên hệ</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Liên hệ</a></li>
                <li class="breadcrumb-item active">Danh sách Liên hệ</li>
            </ol>
        </div> 
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-lg-12">        
 <div class="card">
    <div class="card-body">
        <h4>Danh sách Liên hệ</h4>
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>Ngày</th>
                        <th>CHỨC NĂNG</th> 
                    </tr>
                </thead>
                <tbody>
                	@foreach($data as $row) 
                	<tr>
                        <th scope="row">{{ $row->id }}</th>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->created_at }} </td>
                        <td>                  
                        	<a href="{{ url('admin/feedback/del',$row->id) }}" onclick="javascript:pront('Xóa danh mục này ?')" class="btn btn-info">Delete</a>
                         
                        	<a href="{{ url('admin/feedback/show',$row->id) }}" class="btn btn-info">show</a>
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

 