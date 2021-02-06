@extends('fontend.Member.master')

@section('content')
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif

 
      <div class="w-100 mb-4 ">        
        <h3>TỔNG QUAN TÀI KHOẢN CỦA BẠN</h3>
        <p>CHÀO MỪNG BANJN ĐẾN VỚI <strong>BRANDVIET</strong>, NƠI TẬP TRUNG QUẢN LÝ BUSSENESS CỦA BẠN</p>
      </div>    


@if(!empty($user->package_id))
 
<div class="list-group mb-4 mt-4">
  <div class="list-group-item">
    <div class="d-flex w-100 justify-content-between">
      <h3 class="mb-1">
        {{ __('mem.package_name') }} : {{ $user->package->title ?? '' }} 
       
      </h3>
      <small><a href="{{ url('member/package') }}"><i class="fa fa-edit"></i> Đổi Gói Website</a> </small>
    </div>
    <div class="row mt-3">
      <div class="col-lg-6"><p class="mb-2">{!! $user->package->description ?? '' !!}</p> </div>
      <div class="col-lg-6">
       <p class="mb-2"> Ngày đăng ký: {{ $user->created_at->format('d-m-Y') ?? '' }}</p>
       <p class="mb-2"> Dung lượng: 150MB/600MB</p>
       <p class="mb-2"> Email Account: 15/20 </p>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-lg-12">
         Giá: {{ Str::currency($user->package->price) ?? '' }}<sup>đ</sup> <small class="text-muted">/ Tháng</small>
      </div>
    </div>
    
  </div>
  <div class="list-group-item  ">
    <div class=" w-100 text-right">
      <form method="post" action="{{ url('member/package/add') }}">@csrf
        <input type="hidden" name="package_id" value="{{ $user->package->id ?? '' }}">
        <button type="submit" class="btn btn-secondary">Bạn còn 15 ngày nữa, Vui lòng gia hạn ngay</button>
      </form>
    </div>   
  </div>
</div>
 
@endif

@if(!empty($user->template_id))
 
<div class="list-group mb-4 mt-4">
  <div class="list-group-item   ">
    <div class="d-flex w-100 justify-content-between">
      <h3 class="mb-1">
        {{ __('mem.template_name') }} : {{ $user->template->title ?? '' }}  
      </h3>
      <small><a href="{{ url('member/template') }}"><i class="fa fa-edit"></i> Đổi giao diện website</a></small>
    </div>
    <div class="row mt-3">
      <div class="col-lg-6">
        <p class="mt-3 mb-2">{!! $user->template->description ?? '' !!}</p>
      </div>
      <div class="col-lg-6">
        <div class="template-img mb-3"><img src="{{ url('upload/Template/'.$user->template->photo) }}" class="w-100 "></div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-lg-12">
         Giá: {{ Str::currency($user->template->price) ?? '' }}<sup>đ</sup> <small class="text-muted">/ Tháng</small>
      </div>
    </div>
    
  </div>
  <div class="list-group-item">
    <div class="w-100 text-right">
      <form method="post" action="{{ url('member/template/add') }}">@csrf
        <input type="hidden" name="template_id" value="{{ $user->template->id ?? '' }}">
        <button type="submit" class="btn btn-secondary">Bạn còn 15 ngày nữa, Vui lòng gia hạn ngay</button>
      </form>
    </div>   
  </div>
</div>  
 
@endif

@if (!empty($user->domain))
<div class="alert alert-success" role="alert">
  {{ __('mem.domain_name') }} : <strong>{{ $user->domain ?? '' }}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(empty($user->package_id))
  <div class="alert alert-warning" role="alert">
    <strong>Bạn chưa chọn gói website</strong>, Hãy chọn ngay GÓI WEBSITE phía dưới đây.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <section class="hotproducts mb-4">
    <div class="list-sp">
      <div class="row"> 
        @foreach( $data['package'] as $items)
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <form  method="post">
          @csrf
          <input type="hidden" name="package_id" value="{{ $items->id }}">
          <div class="card ">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">{{ $items->title }}</h4>
            </div>
            <div class="card-body">
              <p class="card-title pricing-card-title">{{ Str::currency($items->price) ?? '' }}<sup>đ</sup> <small class="text-muted">/ Tháng</small></p>
              <p class="list-unstyled mt-3 mb-4">{!! $items->description !!}</p>
              @if($user->package_id)
                @if($user->package_id == $items->id)
                  <button type="submit" class="btn full-width btn-primary">{{ __('mem.choose') }}</button>
                @else
                  <form  method="post">@csrf
                    <input type="hidden" name="template_id" value="{{ $items->id }}">
                    <button type="submit" class="btn full-widthk btn-outline-primary">{{ __('mem.choose') }}</button>
                  </form>
                @endif
              @else                 
                  <button type="submit" class="btn full-width btn-outline-primary">{{ __('mem.choose') }}</button>                
              @endif
            </div>
          </div>
          </form> 
        </div>
        @endforeach
      </div>
    </div>
  </section>

