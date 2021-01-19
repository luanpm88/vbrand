@extends('fontend.layouts.products')
@section('content')
<section class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> {{ __('layout.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('products') }}">{{ __('layout.product') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('layout.product_list') }}</li>
                  </ol>
                </nav>                     
            </div>
        </div>
    </div>
</section>

<section class="hotproducts mb-4">
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="category mt-4">
                <div class="category-title">
                  <h4><i class="fas fa-bars"></i> SẢN PHẨM</h4>
                </div>
                <div class="category-items">
                  <ul class="categories">
                  @foreach($category as $row)
                  <li><a href="{{ url( 'category', $row->slug ) }}" class="list-group-item">{{ $row->title }}</a> </li>
                  @endforeach
                  </ul>
                </div>
            </div> 
        </div>
        <!-- /.col-lg-3 -->


        <div class="col-lg-9 text-lg-center mt-4 mb-4">
            <ul class="nav nav-pills">
                <li class="active"><a href="{{ url('products') }}">{{ __('layout.product') }}</a></li>
                <li><a href="#">Dell</a></li>
                <li><a href="#">Acer</a></li>
            </ul>
            <div class="row">               
            
            @foreach($data as $row)
            <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              @if (!empty($row->photo))
                <a href="{{ url('products',$row->slug) }}">
                  <img class="card-img-top"  src="{{ asset('upload/Product/'.$row->photo) }}">
                </a>
              @endif
              <div class="card-body">
                <h4 class="card-title">
                  <a href="{{ url('products',$row->slug) }}">{{ $row->title }}</a>
                </h4> 
                <p class="card-text">{{ $row->description }}</p>
              </div>
              <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                     <a href="{{ url('products',$row->slug) }}" class="btn btn-sm btn-outline-secondary">Chi tiết</a> 
                  </div>
                  <small class="text-muted">{{ number_format($row->price,0) }} {{ $row->currency }}</small>
                </div>

                 
              </div>
            </div>
          </div> 

            @endforeach  
            <div class="col-lg-12 text-lg-center">
                <div class="paging">{{ $data->links() }}</div> 
            </div>  
            </div>
        </div>
    </div>
    
</div>
</section>    
@endsection()