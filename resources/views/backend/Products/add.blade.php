@extends('backend.layouts.master')

@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}'; 
     bkLib.onDomLoaded(function() {
          var myNicEditor = new nicEditor(); 
          myNicEditor.panelInstance('content');
     }); 
</script>
<form method="post" enctype="multipart/form-data">
@csrf
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Quản trị Sản phẩm</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">sản phẩm</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa</li>
            </ol>
        </div>
        <div class="col-sm-6">        
            <div class="float-right d-none d-md-block">                 
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i> Save
                </button>                 
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="card-body">
    <div class="row">
        <div class="col-lg-12">
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
    <div class="col-lg-6">
    	 <div class="card">
          <div class="card-body">  
  				<div class="form-group">
  					<label class="control-label">Tên sản phẩm</label>
  					<input type="text" class="form-control" name="title" value="{{ old('title',isset($data->title) ? $data->title : '') }}">
  				</div> 
          <div class="form-group">
            <label class="control-label">Slug</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug',isset($data->slug) ? $data->slug : '') }}">
          </div> 
  				<div class="form-group">
  					<label class="control-label">Từ khóa tìm kiếm</label>
  					<input type="text" class="form-control" name="keyword" value="{{ old('keyword') ?? $data->keyword ?? '' }}">
  				</div>
  				<div class="form-group">
  					<label class="control-label">Diễn giải ngắn gọn</label>
  					<input type="text" class="form-control" name="description" value="{{ old('description') ?? $data->description ?? '' }}">
  				</div>
          </div>
        </div>
    </div> <!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
            	<div class="form-group">
	                <label class="control-label">Chuyên mục</label>
	                <select name="category" class="form-control select2">						 
      						  @foreach( $category as $item)
      						  <option value="{{ $item->id }}">{{ $item->title }}</option>
      						  @endforeach
                  </select>
            	</div>
              <div class="form-group">
                <label class="control-label">Giá</label>
                <input type="text" class="form-control" name="price" value="{{ old('price') ?? $data->price ?? '' }}">
              </div> 
            </div>
            
            <div class="form-group">
                  <label class="control-label">Loại tiền</label>
                  <input type="text" class="form-control" name="currency" value="{{ old('currency') ?? $data->currency ?? 'USD' }}">
              </div>

            <div class="form-group">
              <label class="control-label">Sale Off ( % )</label>
              <input type="text" class="form-control" name="Sale Off " value="{{ old('saleoff') ?? $data->saleoff ?? '' }}">
            </div>
        </div> 
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="row">
	<div class="col-lg-12">
    	 <div class="card">
            <div class="card-body">
              <div class="form-group">
    					   <label class="control-label">Thông tin chi tiết</label>
    					   <textarea name="content" id="content" class="form-control" maxlength="225" rows="10">{{ old('content') ?? $data->content ?? '' }}</textarea>
    				  </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
  <div class="col-lg-12">
       <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">hình ảnh sản phẩm</h4>
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
                  <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i> Save
                  </button>
                </div> 
            </div>
        </div>
    </div>
</div>

</form>
@endsection 