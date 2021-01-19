<!DOCTYPE html>
<html lang="vi-vn">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="HK Fashion">
    <meta name="keywords" content="HK Fashion">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eco</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="tylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css"> 
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>
                @if(session('cart'))
                    {{ count((array) session('cart')) }}
                @endif
                </span></a></li>
            </ul>
            <?php $total = 0 ?>
            @if(session('cart'))
            @foreach((array) session('cart') as $id => $details)
                <?php $total += $details['price'] * $details['quantity'] ?>
            @endforeach
            @endif
            <div class="header__cart__price"><span>{{ $total }}</span></div>
        </div>
        <div class="humberger__menu__widget">            
            @guest
                <a href="{{ route('login') }}"><i class="fa fa-user"></i> {{ __('layout.signup') }}</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}">{{ __('layout.Login') }}</a>         
                @endif
            @else
            <div class="header__top__right__language">
                <div><b>{{ Auth::user()->name }}</b></div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li>
                        <a href="{{ url('/order') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('layout.order') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('profile') }}"><i class="fa fa-user"></i> {{ __('layout.persion_info') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('myproducts') }}"><i class="fa fa-user"></i> {{ __('layout.product_mng') }}</a>
                    </li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('layout.logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @endguest

 
            
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ url('/') }}">{{ __('layout.home') }}</a></li>
                <li><a href="{{ url('products') }}">{{ __('layout.product') }}</a></li>
                <li><a href="{{ url('posts') }}">{{ __('layout.news') }}</a></li> 
                <li><a href="{{ url('contact') }}">{{ __('layout.contact') }}</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> info@ecoworld.vn</li>
                <li>{{ __('layout.wellcome') }}</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->
 
 
@if (Session::has('messenge'))
<div class="alert alert-success alert-center-point" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{!! Session::get('messenge') !!}</strong>
</div>
@endif

<!-- Header Section Begin for desktop -->

    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> info@ecoworld.vn</li>
                                <li>{{ __('layout.wellcome') }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="{{ asset('locale/en') }}">English</a> 
                                <a href="{{ asset('locale/vn') }}">Tiếng việt</a>        
                            </div> 
                        @guest
                            <div class="header__top__right__auth">
                                <a href="{{ route('login') }}"><i class="fa fa-user"></i> {{ __('layout.Login') }}</a>
                            </div>
                        @else
                            <div class="header__top__right__language">
                                <div>{{ __('layout.hello') }}: <b>{{ Auth::user()->name }}</b></div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li>
                                        <a href="{{ url('order') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('layout.order_info') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('profile') }}"><i class="fa fa-user"></i> {{ __('layout.persion_info') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('myproducts') }}"><i class="fa fa-user"></i> {{ __('layout.product_mng') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <a  href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('layout.logout') }}  <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{ url('/') }}">{{ __('layout.home') }}</a></li>
                            <li><a href="{{ url('products') }}">{{ __('layout.product') }}</a></li>
                            <li><a href="{{ url('posts') }}">{{ __('layout.news') }}</a></li> 
                            <li><a href="{{ url('contact') }}">{{ __('layout.contact') }}</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="{{ url('cart') }}">
                                    <i class="fa fa-shopping-bag"></i> 
                                    <span>
                                        {{ count((array) session('cart')) }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="header__cart__price"> <span>{{ number_format($total,0) }} </span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->