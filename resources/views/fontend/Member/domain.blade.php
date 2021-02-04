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


<div class="card ">
  <form method="post">
  @csrf
  <div class="card-header">
    <h4 class="my-0 font-weight-normal">DOMAIN CỦA BẠN</h4>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg4 col-md-4 col-sm-6 col-xs-6">
         <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text">Domain</div>
    </div>
    <input id="domain" name="domain" type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username" value="{{ $data->domain ?? '' }}">
  </div>

         
      </div>
      <div class="col-lg4 col-md-4 col-sm-6 col-xs-6">
        <button type="submit" class="btn btn-secondary">Cập nhật</button> 
      </div>
      
    </div>
  </div>
  <div class="card-footer">
      <strong>Lưu ý</strong>: nếu bạn chưa có tên miền, Liên hệ ngay chúng tôi<span class="hot"> HOTLINE: <a href="tel:0838 068 268" class="bold ">0838 068 268</a> - 24/7 </span>
  </div>
</form>
</div> 


 




</div> 
@endsection()