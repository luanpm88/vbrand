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
    <div class="container">     
     <div class="card mb-4">
         <div class="card-header p-4">
            <div class="row"> 
                <div class="col-lg-8">
                    <div class="invoice_number">HÓA ĐƠN SỐ: <strong>{{ $invoice_number }}</strong></div>
                    <div class="alert alert-success">Bạn đã thanh toán thành công</div>
                </div>
                <div class="col-lg-4">                    
                    <div class="invoice_date">NGÀY: <strong>{{ $datepay }}</strong></div>
                </div>
            </div>
         </div>
         <div class="card-body">
             <div class="row mb-4">
                 <div class="col-sm-6">
                     <h5 class="mb-3">THÔNG TIN THANH TOÁN</h5>
                     <h3 class="text-dark mb-1">{!! $shipping->recipient_name !!}</h3>
                     <div>Địa chỉ:
                        <strong>
                        {!! $shipping->line1 !!}, 
                        {!! $shipping->city !!}
                        </strong>
                     </div>
                     <div>Mã bưu cục: 
                        <strong>
                        {!! $shipping->postal_code !!}, 
                        {!! $shipping->country_code !!}
                        </strong>
                    </div>
                    <div>
                        Time tranfer
                    </div>
                 </div>
                 <div class="col-sm-6 ">
                     <h5 class="mb-3">THÔNG TIN NƠI NHẬN HÀNG</h5>
                     <h3 class="text-dark mb-1">{!! $order->recept_name !!}</h3>
                     <div>Địa chỉ: <strong>{!! $order->recept_address  !!}</strong></div> 
                     <div>Email: <strong>{!! $order->recept_email !!}</strong></div>
                     <div>Phone: <strong>{!! $order->recept_phone !!}</strong></div>
                     <div>Note: <strong>{!! $order->recept_note !!}</strong></div>
                </div>
            </div>
            <div>
                 <h5 class="text-dark mb-1">CHI TIẾT ĐƠN HÀNG</h5>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-striped">
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
                    <?php $total = 0 ;?> 
                        @if($data)  
                        @foreach($data as $details)
                            <?php $total += $details['product']['price'] * $details['product']['quantity'] ; ?>
                            <tr>
                                <td>
                                    <img src="{{ asset('upload/Product/'.$details['product']['photo']) }}" width="100" height="100" alt="">
                                </td> 
                                <td>
                                    <h5>{{ $details['product']['title'] }}</h5>
                                </td>
                                <td>
                                    {{ number_format($details['product']['price'],0) }}  {!! $details['paypal']->currency !!}
                                </td>
                                <td> 
                                        {!! $details['paypal']->quantity !!}
                                </td>
                                <td class="items_total">
                                    {{ number_format( ( $details['product']['price'] *  $details['paypal']->quantity ),0) }} đ
                                </td> 
                            </tr>
                        @endforeach
                        @endif
                        </tbody> 
                </table>
            </div>
            <div class="row">                 
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                     <strong class="text-dark">Tổng cộng</strong>
                                </td>
                                <td class="right">{!! $amount->details->subtotal !!} {!! $amount->currency !!}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                     <strong class="text-dark">VAT </strong>
                                </td>
                                <td class="right">{!! $amount->details->tax !!} {!! $amount->currency !!}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                     <strong class="text-dark">Phí Vận chuyển </strong>
                                </td>
                                <td class="right">{!! $amount->details->shipping !!} {!! $amount->currency !!}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                     <strong class="text-dark">Tổng tiền</strong> </td>
                                <td class="right">
                                     <strong class="text-dark">{!! $amount->total !!} {!! $amount->currency !!}</strong>
                                </td>
                            </tr>
                         </tbody>
                     </table>
                 </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="col-lg-8">
                <p><strong>ECO WORLD</strong></p>
                <p class="mb-0">Địa chỉ: 60-49 Road 11378 New York</p> 
            </div>
        </div>
    </div>
</div>
<!-- Checkout Section End -->
@endsection 