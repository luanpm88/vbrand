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
            <div class="card">
                <div class="card-header">
                    Active code
                </div>
                <div class="card-body">
                    <form  method="POST" action="{{ route('fontent.reg_resesend_code') }}">
                    	@csrf
                    	<p>
                            Your Email: <input type="text" name="email" value="{{ old('email') }}">
                            <button type="submit" class="btn btn-primary">{{ __('Send code for me') }}</button> 
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 