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
    <div class="w-100 justify-content-between mb-4">
      <h3 class="mb-1"> Delivery</h3>
    </div>
    <div class="w-100 justify-content-between">   
      <form method="post" action="{{ url('member/delivery') }}">
      @csrf
      <div class="row">

        <div class="col-lg-3">
          From
          <input id="from" name="from" type="text">             
        </div>
        <div class="col-lg-3">
          to
          <input id="to" name="to" type="text">             
        </div>



        <div class="col-lg-12 mt-2"><button type="submit" class="btn btn-secondary">Cập nhật</button> </div>
      </div>
      <form>
    </div> 
     

  </div>  
</div> 
@if($data)
{{ $data->code }}
@endif
 
@endsection()