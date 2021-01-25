@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-10">
            <h4 class="page-title">CHỌN GÓI DỊCH VỤ</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">DASHBOARD</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">CÀI ĐẶT</a></li>
                <li class="breadcrumb-item active">CẬP NHẬT GÓI DỊCH VỤ</li>
            </ol>
        </div> 
    </div>
</div>
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif 
  
 
  <section class="hotproducts mb-4">
  <div class="list-sp">
    <div class="row">

       
      @foreach( $data as $items)
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
                <button type="submit" class="btn btn-lg btn-block btn-primary">Choose</button>
              @else
                <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Choose</button>
              @endif
            @else
              <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Choose</button>
            @endif
          </div>
        </div>
        </form> 
      </div>
      @endforeach



    </div>
  </div>
</section>
   
 
  
</div> 
@endsection()