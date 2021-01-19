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
		        <h4>Chi tiết đơn hàng</h4>
		       	<p>Mã đơn hàng: {{ $order->id }}</p>
		       	<p>Ngày đặt hàng: {{ $order->created_at }}</p>
		        <div class="table-responsive">
		            <table class="table mb-0">
		                <thead>
		                    <tr>
		                    	<th>Hình ảnh</th>
		                       	<th>Sản phẩm</th>
					           	<th>Giá</th>
					            <th>Số Lượng</th>
					            <th>Thành tiền</th>
		                    </tr>
		                </thead>
		                <tbody>
						@if($data)
						    @foreach($data as $details)
						        <tr>
						            <td >
						                <img src="{{ asset('upload/Product/'.$details->photo) }}" width="100" height="100" alt="">
						            </td>
						            <td><h5>{{ $details->title }}</h5></td>
						            <td>
						                {{ number_format($details->price,0) }} đ
						            </td>
						            <td> 
						                {{ $details->quantity }} 
						            </td>
						            <td>
						                {{ number_format( ($details->price * $details->quantity),0) }} 
						            </td> 
						        </tr>
						    @endforeach
						@endif
					    </tbody>
					</table> 
		        </div>
		        <p>Tổng tiền: {{ number_format($order->total,0) }} đ</p>
		    </div>
		    <div class="card-footer">
		    	 
		    </div>
		</div> 
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
        	<div class="card-title">
        		<h4>THÔNG TIN NHẬN HÀNG</h4> 
        	</div>
            <div class="card-body">                 
                <p>Tên người nhận: <strong>{{ $order->recept_name  }}</strong></p>
                <p>Địa chỉ: <strong>{{ $order->recept_address }}</strong></p>
                <p>Email: <strong>{{ $order->recept_email }}</strong></p>
                <p>Phone: <strong>{{ $order->recept_phone }}</strong></p>
                <p>Ghi chú: <strong>{{ $order->recept_note }}</strong></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
    	<div class="card">
    		<div class="card-title">
    			<h4>THÔNG TIN THANH TOÁN</h4>
    		</div> 
            <div class="card-body"> 
            	<p>HÓA ĐƠN SỐ: <strong>{{ $order->invoice_id  }}</strong></p>
            	<p>NGÀY <strong>{{ $order->datepay  }}</strong></p>
            	<p>TRẠNG THÁI: <strong>{{ $order->paystatus  }}</strong></p>
            	<p>KÊNH THANH TOÁN: <strong>{{ $order->payment  }}</strong></p>
            	<p>TIỀN THANH TOÁN: <strong>{{ $order->total }} {{ $order->currency }}</strong></p>
            	<p>VẬY CHUYỂN : <strong>{{ $order->shipping  }}</strong></p>
            </div>
        </div>

    </div>


</div>

@endsection 