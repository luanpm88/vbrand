@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
 
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif

<div class="list-group mb-4">
@if(!empty($user->domain))

  <div class="list-group-item ">
    <div class="d-flex w-100 justify-content-between">
      <h3 class="mb-1"> {{ __('mem.domain') }} </h3>
    </div>
    <div class="d-flex w-100 justify-content-between">
      <p class="mt-3 mb-2">
        Bạn đang có tên miền: 
        <strong>{!! $user->domain ?? '' !!}</strong> <a href="{{ url('member/domain/edit') }}"><i class="fa fa-edit"></i> </a>  , Sẽ hết hạn vào ngày: {{ $user->created_at->format('d-m-Y') }}
      </p>
      <div class="template-img mb-3"><img src="{{ url('upload/Images/domain.jpg') }}" class="w-100 "></div>
    </div>    
  </div>
  <div class="list-group-item">
    <div class="w-100 text-right">
      <a href="tel:0838068268" class="btn btn-secondary"><i class="fa fa-plus"></i> MUA THÊM TÊN MIỀN</a>
    </div>   
  </div>

@else

  <div class="list-group-item pb-4">
    <div class="d-flex w-100 justify-content-between">
      <h3 class="mb-1"> {{ __('mem.domain') }} </h3>
    </div>
    <div class="w-100 justify-content-between">
      <p class="mt-3 mb-2">Cập nhật tên miền</p>
      <form method="post">
      @csrf
      <div class="row">
        <div class="col-lg-6">
            <input id="domain" name="domain" type="text" class="form-control" value="{{ $data->domain ?? '' }}">
            <p class="pt-2">Ex: brand.com.vn</p>
        </div>
        <div class="col-lg-6"><button type="submit" class="btn btn-secondary">Cập nhật</button> </div>
      </div>
      <form>
    </div> 
     

  </div>
  <div class="list-group-item">
    <div class="w-100">
      <strong>Lưu ý</strong>: nếu bạn chưa có tên miền, Liên hệ ngay chúng tôi<span class="hot"> HOTLINE: <a href="tel:0838 068 268" class="bold ">0838 068 268</a> - 24/7 </span>
    </div>   
  </div>

@endif
</div> 
 
@endsection()