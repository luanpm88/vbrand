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
                            <div class="mb-4"><h4>THÔNG TIN NHƯ SAU</h4></div>
                            <div class="table-responsive">
                                THÔNG TIN CHUYỂN KHOẢN
                            </div>
                             

                        </div>
                        <div class="card-footer">
                            <a href="{{ url('member/payment') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-step-backward"></i> {{ __('layout.order_list_back') }}
                            </a>
                            Chúng tôi sẽ sử lý thông tin của bạn trong 15 phút.
                        </div>
                    </div>
                </div>
            </div> 
   
         
         
    </section>
    </form>
    <!-- Checkout Section End -->
@endsection 