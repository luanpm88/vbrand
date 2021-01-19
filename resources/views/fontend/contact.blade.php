@extends('fontend.layouts.guest')
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
                            <p>Địa chỉ: 249 Cộng Hòa, Tân Bình, Tp. Hồ Chí Minh</p>
                            <p>Điện thoại: (84) 838 068 268 </p>
                            <p>Email: info@brandviet.com.vn</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7"> 
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('layout.contact') }}</h4>
                        </div>
                        <div class="card-body">
                            @if(Session::has('contact_success')) 
                             <h4>Cảm ơn bạn đã phản hồi lại chúng tôi</h4>
                            <p></p>
                            <p>Chúng tôi sẽ liên hệ với bạn sớm nhất có thể</p>
                            <p>Brand Việt</p>
                            @else
                            <form method="post" action="{{ url('/contact') }}">
                                @csrf 
                            <div class="form-group">
                                <label class="control-label">{{ __('layout.email') }}</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email',isset($data->email) ? $data->email : '') }}">
                            </div>  
                            <div class="form-group">
                                <label class="control-label">{{ __('layout.phone') }}</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone',isset($data->phone) ? $data->phone : '') }}">
                            </div> 
                            <div class="form-group">
                                <label class="control-label">{{ __('layout.content') }}</label>
                                <input type="text" class="form-control" name="desription" value="{{ old('phone',isset($data->desription) ? $data->desription : '') }}">
                            </div> 
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LfdGe4ZAAAAAF0V4588VPrCXDEvqDhTZUomx9D9"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="contact100-form-btn">{{ __('layout.send_contact') }} </button>
                        </div>
                        </form>
                        @endif
                    </div>

                </div>
            </div>
            
        </div>
    </section>
    <!-- Featured Section End -->  
@endsection()