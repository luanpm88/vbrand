@extends('fontend.layouts.products')
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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('layout.product_list') }}</li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>{{ __('layout.product') }}</h4>
                            <ul>
                                @foreach($maincate as $row)
                                <li><a href="{{ url('category',$row->slug) }}">{{ $row->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>{{ __('layout.search') }}</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    @if(isset($saleoff))
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>{{ __('layout.saleoff') }}</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach($saleoff as $row)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            @if (!empty($row->photo))
                                            data-setbg="{{ asset('upload/Product/'.$row->photo) }}"
                                            @endif
                                            >
                                            <div class="product__discount__percent">-{{ $row->saleoff }}%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="{{ url('add-to-cart',$row->id) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="{{ url('products',$row->slug) }}">{{ $row->title }}</a></h5> 
                                            <div class="product__item__price">{{ number_format(  $row->price * ( 100- $row->saleoff )/100 ,0) }}  {{ $row->currency }} <span>{{ number_format($row->price,0) }} {{ $row->currency }}</span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    @endif



                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>{{ __('layout.sortby') }}</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>16</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                     @if(isset($data))
                    <div class="row">                       
                        @foreach($data as $row)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                @if (!empty($row->photo))
                                    data-setbg="{{ asset('upload/Product/'.$row->photo) }}"
                                @endif                                    
                                >
                                    <ul class="product__item__pic__hover">
                                        <li><a href="{{ url('products/',$row->slug) }}"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="{{ url('add-to-cart',$row->id) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ url('products',$row->slug) }}">{{ $row->title }}</a></h6>
                                    <h5>{{ number_format($row->price,0) }} đ</h5>
                                </div>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                    <div class="product__pagination">
                        {{ $data->links() }}
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    
@endsection()