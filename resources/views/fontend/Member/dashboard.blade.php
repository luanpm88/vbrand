@extends('fontend.Member.master')
@section('content') 
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif

 @if(!empty($user->package_id))
<div class="alert alert-success" role="alert">
  {{ __('mem.package_name') }} : <strong>{{ $user->package->title }}</strong>, Giá: {{ Str::currency($user->package->price) ?? '' }}<sup>đ</sup> <small class="text-muted">/ Tháng</small>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
 @if(!empty($user->template_id))
<div class="alert alert-success" role="alert">
  {{ __('mem.package_name') }} : <strong>{{ $user->package->title }}</strong>, Giá: {{ Str::currency($user->package->price) ?? '' }}<sup>đ</sup> <small class="text-muted">/ Tháng</small>
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
                <form  method="post">@csrf
                  <input type="hidden" name="template_id" value="{{ $items->id }}">
                  <button type="submit" class="btn full-width btn-outline-primary">{{ __('mem.choose') }}</button>
                </form>
              @endif
            </div>
          </div>
          </form> 
        </div>
        @endforeach
      </div>
    </div>
  </section>
@elseif(empty($user->templates_id)) 
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

@endif


@if (empty($user->domain))
  <div class="alert alert-warning" role="alert">
    <strong>{{ __('mem.domain_not_choose') }}</strong>, ( nếu bạn chưa có tên miền, Liên hệ ngay chúng tôi<span class="hot"> HOTLINE: <a href="tel:0838 068 268" class="bold ">0838 068 268</a> - 24/7 </span>)
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<div>

  <p><i>Lưu ý, các bước trên phải hoàn thiện để bạn có thể sử dụng dịch vụ của chúng tôi.</i></p>
</div>
@endsection()