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
                        <li class="breadcrumb-item"><a href="{{ url('profile') }}">{{ __('layout.member') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('layout.member_info') }}</li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shoping Cart Section Begin -->
    <section class="profile">
        <div class="container">
           
<form method="post" enctype="multipart/form-data">
@csrf
<div class="row mb-4">
	<!--Chuyên mục-->
    <div class="col-lg-6">
    	 <div class="card">
    	 	<div class="card-header">
    	 		{{ __('layout.account') }}
    	 	</div>
            <div class="card-body">  
  				<div class="form-group">
  					<label class="control-label">{{ __('layout.account') }}</label>
  					<input type="text" class="form-control" name="name" value="{{ old('title',isset($data->name) ? $data->name : '') }}">
  				</div>
	          	<div class="form-group">
	            	<label class="control-label">{{ __('layout.email') }}</label>
	            	<input type="text" class="form-control" name="email" value="{{ old('email',isset($data->email) ? $data->email : '') }}">
	          	</div>
	          	<div class="form-group">
	            	<label class="control-label">{{ __('layout.password') }}</label>
	            	<input type="password" class="form-control" name="password" value="{{ old('password',isset($data->password) ? $data->password : '') }}">
	          	</div>
  				
  				<div class="form-group">
  					<label class="control-label">{{ __('layout.phone') }}</label>
  					<input type="text" class="form-control" name="phone" value="{{ old('phone',isset($data->phone) ? $data->phone : '') }}">
  				</div> 

            </div>
        </div>
    </div> <!-- end col --> 
    <div class="col-lg-6">
    	<div class="card">
    		<div class="card-header">
    			<h4 class="mt-0 header-title">Avatar</h4>		
    		</div>
	        <div class="card-body">
	        	 @if (!empty($data->avatar))
		    		 <p class="text-muted m-b-30"><img src="{{ asset('upload/Avatar/'.$data->avatar) }}"></p>
		    	   @endif

	           <p class="text-muted m-b-30">{{ __('layout.photo_size') }} ( 1024 x 668 ).</p>
	           <div class="form-group">
              <input type="file" name="avatar" class="filestyle" value="{!! old('avatar') !!}"> 
	           </div>
	        </div>
	    </div>
    </div>
</div> <!-- end row -->
 
 
<div class="row mb-4">
	<div class="col-lg-12">
    	<div class="button-items">
            <button type="submit" class="btn btn-success waves-effect waves-light" > {{ __('layout.save') }} </button>
        </div>
    </div>
</div>
</form>
  
 
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection 