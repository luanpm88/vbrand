@extends('fontend.Member.master')
@section('content')
<form  method="post" action="{{ url('member/profile/edit') }}"  enctype="multipart/form-data">@csrf
 <div class="container bg-light mb-4">
  <div class="row">
      <div class="col-pg-12 mb-4 mt-4 text-center">        
        <h3>{{ __('mem.profile') }}</h3>
        <p>Tổng quan tài khoản trên <strong>Brandviet</strong> của bạn</p>
      </div>      
      <div class="col-md-3 col-lg-3">
        <div class="text-center mb-3">
          @if(!empty($user->avatar))
          <img src="{{ $user->avatar }}" class="avatar img-circle" alt="avatar">
          @endif
        </div>
        <p class="text-center">
          Upload hình ảnh arvatar
        </p>
        <input type="file" name="avatar" class="form-control">
      </div>
      <div class="col-md-9 col-lg-9 mb-4">
        @if (Session::has('messenge'))
          <div class="alert alert-success" role="alert">
            <strong> {{ Session::get('messenge') }}</strong>.
          </div>
          <div class="alert alert-info alert-dismissable">
            <a class="panel-close close" data-dismiss="alert">×</a> 
            <i class="fa fa-coffee"></i>
            Đây là <strong>.Thông báo</strong>. sử dụng để load thông tin <strong>quan trọng</strong> cho user.
          </div> 
        @endif
        <div class="row form-group">
          <div class="col-lg-3 control-label text-right">{{ __('mem.firstName') }}:</div>
          <div class="col-lg-8">
            <input class="form-control" type="text" name="firstName" value="{{ $user->firstName ?? '' }}" >
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-3 control-label text-right">{{ __('mem.lastName') }}:</div>
          <div class="col-lg-8">
            <input class="form-control" type="text" name="lastName" value="{{ $user->lastName ?? '' }}" >
          </div> 
        </div>      
        <div class="row form-group">
          <div class="col-lg-3 control-label text-right">Tên Thương Mại:</div>
          <div class="col-lg-8">
            <input class="form-control" type="text" name="name" value="{{ $user->name ?? '' }}" >
          </div>
        </div>

        <div class="row form-group">
          <div class="col-lg-3 control-label text-right">{{ __('mem.phoneNumber') }}:</div>
          <div class="col-lg-8">
            <input class="form-control" type="text" name="phoneNumber" value="{{ $user->phoneNumber ?? '' }}" >
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-3 control-label text-right">Email:</div>
          <div class="col-lg-8">
            <input class="form-control" type="text" value="{{ $user->email ?? '' }}" >
          </div> 
        </div> 
        <div class="row form-group">
          <div class="col-md-3 control-label"></div>
          <div class="col-md-8">
            <input type="submit" class="btn btn-primary" value="{{ __('mem.update') }}"> 
            <a href="{{ url('member/profile') }}" class="btn btn-default">{{ __('mem.cance') }}</a>
          </div>
        </div>           
      </div>    
  </div>
</div>
</form> 
@endsection()  