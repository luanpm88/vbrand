@extends('fontend.layouts.guest')
@section('content') 
<section class="breadcrumb-section mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('profile') }}">Thành viên</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Active Code</li>
                  </ol>
                </nav>                     
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            @if (Session::has('messenge'))
            <div class="alert alert-success" role="alert">
                <strong> {{ Session::get('messenge') }}</strong>.
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Active code
                </div>
                <div class="card-body">
                    <form  method="POST" action="{{ route('fontent.reg_step3') }}">
                    	@csrf 
                    	<p>
                            Your Code: <input type="text" name="code" value="">
                            <button type="submit" class="btn btn-primary">{{ __('Active') }}</button> 
                        </p>
                        <p>
                            Your Code has send form Your Email, Pls Check. 
                        </p>
                        @if (Session::has('send_againt'))
                        <p>
                            or you <a href="{{ route('fontent.reg_resesend_code') }}">Send Code Againt</a> to your email 
                        </p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 