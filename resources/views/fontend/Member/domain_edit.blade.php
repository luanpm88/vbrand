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

  <div class="list-group-item pb-4">
    <div class="d-flex w-100 justify-content-between">
      <h3 class="mb-1"> {{ __('mem.domain') }} </h3>
    </div>
    <div class="w-100 justify-content-between">
      <p class="mt-3 mb-2">Cập nhật tên miền</p>
      <form method="post" action="{{ url('member/domain') }}">
      @csrf
      <div class="row">
        <div class="col-lg-6">
            <input id="domain" name="domain" type="text" class="form-control" value="{{ $user->domain ?? '' }}">
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
</div> 
 
@endsection()