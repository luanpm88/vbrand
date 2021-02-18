@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
 
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif
 
 

<div class="list-group mb-4"> 
  <div class="list-group-item pb-4">
    <div class="d-flex w-100 justify-content-between">
      <h3 class="mb-1"> check tính năng </h3>
    </div>
    <div class="w-100 justify-content-between">
      <form method="post" action="{{ url('member/delivery') }}">
      @csrf
      <div class="row">
        <div class="col-lg-3">
            <p>From</p>
            <input id="from" name="from" type="text" >
        </div>
        <div class="col-lg-3">
            <p>To</p>
            <input id="to" name="to" type="text">
        </div>
        <div class="col-lg-3">
            <p>Weight: </p>
            <input id="to" name="to" type="text">
        </div>

        <div class="col-lg-3">
            <p>length: </p>
            <input id="length" name="length" type="text">
        </div>
        <div class="col-lg-3">
            <p>width: </p>
            <input id="width" name="width" type="text">
        </div>
        <div class="col-lg-3">
            <p>height: </p>
            <input id="height" name="height" type="text">
        </div>

        <div class="col-lg-12 mt-3"><button type="submit" class="btn btn-secondary">Check</button> </div>
      </div>
      <form>
    </div>
  </div>
</div>

<div class="col-lg-12">
  @if(isset($data))
  <p>{{ $data->code ?? '' }}</p>
  <p>{{ $data->message ?? ''  }}</p>
  <p>{{ $data->data ?? ''  }}</p>
 

  @if($data->success)
    <div class="alert alert-success" role="alert">
      <h3>GIAO HÀNG TIẾT KIỆM</h3>
      <p>Khu vực: <strong>{{ $data->fee->name }} </strong>.</p>
      <p>Giá vận chuyển: <strong>{{ $data->fee->fee }} </strong>.</p>
      <p>Bảo hiểm: <strong>{{ $data->fee->insurance_fee }} </strong>.</p>
      <p>vat: <strong>{{ $data->fee->include_vat }} </strong>.</p>
      <p>delivery_type: <strong>{{ $data->fee->delivery_type }} </strong>.</p>
      <p>dt: <strong>{{ $data->fee->dt }} - TRONG NƯỚC </strong>.</p>
      <p>delivery: <strong>{{ $data->fee->delivery }} </strong>.</p>
    </div>
  @endif 

  @endif
</div>

@endsection()