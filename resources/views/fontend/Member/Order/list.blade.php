@extends('fontend.Member.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-10">
            <h4 class="page-title">THÔNG TIN THANH TOÁN</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('member') }}">DASHBOARD</a></li> 
                <li class="breadcrumb-item active">QUẢN TRỊ THANH TOÁN</li>
            </ol>
        </div> 
    </div>
</div>

<section class="content">
 


<!-- end row -->
<div class="row">
    <div class="col-lg-12">
		<div class="card mb-4">
		    <div class="card-body">
		        <h4>{{ __('mem.payment_list') }}</h4>
		        <p class="text-muted">
		            @if (Session::has('order_messenge'))
				    <div class="alert alert-success" role="alert">
				        <strong> {{ Session::get('order_messenge') }}</strong>.
				    </div>
				    @endif
		        </p>
		        <div class="table-responsive">
		            <table class="table mb-0">
		                <thead>
		                    <tr>
		                        <th>ID</th>
							 	<th>{{ __('layout.order_total_money') }}</th>
							 	<th>{{ __('layout.order_date') }}</th>
							 	<th>{{ __('layout.order_status') }}</th>  
							    <th>{{ __('layout.order_tools') }}</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($data as $row)
		               		<?php $category = DB::table('category')->where('id',$row->category_id)->first(); ?>
		                	<tr> 
		                        <td>{{ $row->id }}</td>
								<td>{{ $row->total }} {{ $row->currency }}</td>
								<td>{{ $row->created_at->format('m-d-Y') }}</td>							   
							    @if($row->invoice_id!='')
							    <td>{{ $row->payment }} <font color="green">Invoice ID</font> : <strong>{{ $row->invoice_id }}</strong></td>
							    <td>
							    	<a href="{{ url('member/order/show',$row->id) }}" class="btn btn-outline-success btn-sm">
							    		<i class="fa fa-bars"></i> {{ __('layout.see_details') }}
							    	</a>
							    <td>
							    @else
							    <td>
							    	@if($row->paystatus=='paied')
							    	<font color="green">{{ $row->paystatus }}</font>
							    	@else
							    	<a href="{{ url('member/order/show',$row->id) }}" class="btn btn-outline-success btn-sm">
							    		<i class="fa fa-money"></i> {{ __('layout.payment_action') }}
							    	</a> 
							    	@endif
							    </td>
							    <td>
							    	<a href="{{ url('member/order/show',$row->id) }}" class="btn btn-outline-success btn-sm">
							    		<i class="fa fa-bars"></i> {{ __('layout.see_details') }}
							    	</a>
							    	<a href="{{ url('member/order/del',$row->id) }}" class="btn btn-outline-danger btn-sm btnremove">
							    		<i class="fa fa-remove"></i> {{ __('layout.remove') }}
							    	</a>
							    </td>
							    @endif							       
		                    </tr>
							@endforeach
		                </tbody>
		            </table>
		        </div>
		    </div>
		    <div class="card-footer">
		    	<div class="pull-left">
		    		{{ __('layout.order_date') }}: {{ $date }}
		    	</div>
		    	<div class="pull-right">
		    	 {{ $data->links() }} 
		    	</div>
		    </div>
		</div> 
    </div> <!-- end col -->
</div> <!-- end row -->

 
</section>
@endsection()