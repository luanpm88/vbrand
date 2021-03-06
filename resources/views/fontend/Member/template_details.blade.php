@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-10">
            <h4 class="page-title">QUẢN TRỊ GIAO DIỆN WEBSITE</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('member') }}">DASHBOARD</a></li> 
                <li class="breadcrumb-item active">GIAO DIỆN WEBSITE</li>
            </ol>
        </div> 
    </div>
</div>
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif 
  <form  method="post">
    @csrf

<section class="templates mb-4">
    

@if($data)
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <div class="item-game-wrapper">
      <div class="imgs">          
        @if (!empty($data->photo))
          <img src="{{ asset('upload/Template/'.$data->photo) }}" class="card-img-top"  >
        @endif        
      </div>
      <div class="item-info"> 
        <div class="item-func">
            <div class="row pt-2">
                <div class="col-md-6 col-xs-6">
                  <div class="text-left">
                    <span class="card-text "></span>
                  </div>
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
                     
                </div>
            </div>
        </div>

      </div>
      
  
    </div>
    <form  method="post">
        @csrf
      <input type="hidden" name="template_id" value="{{ $data->id }}">
<div id="button-cart-redirect" class="btn btn-green-bg col-md-5 product-content-button-ml">Xem demo </div>
@if($user->template_id)
      @if($user->template_id == $data->id)
        <button type="submit" class="btn btn-orange-bg col-md-5 add-cart-orange">Approved</button>
      @else
        <button  type="submit" class="btn btn-orange-bg col-md-5 add-cart-orange" > CHỌN GIAO DIỆN NÀY  </button>
      @endif
    @else
      <button  type="submit" class="btn btn-orange-bg col-md-5 add-cart-orange" > CHỌN GIAO DIỆN NÀY  </button>
    @endif  
 
    </form>
    

  
  </div>
  <div class="col-md-6 col-xs-6 bar-buy-product product-content-button">
    <div class="template_details">
      <h1>{{ $data->title ?? '' }} </h1>
      <p class="template_des">{{ $data->description ?? '' }} </p>
      <p class="template_price">Giá: {{ $data->price ?? 'Miễn Phí' }} </p>
      <p class="template_des">
          Bạn còn: 112 ngày
      </p>
    </div>
    <div class="template_func">
      <h2>Chức năng</h2>
      <ul>
        <li>Trang chủ</li>
        <li>Trang giới thiệu</li>
        <li>Trang sản phảm</li>
        <li>Trang chi tiết</li>
        <li>Trang tin tức</li>
        <li>Trang chuyên mục</li>
        <li>Trang chi tiết tin tức</li>
        <li>Trang tìm kiếm</li>
        <li>Trang tag</li>
      </ul>
    </div>
  
  
  </div>

  </div>

</div>
  @endif
</div>
</section>

 
  </form> 
</div> 
@endsection()