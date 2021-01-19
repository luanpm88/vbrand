@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
 
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-8">
            <h4 class="page-title">CHỈNH SỬA SẢN PHẨM</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">DASHBOARD</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">SẢN PHẨM</a></li>
                <li class="breadcrumb-item active">CHỈNH SỬA SẢN PHẨM</li>
            </ol>
        </div>
        <div class="col-sm-4"> 
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
    	 
  				<div class="form-group">
  					<label class="control-label">Tên sản phẩm</label>
  					<input type="text" class="form-control" name="title" value="{{ old('title',isset($data->title) ? $data->title : '') }}">
  				</div>
          <div class="form-group">
            <label class="control-label">Slug</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug',isset($data->slug) ? $data->slug : '') }}">
          </div> 
          <div class="form-group">
                  <label class="control-label">Loại tiền</label>
                  <input type="text" class="form-control" name="currency" value="{{ old('currency') ?? $data->currency ?? 'USD' }}">
              </div>

          
    </div> <!-- end col -->

    <div class="col-lg-6">
       
            	<div class="form-group">
	                <label class="control-label">Chuyên mục</label>
	                <select name="category" class="form-control select2">
      						@foreach( $category as $item)
      						@if($data->category_id == $item->id)
      							<option value="{{ $item->id }}" selected>{{ $item->title }}</option>
      						@else
      							<option value="{{ $item->id }}" >{{ $item->title }}</option>
      						@endif
      						@endforeach
      					</select>
            	</div> 
            	<div class="form-group">
                  <label class="control-label">Giá</label>
                  <input type="text" class="form-control" name="price" value="{{ old('price') ?? $data->price ?? '' }}">
              </div>
              
              
              <div class="form-group">
                  <label class="control-label">Sale Off ( % )</label>
                  <input type="text" class="form-control" name="saleoff" value="{{ old('saleoff') ?? $data->saleoff ?? '' }}">
              </div>

            

    </div> <!-- end col -->

</div> <!-- end row -->

<div class="row">
  <div class="col-lg-12"> 
    <div class="form-group">
          <label class="control-label">TÙ KHÓA TÌM KIẾM</label>
          <input type="text" class="form-control" name="keyword" value="{{ old('keyword') ?? $data->keyword ?? '' }}">
        </div> 

  <div class="form-group">
      <label class="control-label">THÔNG TIN TÓM TẮT</label>
      <input type="text" class="form-control" name="description" id="description" value="{{ old('description') ?? $data->description ?? '' }}">
    </div>
  </div>
</div> 

<div class="row">
  <div class="col-lg-12"> 
    <div class="form-group">
      <label class="control-label">THÔNG TIN CHI TIẾT</label>
      <textarea name="content" id="contents" class="form-control" maxlength="225" rows="10">{{ old('content') ?? $data->content ?? '' }}</textarea>
      <script type="text/javascript">CKEDITOR.replace( 'contents'); </script>
    </div>
  </div>

  <div class="col-lg-12"> 
    <h4 class="mt-0 header-title">HÌNH ẢNH ĐẠI DIỆN</h4>
    @if (!empty($data->photo))
      <p class="text-muted m-b-30"><img src="{{ asset('upload/Product/'.$data->photo) }}" style="max-width: 100%"></p>
    @endif
    <p class="text-muted m-b-30">Nên chọn hình ảnh có kích thước ( 1024 x 668 ).</p>
    <div class="form-group">
      <label>Default file input</label>
      <input type="file" name="photo" class="filestyle" value="{!! old('photo') !!}"> 
    </div>
  </div>

</div>
<div class="row mb-4">
	<div class="col-lg-12">
    <div class="button-items">
      <button type="submit" class="btn btn-success waves-effect waves-light" > Save </button>
    </div> 
  </div>
</div>

</form> 
@endsection