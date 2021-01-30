@extends('fontend.Member.master')
@section('title', 'Cart') 
@section('content')
<!-- Breadcrumb Section Begin -->
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
    <!-- Breadcrumb Section End -->
    <!-- Shoping Cart Section Begin -->
    <form action="{{ url('payment-handle',$order->id) }}" method="post">
    @csrf
    <section class="shoping-cart spad">
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('layout.order_details') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-4"><h4>{{ __('layout.product_list') }}</h4></div>
                            <div class="table-responsive">
                                <table class="table mb-4">
                                    <thead>
                                        <tr>
                                            <th>{{ __('layout.image') }}</th>
                                            <th>{{ __('layout.product') }}</th>
                                            <th>{{ __('layout.price') }}</th>
                                            <th>{{ __('layout.quantity') }}</th>
                                            <th>{{ __('layout.money') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total = 0 ?> 
                                    @if($details_products) 
                                        @foreach($details_products as $details)
                                            <?php $total += $details->price * $details->quantity ;?>
                                            <tr>
                                                <td><img src="{{ asset('upload/Product/'.$details->photo) }}" width="100" height="100" alt=""></td>
                                                <td><h5>{{ $details->title }}</h5></td>
                                                <td>{{ number_format($details->price,0) }} {{ $details->currency }}</td>
                                                <td>{{ $details->quantity }}</td>
                                                <td>{{ number_format( ($details->price * $details->quantity),0) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                             

                        </div>
                        <div class="card-footer">
                            <a href="{{ url('member/payment') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-step-backward"></i> {{ __('layout.order_list_back') }}
                            </a>
                            <button type="submit" name="pay" class="btn btn-outline-primary btn-sm" ><i class="fa fa-paypal"></i> {{ __('layout.payment_paypal') }} </button>

                            <button type="submit" name="stripepay" class="btn btn-outline-info btn-sm" ><i class="fa fa-cc-stripe"></i>
 {{ __('layout.payment_stripe') }} </button>
                        </div>
                    </div>
                </div>
            </div> 
   
         
         
    </section>
    </form>
    <!-- Checkout Section End -->
@endsection 