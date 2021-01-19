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
                            <li class="breadcrumb-item"><a href="{{ url('cart') }}">{{ __('layout.cart') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('layout.cart_details') }}</li>
                        </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-left">{{ __('layout.image') }}</th>
                                    <th class="text-left">{{ __('layout.product') }}</th>
                                    <th>{{ __('layout.price') }}</th>
                                    <th>{{ __('layout.quantity') }}</th> 
                                    <th class="text-right">{{ __('layout.money') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php $total = 0 ?> 
                        @if(session('cart'))  
                            @foreach(session('cart') as $id => $details)
                                <?php $total += $details['price'] * $details['quantity'] ;

                                ?>
                                <tr>
                                    <td class="text-left">
                                        <img src="{{ asset('upload/Product/'.$details['photo']) }}" width="100" height="100" alt="">
                                        
                                    </td>
                                    <td class="text-left">
                                        <h5>{{ $details['name'] }}</h5>
                                    </td>
                                    <td>
                                        {{ number_format($details['price'],0) }} {{ $details['currency'] }}
                                    </td>
                                    <td>
                                        <div class="pro-qty">
                                            <input type="text" class="quantiti" name="quantity" value="{{ $details['quantity'] }}">
                                        </div> 
                                        <button class="btn btn-outline-secondary btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                                        <button class="btn btn-outline-success btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>                                        
                                    </td>
                                    <td class=" text-right">
                                        {{ number_format( ($details['price'] * $details['quantity']),0) }}  {{ $details['currency'] }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <form action="{{ url('ordermaker') }}" method="POST">
            @csrf
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="shoping__cart__btns">
                        <a href="{{ url('/products') }}" class="primary-btn cart-btn"><i class="fa fa-angle-left"></i> {{ __('layout.buy_more') }}</a> 
                        <button type="submit" class="site-btn">{{ __('layout.order_make') }}</button>
                    </div>
                </div>
                <div class="col-lg-6 text-right">
                    <div class="shoping__continue"> 
                        {{ __('layout.total') }}:  <span> {{ number_format($total,0) }}  {{ $details['currency'] }}</span>
                        <input type="hidden" name="total" readonly="true" value="{{ $total }}"> 
                    </div>
                </div>                
            </div>
            </form> 
        </div> 
    </section>
    <!-- Shoping Cart Section End --> 


@endsection
@section('scripts')
<script type="text/javascript">
    $(".update-cart").click(function (e) {
       e.preventDefault();
        var ele = $(this); 
         $.ajax({
           url: '{{ url('update-cart') }}',
           type: "POST",
           data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantiti").val(),_method: "PATCH",},
           success: function (response) {
                // console.log(response); 
                window.location.reload();
           }
        });
    });
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
       var ele = $(this);
        if(confirm("Are you sure")) {
            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                type: "POST",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"),_method: "delete",},
                success: function (response) {
                    //console.log(response);
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection