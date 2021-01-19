@extends('fontend.layouts.guest')
@section('title', 'Cart') 
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('cart') }}">Đơn hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thông tin thanh toán</li>
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
                        <h4>CHI TIẾT ĐƠN HÀNG</h4>
                    </div>
                </div>
                <form action="{{ url('orderpayment',$order->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                <h4>Thông tin nhận hàng</h4>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Tên người nhận<span>*</span></p>
                                        <input type="text" name="recept_name" value="{{ old('recept_name') ?? $data->recept_name ?? '' }}">
                                    </div>
                                </div>
                            </div>                             
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Điện thoại<span>*</span></p>
                                        <input type="text" name="recept_phone" value="{{ old('recept_phone') ?? $data->recept_phone ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Đia chỉ<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ giao hàng" name="recept_address" class="checkout__input__add" value="{{ old('recept_address') ?? $data->recept_address ?? '' }}"> 
                            </div> 
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    GHI CHÚ KHÁC ?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input"> 
                                <input type="text" placeholder="GHI CHÚ NỘI DUNG GỬI" name="note" value="{{ old('note') ?? $data->note ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="checkout__order">
                                <h4>ĐƠN HÀNG</h4>
                                <div class="checkout__order__products">SẢN PHẨM <span>THÀNH TIỀN</span></div>
                                <ul>
                                    <?php $total = 0 ?> 
                                    @if(session('cart'))  
                                    @foreach(session('cart') as $id => $details)
                                    <?php $total += $details['price'] * $details['quantity'] ;?>
                                    <li>{{ $details['name'] }} <span>{{ number_format( ($details['price'] * $details['quantity']),0) }} đ</span></li> 
                                    @endforeach
                                    @endif  
                                </ul>
                                <div class="checkout__order__subtotal">TỔNG TIỀN <span>{{ number_format($total,0) }} đ</span></div>
                                <div class="checkout__order__total">TỔNG CỘNG <span>{{ number_format($total,0) }} đ</span></div>
                                <H4>PHƯƠNG THỨC THANH TOÁN</H4>
                                <div class="box_pay_info">
                                <div class="clearfix"></div>
                                <div class="pay_info_body clearfix">
                                      
                                    <label class="form-item payment_info" data-toggle="collapse" data-target="#payment3" aria-expanded="true">
                                        <span class="form_checker">
                                            <span class="checked">
                                                <input id="check_payment3" checked="checked" type="radio" value="4" name="payment">
                                                <span class="bd_check_pay"><span></span></span>
                                            </span>
                                        </span>
                                        <span class="txt_check">Chuyển khoản qua máy ATM &amp; Ngân hàng</span>
                                    </label>
                                    <div class="clearfix"></div>
                                    <div id="payment3" class="collapse in" aria-expanded="true" style="">
                                        <div class="box_info_payment">
                                            <div class="info_payment_top">
                                                Quý khách có thể lựa chọn chuyển khoản tới 1 trong những ngân hàng sau:
                                            </div>
                                            <div class="info-payment-center">
                                                <ul>
                                                    <li class="info_payment_item">
                                                        <div class="payment_thumb">
                                                            <img src="img/vc_bank.jpg">
                                                        </div>
                                                        <div class="payment_detail">
                                                            <div class="payment_bankname">Ngân hàng Ngoại thương Việt Nam</div>
                                                            <div class="payment_detail_row">
                                                                <div class="detail_row row_bank"><b>Chi nhánh:</b> <span class="row_txt">Chi nhánh Chương Dương</span></div>
                                                                <div class="detail_row row_name"><b>Chủ TK:</b> <span class="row_txt">CÔNG TY CỔ PHẦN </span></div>
                                                                <div class="detail_row row_number"><b>Số TK:</b> <span class="row_txt">054 100 062 6868</span></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="info_payment_item">
                                                        <div class="payment_thumb">
                                                            <img src="img/vib.png">
                                                        </div>
                                                        <div class="payment_detail">
                                                            <div class="payment_bankname">Ngân hàng quốc tế (VIB)</div>
                                                            <div class="payment_detail_row">
                                                                <div class="detail_row row_bank"><b>Chi nhánh:</b> <span class="row_txt">Chi nhánh Hai Bà Trưng</span></div>
                                                                <div class="detail_row row_name"><b>Chủ TK:</b> <span class="row_txt">CÔNG TY CỔ PHẦN </span></div>
                                                                <div class="detail_row row_number"><b>Số TK:</b> <span class="row_txt">004 704 067 896 666</span></div>
                                                            </div>
                                                        </div>
                                                    </li> 
                                                    <li class="info_payment_item">
                                                        <div class="payment_thumb">
                                                            <img src="img/BIDV_bank.jpg">
                                                        </div>
                                                        <div class="payment_detail">
                                                            <div class="payment_bankname">Ngân hàng Đầu tư và Phát triển Việt Nam (BIDV)</div>
                                                            <div class="payment_detail_row">
                                                                <div class="detail_row row_bank"><b>Chi nhánh:</b> <span class="row_txt">Chi nhánh Hồng Hà</span></div>
                                                                <div class="detail_row row_name"><b>Chủ TK:</b> <span class="row_txt">CÔNG TY CỔ PHẦN </span></div>
                                                                <div class="detail_row row_number"><b>Số TK:</b> <span class="row_txt">1991 0000 316 839</span></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!---endpayment_bank--->
                                    <label class="form-item payment_info" data-toggle="collapse" data-target="#payment1">
                                        <span class="form_checker">
                                            <span class="checked">
                                                <input id="check_payment1" type="radio" name="payment" value="1">
                                                <span class="bd_check_pay"><span></span></span>
                                            </span>
                                        </span>
                                        <span class="txt_check">Giao hàng và thu tiền tại nhà - COD</span>
                                    </label>
                                    <div class="clearfix"></div>
                                    <label class="form-item payment_info" data-toggle="collapse" data-target="#payment2" aria-expanded="true">
                                        <span class="form_checker">
                                            <span class="checked">
                                                <input id="check_payment2" type="radio" name="payment" value="2">
                                                <span class="bd_check_pay"><span></span></span>
                                            </span>
                                        </span>
                                        <span class="txt_check">Nhận hàng và thanh toán tại Phong Liên</span>
                                    </label>
                                    <div class="clearfix"></div>
                                    <div id="payment2" class="collapse in" aria-expanded="true" style="">
                                        <div class="box_info_payment">
                                            <div class="info_payment_top">Quý khách có thể đến một trong các địa chỉ sau để thanh toán và nhận hàng:</div>
                                            <div class="info_payment_center">
                                                <div class="info_payment_item">
                                                    <div class="payment_detail_title">Trụ sở chính/showroom 1</div>
                                                    <div class="payment_detail_row">
                                                        <span class="payment_row_txt">Số 5-7 phố Yên Bái II, quận Hai Bà Trưng, TP. Hà Nội</span>
                                                        <span class="payment_row_txt">Điện thoại: 024.3821.5570  |  <a href=""> Email: cskh@gmail.vn</a></span>
                                                    </div>
                                                </div>
                                                <div class="info_payment_item">
                                                    <div class="payment_detail_title">Showroom 2: </div>
                                                    <div class="payment_detail_row">
                                                        <span class="payment_row_txt">Số 335 Phố Huế, quận Hai Bà Trưng, TP. Hà Nội</span>
                                                        <span class="payment_row_txt">Điện thoại: 024.3821.5570  |  <a href=""> Email: cskh@gmail.vn</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix clearfix-5"></div>
                            </div>
                            
                            <h4>Chọn hình thức nhận hàng</h4>
                             
                            <div class="ship_item ship_time">
                                <div class="ship_time_title">Thời gian giao hàng:</div>
                                <label class="ship_check in_time">
                                    <div class="form_checker">
                                    <span class="checked">
                                    <input name="ship_time_type" value="1" type="radio" checked="checked"></span>
                                    </div>
                                    <span class="txt_check">Bất kỳ</span>
                                </label>
                                <label class="ship_check in_time">
                                    <div class="form_checker">
                                    <span class="checked">
                                    <input name="ship_time_type" value="2" type="radio"></span>
                                    </div>
                                    <span class="txt_check">Trong giờ hành chính</span>
                                </label>
                                <label class="ship_check out_time">
                                    <div class="form_checker">
                                    <span class="checked">
                                    <input name="ship_time_type" value="3" type="radio"></span>
                                    </div>
                                    <span class="txt_check">Ngoài giờ hành chính</span>
                                </label>
                            </div>
 
                                <button type="submit" class="site-btn">GỬI ĐƠN HÀNG</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection 