@extends('fontend.Member.master')

@section('content')
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
                  <p class="text-center"><a href="{{ url('member/profile/edit') }}"><i class="fa fa-edit"></i> đổi avatar</a></p>
                </div>
                <div class="col-md-9 col-lg-9 mb-4">
                  @if (Session::has('messenge'))
                    <div class="alert alert-success" role="alert">
                      <a class="panel-close close" data-dismiss="alert">×</a> 
                      <i class="fa fa-coffee"></i> <strong> {{ Session::get('messenge') }}</strong>.
                    </div> 
                  @endif
                    
                   
                  <div class="row form-group">
                    <div class="col-lg-3 control-label text-right">{{ __('mem.firstName') }}:</div>
                    <div class="col-lg-8">
                      {{ $user->firstName ?? '*****' }}
                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col-lg-3 control-label text-right">{{ __('mem.lastName') }}:</div>
                    <div class="col-lg-8">
                      {{ $user->lastName ?? '*****' }}
                    </div> 
                  </div>
                
                  <div class="row form-group">
                    <div class="col-lg-3 control-label text-right">Tên Thương mại:</div>
                    <div class="col-lg-8">
                      {{ $user->name ?? '*****' }}
                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col-lg-3 control-label text-right">{{ __('mem.phoneNumber') }}:</div>
                    <div class="col-lg-8">
                      {{ $user->phoneNumber ?? '*****' }}
                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col-lg-3 control-label text-right">Email:</div>
                    <div class="col-lg-8">
                      {{ $user->email ?? '' }}
                    </div> 
                  </div> 
                  
                  <div class="row form-group">
                    <div class="col-lg-3 control-label text-right">{{ __('mem.password') }}:</div>
                    <div class="col-lg-8">
                      {{ $user->password ?? '******' }}
                      <p class="lastupdate">{{ __('mem.lastchange') }}: {{ $user->updated_at->format('d/m/Y') ?? '' }} </p>
                    </div> 
                  </div> 

                  <div class="row form-group"> 
                    <div class="col-lg-2"></div>                     
                    <div class="col-lg-8">
                      <a href="{{ url('member/profile/edit') }}" class="btn btn-outline-secondary btn-small"><i class="fa fa-edit"></i> {{ __('mem.change_info') }}</a>
                    </div>                       
                  </div>
                     
                </div>
               
      
       
  </div>
</div>
 
 
 
@endsection()