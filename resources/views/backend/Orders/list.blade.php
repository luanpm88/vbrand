@extends('backend.layouts.master')
@section('content')
<div class="page-title-box"> 
    <div class="row align-items-center">        
        <div class="col-sm-6">
            <h4 class="page-title">Quản trị Đơn hàng</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/orders') }}">Đơn hàng</a></li>
                <li class="breadcrumb-item active">Danh sách Đơn hàng</li>
            </ol> 
        </div> 
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-lg-12">
		<div class="card">
		    <div class="card-body">
		        <h4>Danh sách Đơn hàng</h4>
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
							 	<th>Tổng tiền</th>
							 	<th>Ngày</th>
							 	<th>Thành viên</th> 
							 	<th>Chi tiết</th>
								<th>Thanh toán ?</th>  
							    <th>Chức năng</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($data as $row)
		               		<?php $category = DB::table('category')->where('id',$row->category_id)->first(); ?>
		               		<?php $user = DB::table('users')->where('id',$row->user_id)->first(); ?>
		                	<tr> 
		                        <td>{{ $row->id }}</td>
								<td>{{ $row->total }}</td>
								<td>{{ $row->created_at }}</td>
								<td>
									{{ $user->name }}
									@if($user->is_admin==1)
										( admin )
									@else
										( member )
									@endif
								</td>
								<td>
							    	<a href="{{ url('admin/orders/show',$row->id) }}" class="btn btn-outline-link">
							    		<i class="fa fa-bars"></i> Chi tiết
							    	</a>
							    </td>
							    <td>
							    	<font color="green">{{ $row->paystatus }}</font>  
							    </td>
							    <td>
							    	<a href="{{ url('admin/orders/del',$row->id) }}" class="btn btn-outline-danger btn-sm btnremove">
							    		<i class="fa fa-remove"></i> Xóa
							    	</a>
							    	@if($row->paystatus != 'paied' )
							    	<a href="{{ url('admin/orders/setpaid',$row->id) }}" class="btn btn-outline-success btn-sm">
							    		<i class="fa fa-check"></i> Đã thanh toán
							    	</a>
							    	@endif
							    	
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