@extends('fontend.layouts.master')
@section('content')
 
    <section class="breadcrumb-section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> {{ __('layout.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('products') }}">{{ __('layout.product') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> title </li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section>
<section class="blog">
  <div class="blog-head">
    <div class="container">
      <div class="row"> 
        <div class="col-lg-12">
           <a href="{{ url('/') }}">{{ __('layout.home') }}</a> > <a href="{{ url('posts', $data->slug) }}">{{ $data->title }}</a>
        </div>
      </div>
    </div>
  </div>
  <div class="blog-body">
    <div class="container">
      <div class="row">
          <div class="col-lg-8"> 
            <div class="blog-details">
                <h3>{{ $data->title }}</h3>
                <p>title: {{ $data->title }}</p>
                <p>description: {{ $data->description }}</p>
                <p>keyword: {{ $data->keyword }}</p>
                {!! $data->content !!}  
            </div>
            <div class="blog-list">
                @foreach($other as $row)
                <div class="blog-items">

                    @if (!empty($row->photo))
                    <div class="blog-img">
                    <a href="{{ url('posts',$row->slug) }}">
                    <img src="{{ asset('upload/post/'.$row->photo) }}">
                    </a>
                    </div>
                    @endif
                    <div class="blog-title">
                        <h3><a href="{{ url('posts',$row->slug) }}">{{ $row->title }}</a></h3>
                        <p>{{ $row->description }}</p> 
                    </div>
                </div> 
                @endforeach
            </div>
            <div class="paging">{{ $other->links() }}</div>
          </div>
          <div class="col-lg-4">
            <div class="search">

              <div class="input-group">
                <input class="form-control border rounded-pill-left border-right-0" name="txtkeyword" type="search" value="search" id="example-search-input">
                <span class="input-group-append">
                  <button class="btn btn-outline-secondary border rounded-pill-right  border-left-0" type="button">
                      <span class="icon-search form-control-feedback"></span>
                  </button>
                </span>
              </div>

            </div>
            <div class="popular">
              <div class="popular-list">
                @foreach($other as $row)
                <div class="popular-items">
                    @if (!empty($row->photo))
                    <div class="popular-img">
                    <a href="{{ url('Posts',$row->slug) }}">
                    <img src="{{ asset('upload/post/'.$row->photo) }}">
                    </a>
                    </div>
                    @endif
                    <div class="popular-title">
                        <h4><a href="{{ url('posts',$row->slug) }}">{{ $row->title }}</a></h4> 
                    </div>
                </div> 
                @endforeach

              </div>

            </div>
          </div>
      </div>

  </div>
</section>
@endsection()