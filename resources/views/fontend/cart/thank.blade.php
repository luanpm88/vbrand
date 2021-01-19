@extends('fontend.layouts.guest')
@section('title', 'Cart') 
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('cart') }}">Đơn hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gửi thành công</li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container"> 
            <div class="checkout__form">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Cảm ơn bạn đã đặt hàng</h4>
                        <p>Chúng tôi sẽ liên hệ với bạn sớm nhất có thể</p>
                    </div>
                </div>
                 
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection 