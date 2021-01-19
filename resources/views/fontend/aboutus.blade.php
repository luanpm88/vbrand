@extends('fontend.layouts.guest')
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
                <div class="blog-title">
                    <h1>{{ $data->title }}</h1>
                </div> 
                <div class="blog-content">
                    <h2 class="pb-2">{{ $data->description }}</h2>
                    {!! $data->content !!}
                </div>
            </div>
            <div class="blog-keyword">
                <p>{{ $data->keyword }}</p>
            </div>             
          </div> 
      </div>
  </div>
</section>
@endsection()