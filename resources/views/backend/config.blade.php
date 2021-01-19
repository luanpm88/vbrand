@extends('backend.layouts.master')

@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}'; 
     bkLib.onDomLoaded(function() {
          var myNicEditor = new nicEditor(); 
          myNicEditor.panelInstance('content');
     }); 
</script>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Quản trị thành viên</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Thành viên</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa</li>
            </ol>
        </div>
        <div class="col-sm-6"> 
            <div class="float-right d-none d-md-block">
                <div class="dropdown">
                    <button class="btn btn-primary" type="submit" > 
                        <i class="mdi mdi-settings mr-2"></i> Save
                    </button>  
                </div>
            </div>
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

<form method="post" enctype="multipart/form-data">
@csrf
<div class="row">
	<!--Chuyên mục-->
    <div class="col-lg-6">
    	 <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label class="control-label">site_name</label>
                <input type="text" class="form-control" name="site_name" value="{{ old('site_name', isset($data->site_name) ? $data->site_name : '' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_keyword</label>
                <input type="text" class="form-control" name="site_keyword" value="{{ old('site_keyword', isset($data->site_keyword) ? $data->site_keyword   :'' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_description</label>
                <input type="text" class="form-control" name="site_description" value="{{ old('site_description', isset($data->site_description) ? $data->site_description   :'' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_hotline</label>
                <input type="text" class="form-control" name="site_hotline" value="{{ old('site_hotline', isset($data->site_hotline) ? $data->site_hotline  : '' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_email</label>
                <input type="text" class="form-control" name="site_email" value="{{ old('site_email',isset($data->site_email) ? $data->site_email   :'' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_slogon_vn</label>
                <input type="text" class="form-control" name="site_slogon_vn" value="{{ old('site_slogon_vn',isset($data->site_slogon_vn) ? $data->site_slogon_vn   : '' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_slogon_en</label>
                <input type="text" class="form-control" name="site_slogon_en" value="{{ old('site_slogon_en',isset($data->site_slogon_en) ? $data->site_slogon_en   : '' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_address_vn</label>
                <input type="text" class="form-control" name="site_address_vn" value="{{ old('site_address_vn',isset($data->site_address_vn) ? $data->site_address_vn   : '' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_address_en</label>
                <input type="text" class="form-control" name="site_address_en" value="{{ old('site_address_en',isset($data->site_address_en) ? $data->site_address_en   : '' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_companyname_vn</label>
                <input type="text" class="form-control" name="site_companyname_vn" value="{{ old('site_companyname_vn',isset($data->site_companyname_vn) ? $data->site_companyname_vn   :'' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">site_companyname_en</label>
                <input type="text" class="form-control" name="site_companyname_en" value="{{ old('site_companyname_en',isset($data->site_companyname_en) ? $data->site_companyname_en   :'' ) }}">
              </div>
   

            </div>
        </div>

    </div> <!-- end col --> 

</div> <!-- end row -->

<div class="row">
	<div class="col-lg-6">
		<div class="card">
	        <div class="card-body">

	            <h4 class="mt-0 header-title">Logo</h4>
	            @if (!empty($data->site_logo))
	        		<p class="text-muted m-b-30"><img src="{{ asset('upload/Product/'.$data->site_logo) }}"></p>
	        	@endif
	            <p class="text-muted m-b-30">Nên chọn hình ảnh có kích thước ( 1024 x 668 ).</p>
	            <div class="form-group">
                <label>Default file input</label>
	                <input type="file" name="site_logo" class="filestyle" value="{!! old('site_logo') !!}"> 
	            </div>
	        </div>
	    </div>
    </div>
</div>
<div class="row">

    <div class="col-lg-6">
      <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title">Footer Logo</h4>
                @if (!empty($data->site_flogo))
                <p class="text-muted m-b-30"><img src="{{ asset('upload/Product/'.$data->site_flogo) }}"></p>
              @endif
                <p class="text-muted m-b-30">Nên chọn hình ảnh có kích thước ( 1024 x 668 ).</p>
                <div class="form-group">
                  <label>Default file input</label>
                    <input type="file" name="site_flogo" class="filestyle" value="{!! old('site_flogo') !!}"> 
                </div>
            </div>
        </div>
    </div>
</div>
 
<div class="row">
	<div class="col-lg-12">
    	 <div class="card">
            <div class="card-body">
            	<div class="button-items">
                    <button type="submit" class="btn btn-success waves-effect waves-light" > Save </button>
                </div> 
            </div>
        </div>
    </div>
</div>
</form>

@endsection