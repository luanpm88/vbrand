@extends('fontend.layouts.guest')
@section('content')
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

<section class="content">
<div class="container">


<!-- end row -->
<div class="row">
    <div class="col-lg-12">
		<div class="card mb-4">
		    <div class="card-body">
		        <h4>{{ __('layout.order_list') }}</h4>
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
							 	<th>{{ __('layout.order_payby') }}</th>  
							    <th>{{ __('layout.order_tools') }}</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($data as $row)
		               		<?php $category = DB::table('category')->where('id',$row->category_id)->first(); ?>
		                	<tr> 
		                        <td>{{ $row->id }}</td>
								<td>{{ $row->total }} {{ $row->currency }}</td>
								<td>{{ $row->created_at }}</td>							   
							    @if($row->invoice_id!='')
							    <td>{{ $row->payment }} <font color="green">Invoice ID</font> : <strong>{{ $row->invoice_id }}</strong></td>
							    <td>
							    	<a href="{{ url('order/show',$row->id) }}" class="btn btn-outline-success btn-sm">
							    		<i class="fa fa-bars"></i> {{ __('layout.see_details') }}
							    	</a>
							    <td>
							    @else
							    <td>
							    	@if($row->paystatus=='paied')
							    	<font color="green">{{ $row->paystatus }}</font>
							    	@else
							    	<a href="{{ url('order/show',$row->id) }}" class="btn btn-outline-success btn-sm">
							    		<i class="fa fa-money"></i> {{ __('layout.payment') }}
							    	</a> 
							    	@endif
							    </td>
							    <td>
							    	<a href="{{ url('order/show',$row->id) }}" class="btn btn-outline-success btn-sm">
							    		<i class="fa fa-bars"></i> {{ __('layout.see_details') }}
							    	</a>
							    	<a href="{{ url('order/del',$row->id) }}" class="btn btn-outline-danger btn-sm btnremove">
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

</div>
</section>
@endsection()