@elseif(empty($user->template_id)) 

<div class="alert alert-warning" role="alert">
  <strong>{{ __('mem.package_not_choose') }}</strong>, Vui lòng chọn giao diện website bên dưới.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
 
<section class="hotproducts mb-4">
<div class="list-sp">
  <div class="row">
    @foreach( $data['template'] as $items)
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 item-frames">
      <form  method="post">@csrf
      <input type="hidden" name="template_id" value="{{ $items->id }}">
      <div class="item-game-wrapper">
        <div class="imgs">
          <a href="{{ url('member/template',$items->slug) }}">
          @if (!empty($items->photo))
            <img src="{{ asset('upload/Template/'.$items->photo) }}" class="card-img-top"  >
          @endif
          </a>
        </div>
        <div class="item-info">
          <div class="item-title">
            <a href="{{ url('member/template/'.$items->slug) }}">{{ $items->title }}</a>
          </div>
          <div class="item-price">
            <p class="price">
              @if(!empty($items->price))
                {{ Str::currency($items->price) ?? '' }}<sup>đ</sup> <small class="text-muted">/ Tháng</small>
              @else
                <span class="cur-p">Miễn phí</span>
              @endif
            </p>
          </div>
          <div class="item-func">
            <div class="row pt-2">
              <div class="col-md-6 col-xs-6">
                <div class="text-left"><span class="card-text "></span></div>
                <div class="price details-price pb-10 " style="color:#ffc107; text-align: left;">
                  <div>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i> 
                    <i class="bi bi-star-half"></i>
                    <i class="bi bi-star"></i> 
                  </div>     
                </div>
              </div>
              <div class="col-md-6 col-xs-6">
                <div class="star text-right p-0">
                  @if($user->template_id)
                    @if($user->template_id == $items->id)
                    <button type="submit" class="btn btn-lg btn-block btn-primary">Approved</button>
                    @else
                    <button type="submit" class="btn btn-outline-success">CHỌN</button>
                    @endif
                  @else
                    <button type="submit" class="btn btn-outline-success">CHỌN</button>
                  @endif  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
    @endforeach  
  </div>
</div>
</section>

@elseif(empty($user->domain))
  <div class="alert alert-warning" role="alert">
    <strong>{{ __('mem.domain_not_choose') }}</strong>, ( nếu bạn chưa có tên miền, Liên hệ ngay chúng tôi<span class="hot"> HOTLINE: <a href="tel:0838 068 268" class="bold ">0838 068 268</a> - 24/7 </span>)
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <div class="row mb-4">
  <!--Chuyên mục-->
    <div class="col-lg-12"> 

      <div class="card ">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{ __('mem.domain_update') }}</h4>
          </div>
          <div class="card-body">
         
            <form  method="post">@csrf
              <div class="form-group mb-1">
                <label class="control-label">{{ __('mem.domain_input') }}</label>
              </div>
              <div class="form-group">
                <div class="row">
            
              
                  <div class="col-lg-9 mb-2">
                    <input type="text" autocomplete="off"  class="form-control" name="domain"  value="{{ old('domain') ?? '' }}">
                  </div>
                  <div class="col-lg-3">
                    <select name="dot" class="select2 form-control">
                      <option value=".com.vn">.com.vn</option>
                      <option value=".com">.com</option>
                      <option value=".vn">.vn</option>
                      <option value=".net">.net</option>
                      <option value=".org">.org</option>
                    </select> 
                  </div>
                 
                  <div class="col-lg-12 mb-4">
                    <button type="submit" class="btn btn-outline-primary btn-small">{{ __('mem.save') }}</button>
                  </div>
                  <div class="col-lg-12 mb-1">
                    <p><strong>Lưu ý</strong>: <i>Tên miền Chỉ nhập số và chữ</i></p>
                  </div>
                  <div class="col-lg-12">
                    <p><strong>ĐỪNG KINH DOANH KHI CHƯA CÓ TÊN MIỀN</strong>, Hãy bảo vệ thương hiệu của bạn ngay từ bây giờ</p>
                  </div>

                        <div class="col-lg-12 mb-2">
                  <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2">@example.com</span>
  </div>
</div>


                </div>
              </div> 
            </form>
        </div>
      </div> 
    </div> <!-- end col -->
    
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
                      @elseif($item->type ==1 )
                        <li>T
                          emplate <strong>{{ $item->template->title ?? '' }}</strong>: 
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


 



<div class="row">
  <div class="col-lg-12 ">
    <p><i>Lưu ý, các bước trên phải hoàn thiện để bạn có thể sử dụng dịch vụ của chúng tôi.</i></p>
  </div>
</div>
@endsection()