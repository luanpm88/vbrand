@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-10">
            <h4 class="page-title">CHỌN GÓI DỊCH VỤ</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">DASHBOARD</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">CÀI ĐẶT</a></li>
                <li class="breadcrumb-item active">CẬP NHẬT GÓI DỊCH VỤ</li>
            </ol>
        </div> 
    </div>
</div>
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif 
  <form  method="post">
    @csrf

<section class="hotproducts mb-4">
<div class="row">
 
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 card  ">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">NOMAL</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>5 users included</li>
          <li>2 GB of storage</li>
          <li>Email support</li>
          <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Choose</button>
      </div>
    </div>
    <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-6 card  ">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">SILVER</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$25 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>20 users included</li>
          <li>10 GB of storage</li>
          <li>Priority email support</li>
          <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary">Actived</button>
      </div>
    </div>
    <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-6 card  ">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">GOLD</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$99 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>illimited users included</li>
          <li>50 GB of storage</li>
          <li>Phone, email support</li>
          <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Choose</button>
      </div>
    </div>
 
</div>
</section>

 
  </form> 
</div> 
@endsection()