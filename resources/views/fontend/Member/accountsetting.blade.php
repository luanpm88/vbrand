@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">CẬP NHẬT THÔNG TIN TÀI KHOẢN</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">DASHBOARD</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">CÀI ĐẶT</a></li>
                <li class="breadcrumb-item active">TÀI KHOẢN</li>
            </ol>
        </div> 
        <div class="col-sm-6 text-right">
          <a href="#" class="btn btn-sm btn-light">Delete Account</a>
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
    <div class="theiaStickySidebar" >            
      <h3 class="subheadline">THÔNG TIN CỦA BẠN</h3>
      <div class="form-group">
          <label class="control-label">HỌ TÊN</label>
          <input type="text" class="form-control" name="description" id="description" value="{{ old('name') ?? $data->name ?? '' }}">
      </div> 
      <div class="form-group">
          <label class="control-label">ĐIỆN THOẠI LIÊN HỆ</label>
          <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') ?? $data->phone ?? '' }}">
      </div> 
      <div class="form-group">
          <label class="control-label">EMAIL</label>
          <input type="text" class="form-control" name="email" readonly="true" id="email" value="{{ old('email') ?? $data->email ?? '' }}">
      </div>
      <div class="form-group">
          <label class="control-label">ĐỊA CHỈ</label>
          <input type="text" class="form-control" name="address" id="address" value="{{ old('address') ?? $data->address ?? '' }}">
      </div>
      <div class="form-group">
          <label class="control-label">NGHỀ NGHIỆP</label>
          <input type="text" class="form-control" name="job" id="job" value="{{ old('job') ?? $data->job ?? '' }}">
      </div>
    

      <div class="form-group action">
        <button type="submit" class="btn btn-sm btn-primary">Save Settings</button> 
      </div>
    </div>
  </form> 
</div> 
@endsection()