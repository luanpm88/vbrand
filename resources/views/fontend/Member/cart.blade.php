@extends('fontend.Member.master')

@section('content')
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif


@if(!empty($cart))

<div class="row">
  <div class="col-lg-12 ">
    <form  method="post" action="{{ url('member/cart') }}">@csrf
    <div class="card ">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{ __('mem.payment') }}</h4>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h3>BẠN ĐÃ CHỌN</h3>
                    <ul class="bayerlist">
                      @php
                        $total = 0;                 
                      @endphp
                      @foreach($cart as $item)
                      
                      @if( $item->type ==3 )
                        <li>Domain: <strong>{{ $item->name ?? '' }}</strong> </li>
                      @elseif($item->type ==2 )
                        <li>
                          Gói Website <strong>{{ $item->package->title ?? '' }}</strong>: 
                          <strong>{{ Str::currency($item->package->price) ?? '' }}</strong><sup>đ</sup> 
                          <small class="text-muted">/ Tháng</small>
                        </li>
                        @php
                          $total += $item->package->price;
                        @endphp
                      @elseif($item->type == 1 ) 
                        <li>
                          Template <strong>{{ $item->template->title ?? '' }}</strong>: 
                          <strong>{{ Str::currency($item->template->price) ?? '' }}</strong><sup>đ</sup> 
                          <small class="text-muted">/ Tháng</small>
                        </li>
                        @php
                          $total += $item->template->price;
                        @endphp
                      @endif
                      @endforeach  
                    </ul>

                    @php 
                      $totalmin = ($total)*6;
                      $total1 = ( $total*12)*0.95;
                      $total2 = ( $total*24)*0.85;
                    @endphp

                    <p>Tổng Cộng: <strong>{{ Str::currency($total) ?? '' }} </strong><sup>đ</sup> <small class="text-muted">/ Tháng</small></p>
                    
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="month" id="payment1" value="6" checked>
                      <label class="form-check-label" for="payment1">
                        Thanh toán tối thiểu 06 tháng:  <strong>{{ Str::currency( $totalmin) ?? '' }} </strong><sup>đ</sup> <small class="text-muted">/ 06 Tháng</small>
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="month" id="payment2" value="12" >
                      <label class="form-check-label" for="payment2">
                        Thanh toán 1 năm ( chiết khấu 5% ):  <strong>{{ Str::currency( $total1) ?? '' }} </strong><sup>đ</sup> <small class="text-muted">/ 01 năm</small>
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="month" id="payment3" value="24" >
                      <label class="form-check-label" for="payment3">
                        Thanh toán 2 năm ( chiết khấu 15% ):  <strong>{{ Str::currency( $total2) ?? '' }} </strong><sup>đ</sup> <small class="text-muted">/ 02 năm</small>
                      </label>
                    </div> 

                </div>
                <div class="col-lg-6 ">
                  <h3>{{ __('mem.payment_choose') }}</h3>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymenttype" id="exampleRadios1" value="Paypal" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      <img src="{{ asset('images/paypal.png') }}"> Thanh toán qua Paypal
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymenttype" id="exampleRadios2" value="ATM">
                    <label class="form-check-label" for="exampleRadios2">
                      <img src="{{ asset('images/atm.png') }}"> Thanh toán qua ATM nội địa/Internet Banking
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymenttype" id="exampleRadios3" value="ZaloPay">
                    <label class="form-check-label" for="exampleRadios3">
                      <img src="{{ asset('images/zalopay.png') }}"> Thanh toán qua ZaloPay
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymenttype" id="exampleRadios4" value="MoMo">
                    <label class="form-check-label" for="exampleRadios4">
                      <img src="{{ asset('images/momo.png') }}"> Thanh toán bằng ví MoMo
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymenttype" id="exampleRadios5" value="Payoo">
                    <label class="form-check-label" for="exampleRadios5">
                      <img src="{{ asset('images/payoo.png') }}"> Thanh toán bằng ví Payoo
                    </label>
                  </div>
                </div> 
              </div> 
        </div>
        <div class="card-footer"> 
          <div class="form-group">
            <button type="submit" name="paybtn" value="payment" class="btn btn-outline-primary btn-small"> <i class="fas fa-plus-square"></i> TẠO ĐƠN HÀNG VÀ THANH TOÁN</button>
            <button type="submit" name="cancebtn" value="cancepayment" class="btn btn-outline-danger btn-small"><i class="fas fa-window-close"></i> HỦY CHỌN</button>
          </div> 
        </div>
      </div>  
      </form> 
  </div>
</div>

@endif

 

 
@endsection()