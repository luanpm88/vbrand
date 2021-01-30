@extends('fontend.Member.master')
@section('title', 'Cart') 
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> {{ __('layout.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('order') }}">{{ __('layout.order') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('layout.payment_info') }}</li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container"> 
            <div class="checkout__form">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>{{ __('layout.order_details') }}</h4>
                    </div>
                </div>
                <form action="{{ url('payment-handle',$order->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                <h4>{{ __('layout.shipping_info') }}</h4>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>{{ __('layout.shipping_recipt') }}<span>*</span></p>
                                        <input type="text" name="recept_name" value="{{ old('recept_name') ?? $data->recept_name ?? '' }}">
                                    </div>
                                </div>
                            </div>                             
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>{{ __('layout.phone') }}<span>*</span></p>
                                        <input type="text" name="recept_phone" value="{{ old('recept_phone') ?? $data->recept_phone ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>{{ __('layout.email') }}<span>*</span></p>
                                        <input type="text" name="recept_email" value="{{ old('recept_email') ?? $user->email ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>{{ __('layout.address') }}<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ giao hàng" name="recept_address" class="checkout__input__add" value="{{ old('recept_address') ?? $data->recept_address ?? '' }}"> 
                            </div> 
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    {{ __('layout.note_other') }} ?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input"> 
                                <input type="text" placeholder="{{ __('layout.content') }}" name="recept_note" value="{{ old('recept_note') ?? $data->recept_note ?? '' }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>{{ __('layout.shipping') }}<span>*</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">    
                                <div class="col-lg-4">
                                    <input type="checkbox" id="forviettel" name="shipping[]" value="viettel"> - viettel
                                </div>
                                <div class="col-lg-4">                                    
                                    <input type="checkbox" id="forother" name="shipping[]" value="giaohangtietkiem"> - eco
                                </div>
                                <div class="col-lg-4">                                    
                                    <input type="checkbox" id="sms" name="shipping[]" value="sms"> - sms                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="checkout__order">
                                <h4>{{ __('layout.order') }}</h4>
                                <div class="checkout__order__products">
                                    {{ __('layout.product') }} <span>{{ __('layout.money') }}</span>
                                </div>
                                <ul>
                                    <?php $total = 0 ?> 
                                    @if(session('cart'))  
                                    @foreach(session('cart') as $id => $details)
                                    <?php $total += $details['price'] * $details['quantity'] ;?>
                                    <li>{{ $details['name'] }} <span>{{ number_format( ($details['price'] * $details['quantity']),0) }} đ</span></li> 
                                    @endforeach
                                    @endif
                                </ul>
                                <div class="checkout__order__subtotal">
                                    {{ __('layout.total') }} <span>{{ number_format($total,0) }} {{ $details['currency'] }}</span>
                                </div>
                                <div class="checkout__order__total">
                                    {{ __('layout.summary') }} <span>{{ number_format($total,0) }} {{ $details['currency'] }}</span>
                                </div>
                                <input type="submit" name="ordermaker" class="btn btn-primary mt-3" value="{{ __('layout.ordermaker') }}">
                                <input type="submit" name="pay" class="btn btn-primary mt-3" value="{{ __('layout.ordermake_paypalpayment') }}">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection 