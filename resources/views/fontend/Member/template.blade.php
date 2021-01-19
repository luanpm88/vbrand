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
                <li class="breadcrumb-item"><a href="javascript:void(0);">DASHBOARD</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">HỆ THỐNG</a></li>
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

<section class="hotproducts mb-4">
  <div class="list-sp">
                <div class="row">
  @foreach( $data as $items)
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 item-frames">
    <div class="item-game-wrapper">
      <div class="img">
        <a href="{{ url('member/template/'.$items->slug) }}">
          <img class="check_img_errs" src="{{ url('Upload/Post/'.$items->photo) }}" alt="">
        </a>
      </div>
      <div class="item-info">
        <div class="item-title">
          <a href="{{ url('member/template/'.$items->slug) }}">{{ $items->title }}</a>
        </div>
        <div class="item-price">
          <p class="price">
            <span class="cur-p">458,000đ</span>
          </p>
        </div>
        <div class="item-btn-a">
          <a href="javascript:void(0);" onclick="cart.add('97', '1',this);">
            <i class="fas fa-shopping-cart"></i>
          </a>
        </div>
        <div class="item-btn" onclick="cart.buyNow('97', '1',this);" style="margin-top: 10px">Mua ngay</div>
      </div>
    </div>
  </div>


  @endforeach 
                                   
</div>
 
</div>
</section>

 
  </form> 
</div> 
@endsection()