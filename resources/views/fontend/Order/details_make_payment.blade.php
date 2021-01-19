@extends('fontend.layouts.guest')
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
    <!-- Shoping Cart Section Begin -->
    <form action="{{ url('payment-handle',$order->id) }}" method="post">
    @csrf
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>{{ __('layout.order_details') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-4"><h4>{{ __('layout.product_list') }}</h4></div>
                            <div class="table-responsive">
                                <table class="table mb-4">
                                    <thead>
                                        <tr>
                                            <th>{{ __('layout.image') }}</th>
                                            <th>{{ __('layout.product') }}</th>
                                            <th>{{ __('layout.price') }}</th>
                                            <th>{{ __('layout.quantity') }}</th>
                                            <th>{{ __('layout.money') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total = 0 ?> 
                                    @if($details_products) 
                                        @foreach($details_products as $details)
                                            <?php $total += $details->price * $details->quantity ;?>
                                            <tr>
                                                <td><img src="{{ asset('upload/Product/'.$details->photo) }}" width="100" height="100" alt=""></td>
                                                <td><h5>{{ $details->title }}</h5></td>
                                                <td>{{ number_format($details->price,0) }} {{ $details->currency }}</td>
                                                <td>{{ $details->quantity }}</td>
                                                <td>{{ number_format( ($details->price * $details->quantity),0) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout__form"> 
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h4>{{ __('layout.shipping_info') }}</h4>
                                                </div>
                                            </div>
                                            <div class="row">                                
                                                <div class="col-lg-12">
                                                    <div class="checkout__input">
                                                        <p>{{ __('layout.shipping_recipt') }}<span>*</span></p>
                                                        <input type="text" name="recept_name" value="{{ old('recept_name') ?? $order->recept_name ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>                             
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="checkout__input">
                                                        <p>{{ __('layout.phone') }}<span>*</span></p>
                                                        <input type="text" name="recept_phone" value="{{ old('recept_phone') ?? $order->recept_phone ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkout__input">
                                                        <p>{{ __('layout.email') }}<span>*</span></p>
                                                        <input type="text" name="recept_email" value="{{ old('recept_email') ?? $order->email ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkout__input">
                                                <p>{{ __('layout.address') }}<span>*</span></p>
                                                <input type="text" placeholder="Địa chỉ giao hàng" name="recept_address" class="checkout__input__add" value="{{ old('recept_address') ?? $order->recept_address ?? '' }}"> 
                                            </div> 
                                            <div class="checkout__input__checkbox">
                                                <label for="diff-acc">
                                                    {{ __('layout.note_other') }} ?
                                                    <input type="checkbox" id="diff-acc">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="checkout__input"> 
                                                <input type="text" placeholder="{{ __('layout.content') }}" name="recept_note" value="{{ old('recept_note') ?? $order->recept_note ?? '' }}">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="checkout__input">
                                                        <p>{{ __('layout.shipping') }}<span>*</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">    
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
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> 
   
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ url('order') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-step-backward"></i> {{ __('layout.order_list_back') }}
                            </a>
                            <button type="submit" name="pay" class="btn btn-outline-primary btn-sm" ><i class="fa fa-paypal"></i> {{ __('layout.payment_paypal') }} </button>

                            <button type="submit" name="stripepay" class="btn btn-outline-info btn-sm" ><i class="fa fa-cc-stripe"></i>
 {{ __('layout.payment_stripe') }} </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
    <!-- Checkout Section End -->
@endsection 