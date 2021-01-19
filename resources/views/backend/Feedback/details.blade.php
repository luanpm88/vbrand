@extends('backend.layouts.master')

@section('content')
 
<form method="post" enctype="multipart/form-data">
@csrf
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Quản trị Liên hệ</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/feedback') }}">Phản hồi</a></li>
                <li class="breadcrumb-item active">Chi tiết Phản hồi</li>
            </ol>
        </div> 
    </div>
</div>
<!-- end row -->
<div class="row">
	<div class="col-lg-12">
		<div class="card-body">
            <div>
	            @if (Session::has('messenge'))
			    <div class="alert alert-success" role="alert">
			        <strong> {{ Session::get('messenge') }}</strong>.
			    </div>
			    @endif	        
            </div>
        </div>
    </div>
    <!-- end row -->
</div>


<div class="row">
	<!--Chuyên mục-->
    <div class="col-lg-12">
    	 <div class="card">
            <div class="card-header">
              CHI TIẾT PHẢN HỒI
            </div>
            <div class="card-body">  
    				  <h4>Name: </h4><p>{{ $details->name }}</p>
              <h4>Email: </h4><p>{{ $details->email }} </p>
              <h4>Phone: </h4><p>{{ $details->phone }} </p>               
              <h4>Description:</h4><p>{{ $details->desription }}</p>
            </div>
            <div class="card-footer">
              <p>Date: {{ $details->created_at }}</p>
            </div>
        </div>

    </div> <!-- end col -->
</div> <!-- end row --> 

<div class="row">
  <div class="col-lg-12">
       <div class="card">
            <div class="card-body">
              <div class="button-items">
                    <a class="btn btn-success waves-effect waves-light" href="{{ url('admin/feedback') }}" > Trở lại </a>
                   <a class="btn btn-danger waves-effect waves-light" href="{{ url('admin/feedback/del', $details->id) }}"> Xóa bỏ</a>
                </div> 
           </div>
        </div>
    </div>
</div>
@endsection 