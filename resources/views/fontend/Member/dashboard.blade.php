@extends('fontend.Member.master')
@section('content') 
    <section class="breadcrumb-section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> {{ __('layout.home') }}</a></li> 
                        <li class="breadcrumb-item active" aria-current="page"> {{ __('layout.aboutus') }} </li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section>
<section class="blog"> 
  <div class="blog-body">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">  
            <div class="blog-details">
                sss
            </div>
            <div class="blog-keyword">
                sss
            </div>             
          </div> 
      </div>
  </div>
</section>
@endsection()