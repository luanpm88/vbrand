@extends('fontend.layouts.guest')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}'; 
     bkLib.onDomLoaded(function() {
          var myNicEditor = new nicEditor(); 
          myNicEditor.panelInstance('content');
     }); 
</script>

 
<section class="breadcrumb-section mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('myproducts') }}">Quản trị sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm mới sản phẩm</li>
                  </ol>
                </nav>                     
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container"> 
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


<form method="post" enctype="multipart/form-data">
@csrf
  
<div class="card mb-4 mt-4">
  <div class="card-header">
      <H4>THÔNG TIN SẢN PHẨM</H4>
  </div>
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-lg-12">
        <div class="form-group">
            <select name="category" >            
              @foreach( $category as $item)
              <option value="{{ $item->id }}">{{ $item->title }}</option>
              @endforeach
            </select>
        </div>
      </div>
    </div>

    <div class="row">
    	<!--Chuyên mục-->
        <div class="col-lg-6">
      				<div class="form-group">
      					<label class="control-label">TÊN SẢN PHẨM</label>
      					<input type="text" class="form-control" name="title" value="{{ old('title',isset($data->title) ? $data->title : '') }}">
      				</div>  
      				<div class="form-group">
      					<label class="control-label">TỪ KHÓA TÌM KIẾM</label>
      					<input type="text" class="form-control" name="keyword" value="{{ old('keyword') ?? $data->keyword ?? '' }}">
      				</div>
      				<div class="form-group">
      					<label class="control-label">DIỄN GIẢI NGẮN GỌN</label>
      					<input type="text" class="form-control" name="description" value="{{ old('description') ?? $data->description ?? '' }}">
      				</div>
        </div> <!-- end col -->
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label">GIÁ ( USD )</label>
                <input type="text" class="form-control" name="price" value="{{ old('price') ?? $data->price ?? '' }}">
            </div>
            <div class="form-group">
              <label class="control-label">Sale Off ( % )</label>
              <input type="text" class="form-control" name="Sale Off " value="{{ old('saleoff') ?? $data->saleoff ?? '' }}">
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="row">
    	<div class="col-lg-12">
          <div class="form-group">
					   <label class="control-label">CHI TIẾT SẢN PHẨM</label>
					   <textarea name="content" id="content" class="form-control" maxlength="225" rows="10">
                {{ old('content') ?? $data->content ?? '' }}
              </textarea>
				  </div>                
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12 mb-4">
            <h4 class="mt-0 header-title">ẢNH ĐẠI DIỆN</h4>
            <p class="text-muted m-b-30">Nên chọn hình ảnh có kích thước ( 1024 x 668 ).</p>
            <div class="form-group"> 
                <input type="file" name="photo" class="filestyle" value="{!! old('photo') !!}"> 
            </div>
        </div>
    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="col-lg-12">
      <div class="button-items">
        <button class="btn btn-primary" type="submit">
          <i class="fa fa-save"></i> LƯU LẠI
        </button>
      </div>
  </div>
</div>


</form>
</div>
</section>
@endsection 