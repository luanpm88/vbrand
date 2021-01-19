@extends('fontend.layouts.feedback')
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> {{ __('layout.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('contact') }}">{{ __('layout.contact') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('layout.contact_info') }}</li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<!-- Featured Section Begin -->
    <section class="Contact mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('layout.contact_info') }}</h4>
                        </div>
                        <div class="card-body">
                            <p>Địa chỉ: 60-49 Road 11378 New York</p>
                            <p>Điện thoại: 1900 56 1268</p>
                            <p>Email: info@ecoworld.vn</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('layout.contact') }}</h4>
                        </div>
                        <div class="card-body">
                            <h4>Cảm ơn bạn đã phản hồi lại chúng tôi</h4>
                            <p></p>
                            <p>Chúng tôi sẽ liên hệ với bạn sớm nhất có thể</p>
                            <p>Eco World</p>
                        </div> 
                    </div>

                </div>
            </div>
            
        </div>
    </section>
    <!-- Featured Section End -->  
@endsection()