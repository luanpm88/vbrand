@extends('fontend.Member.master')
@section('title', 'Cart')  
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> {{ __('layout.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('order') }}">{{ __('layout.order') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('layout.payment_info') }}</li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section> 
    <!-- Breadcrumb Section End -->
    <section>
    	<div class="container mb-4">
    		
<div class="row">
    <div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header">
				<div class="card-title">
					<h4>{{ __('layout.order_details') }}</h4>
				</div>
			</div>
		    <div class="card-body">		        
		       	<p>{{ __('layout.order_id') }}: {{ $order->id }}</p>
		       	<p>{{ __('layout.order_date') }}: {{ $order->created_at }}</p>
		        <div class="table-responsive">
		            <table class="table mb-0">
		                <thead>
		                    <tr>
		                    	<th>{{ __('layout.image') }}</th>
		                       	<th>{{ __('layout.product') }}</th>
					           	<th>{{ __('layout.price') }}</th>
					            <th>{{ __('layout.quantity') }}</th>
					            <th></th>
		                    </tr>
		                </thead>
		                <tbody>
						@if($data)
						    @foreach($data as $details)
						        <tr>
						            <td>
						                <img src="{{ asset('upload/Product/'.$details->photo) }}" width="100" height="100" alt="">
						            </td>
						            <td><h5>{{ $details->title }}</h5></td>
						            <td>
						                {{ number_format($details->price,0) }} {{ $details->currency }}
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
		        <p>{{ __('layout.total') }}: {{ number_format($order->total,0) }} {{ $details->currency }}</p>
		    </div>
		    <div class="card-footer">
		    	 
		    </div>
		</div> 
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="row">
    <div class="col-lg-7">
        <div class="card mb-4">
        	<div class="card-header">
        	<div class="card-title">
        		<h4>THÔNG TIN NHẬN HÀNG</h4> 
        	</div>
        	</div>
            <div class="card-body">                 
                <p>NGƯỜI NHẬN: <strong>{{ $order->recept_name  }}</strong></p>
                <p>ĐỊA CHỈ: <strong>{{ $order->recept_address }}</strong></p>
                <p>Email: <strong>{{ $order->recept_email }}</strong></p>
                <p>ĐIỆN THOẠI: <strong>{{ $order->recept_phone }}</strong></p>
                <p>GHI CHÚ: <strong>{{ $order->recept_note }}</strong></p>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
    	<div class="card">
    		<div class="card-header">
	    		<div class="card-title">
	    			<h4>THÔNG TIN THANH TOÁN</h4>
	    		</div>
    		</div>
            <div class="card-body"> 
            	<p>MÃ HÓA ĐƠN: <strong>{{ $order->invoice_id  }}</strong> ({{ $order->payment  }})</p>
            	<p>NGÀY: <strong>{{ $order->datepay  }}</strong></p>
            	<p>TRẠNG THÁI: <strong>{{ $order->paystatus  }}</strong></p>
            	<p>TIỀN THANH TOÁN: <strong>{{ $order->total }} {{ $order->currency }}</strong></p>
            	<p>VẬY CHUYỂN : <strong>{{ $order->shipping  }}</strong></p>
            </div>
        </div>

    </div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="mb-4">
			<a href="{{ url('order') }}" class="btn btn-outline-success btn-sm">
				<i class="fa fa-step-backward"></i> TRỞ LẠI DANH SÁCH ĐƠN HÀNG
			</a>
		</div>

	</div>
</div>

		</div>
	</section>
@endsection 