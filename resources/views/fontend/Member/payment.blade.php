@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-8">
            <h4 class="page-title">THÔNG TIN THANH TOÁN</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('member') }}">DASHBOARD</a></li> 
                <li class="breadcrumb-item active">THANH TOÁN</li>
            </ol>
        </div> 
    </div>
</div>
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif 
   



</div> 
@endsection()