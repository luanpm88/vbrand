@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">ĐỔI MẬT KHẨU ĐĂNG NHẬP</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">DASHBOARD</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">CÀI ĐẶT</a></li>
                <li class="breadcrumb-item active">MẬT KHẨU ĐĂNG NHẬP</li>
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
    <div class="form-group">
      <label>MẬT KHẨU HIỆN TẠI</label>
      <input type="text" class="form-control" name="currentpassword" placeholder="Your current password" autofocus="">
    </div>
    <div class="form-group">
      <label>MẬT KHẨU MỚI</label>
      <input type="text" class="form-control" name="newpassword" placeholder="Your new password">
    </div>
    <div class="form-group">
      <label>NHẬP LẠI MẬT KHẨU</label>
      <input type="text" class="form-control" name="renewpassword" placeholder="Repeat new password">
    </div> 
    <div class="form-group"> 
        <div class="custom-control custom-checkbox">
          <div class="g-recaptcha" data-sitekey="6LfdGe4ZAAAAAF0V4588VPrCXDEvqDhTZUomx9D9" ></div>
        </div>
    </div> 
    <div class="form-group action">
      <button type="submit" class="btn btn-lg btn-primary">Update Password</button>
    </div>
  </form> 
</div> 
@endsection()