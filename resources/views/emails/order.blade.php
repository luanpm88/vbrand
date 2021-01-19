<!DOCTYPE html>
<html lang="vi-vn">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="HK Fashion">
    <meta name="keywords" content="HK Fashion">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đơn hàng của bạn</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="tylesheet">
    <link rel="stylesheet" href="http://xetai.club/css/bootstrap.min.css" type="text/css">
</head>
<body>


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
		        <p>  {{ number_format($order->total,0) }} </p>
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
</div>
</section>

 
</body>
</html>