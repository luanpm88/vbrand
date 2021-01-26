@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-8">
            <h4 class="page-title">TÊN MIỀN CỦA BẠN</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">DASHBOARD</a></li>
                <li class="breadcrumb-item active">TÊN MIỀN</li>
            </ol>
        </div> 
    </div>
</div>
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif

  <div class="col-md-12 col-lg-12 col-xl-12"> 
<form method="post">
@csrf
      <h3 class="subheadline">BẠN ĐÃ CÓ TÊN MIỀN</h3>
      <div class="form-group">
        <label for="private_message">NHẬP TÊN MIỀN CỦA BẠN</label>
      </div> 
      <div class="form-group">
        <input type="text" id="domain" name="domain" value="{{ $data->domain ?? '' }}">
        <button type="submit" class="btn btn-lg btn-green-bg btn-sm"><i class="bi bi-plus-square"></i> LƯU LẠI</button>
      </div>
    </form>
    <form method="POST">
      @csrf
    <h3 class="subheadline">ĐĂNG KÝ MỚI TÊN MIỀN</h3>
      <div class="form-group">
          <label for="private_message">NHẬP TÊN MIỀN BẠN MUỐN ĐĂNG KÝ</label>
      </div> 
      <div class="form-group">                  
          <input type="text" id="domain">
          <button type="submit" class="btn btn-lg btn-primary btn-sm">KIỂM TRA</button>
      </div>
      <div class="form-group">
        <p>Ex: Brandviet.com</p>
      </div>
    </form>
    
  </div>
</div> 
@endsection()