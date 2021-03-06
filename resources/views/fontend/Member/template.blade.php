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
<section class="hotproducts mb-4">
  <div class="list-sp">
    <div class="row">
      @foreach( $data as $items)
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 item-frames">
        <form  method="post">
        @csrf
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
              <p class="card-title pricing-card-title">
              @if($items->price>0)
                {{ Str::currency($items->price) ?? '' }}<sup>đ</sup> <small class="text-muted">/ Tháng</small>
              @else
                Miễn Phí
              @endif
              </p>
            </div>
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
                    <div class="star text-right p-0">
                      @if($user->template_id)
                        @if($user->template_id == $items->id)
                          <button type="submit" class="btn btn-block btn-primary">{{ __('mem.choosed') }}</button>
                        @else
                          <button type="submit" class="btn btn-outline-success">{{ __('mem.choose') }}</button>
                        @endif
                      @else
                        <button type="submit" class="btn btn-outline-success">{{ __('mem.choose') }}</button>
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

 
  </form> 
</div> 
@endsection()