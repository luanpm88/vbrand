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
                        <li class="breadcrumb-item"><a href="{{ url('products') }}">{{ __('layout.product') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
                      </ol>
                    </nav>  
                </div>
            </div>
        </div>
    </section>
     
    <section class="product-details">
        <div class="container">
            <div class="row">
               
                <div class="col-lg-6 col-md-6">
                    <div class="product_pic">
                        <img src="{{ asset('upload/Product/'.$data->photo) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="details_title">
                        <h1>{{ $data->title }}</h1>
                    </div> 
                    <div class="product_description"> 
                        <p>{!! $data->description !!}</p>   
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    
<div class="product_details">
    

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>


</div>

                </div>
            </div>
        </div> 


        <div class="contact-feedback mb-4 mt-4">
            <div class="container"> 
                <form id="contactForm" name="sentMessage" novalidate="novalidate">
                    <div class="row align-items-stretch ">
                        <div class="col-md-6">
                            <div class="feedback">
                                 <div class="feedback-title">
                                    <h4>{{ __('layout.contact_info') }}</h4>
                                </div>
                                <div class="feedback-body">
                                    <div class="form-group">
                                        <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                                        <p class="help-block text-danger"></p>
                                    </div> 
                                    <div class="form-group form-group-textarea mb-md-0">
                                      <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                                      <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="text-right">
                                        <div id="success"></div>
                                        <button class="btn btn-secondary text-uppercase" id="sendMessageButton" type="submit">{{ __('layout.send_contact') }}</button>
                                    </div> 
                                </div>



                            </div>                           
                            
                        </div>
                        <div class="col-md-6">
                            <div class="feedback">
                                 <div class="feedback-title">
                                    <h4>{{ __('layout.online') }}</h4>
                                </div>
                                <div class="feedback-body">                                     
                                    <p>Hotline: <a href="tel:0906 626 217">0906 626 217</a> - ( 24/7 )</p>
                                    <p>Email: <a href="mailto:support@natrapha.com">support@natrapha.com</a></p>
                                    <p>Cơ sở 1: 716/13 Tân Kỳ - Tân Quý, Bình Hưng Hòa, Bình Tân, TP. Hồ Chí Minh</p>
                                    <p>Cơ sở 2: </p>
                                    <p>Cơ sở 3: </p>
                                </div>
                            </div>
                        </div>
                    </div> 
                </form>
            </div>
        </div>



    </section>
@endsection

@section('scripts')
@endsection