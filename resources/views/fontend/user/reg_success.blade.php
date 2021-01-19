@extends('fontend.layouts.guest')
@section('content')
    <section class="breadcrumb-section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> {{ __('layout.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('profile') }}">{{ __('layout.member') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('layout.home') }}</li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section> 

 @if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
    <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif  
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">{{ __('layout.member_register') }}</div>
                <div class="card-body">
					<h2>{{ __('layout.member_regsucc') }}</h2>
					<p></p> 
					<p> {{ __('layout.member_next_login', ['login_now' => 'Đăng nhập ']) }}, <a href="{{ url('login') }}">{{ __('layout.Login') }}</a>  </p>
					<p>Cảm ơn bạn đã sử dụng dịch vụ</p>
					<p>Eco World Co., Ltd</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection