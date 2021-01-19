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
    <div class="col-lg-12">
    	 <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label class="control-label">title</label>
                <input type="text" class="form-control" name="title" value="{{ old( 'title', $data->title ?? '' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">description</label>
                <input type="text" class="form-control" name="description" value="{{ old( 'description', $data->description ?? '' ) }}">
              </div>
              <div class="form-group">
                <label class="control-label">content</label>
                <textarea name="content" id="content" class="form-control" maxlength="225" rows="10">{{ old('content') ?? $data->content ?? '' }}</textarea>

                 
              </div>
              <div class="form-group">
                <label class="control-label">keyword</label>
                <input type="text" class="form-control" name="keyword" value="{{ old( 'keyword', $data->keyword ?? '' ) }}">
              </div>
            </div>
        </div>

    </div> <!-- end col --> 

</div> <!-- end row -->

<div class="row">
	<div class="col-lg-6">
		<div class="card">
	        <div class="card-body">
	            <h4 class="mt-0 header-title">photo</h4>
	            @if (!empty($data->photo))
	        		<p class="text-muted m-b-30"><img src="{{ asset('upload/'.$data->photo) }}"></p>
	        	  @endif
	            <p class="text-muted m-b-30">Nên chọn hình ảnh có kích thước ( 1024 x 668 ).</p>
	            <div class="form-group">
                <label>Default file input</label>
	                <input type="file" name="photo" class="filestyle" value="{!! old('photo') !!}"> 
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