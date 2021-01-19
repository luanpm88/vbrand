@extends('fontend.Member.master')
@section('content')
<style type="text/css">.table td, .table th{padding: .75rem 0;}</style>
<div class="page-title-box">
    <div class="row align-items-center">    
        <div class="col-sm-8">
            <h4 class="page-title">QUẢN TRỊ SẢN PHẨM</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">DASHBOARD</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">SẢN PHẨM</a></li>
                <li class="breadcrumb-item active">DANH SÁCH SẢN PHẨM</li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="float-right d-none d-md-block"> 
                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
            <div class="sorting">
                <div class="row justify-content-between">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <a href="{{ url('member/products/add') }}" class="btn btn-secondary "> <i class="bi bi-card-list"></i> MỚI NHẤT</a>                         
                        <a href="{{ url('member/products/add') }}" class="btn btn-secondary "> <i class="bi bi-caret-down"></i> TĂNG DẦN</a> 
                        <a href="{{ url('member/products/add') }}" class="btn btn-secondary "> <i class="bi bi-caret-UP"></i> GIẢM DẦN</a> 
                        <a href="{{ url('member/products/add') }}" class="btn btn-secondary "> <i class="fa fa-plus" aria-hidden="true"></i> GIẢM DẦN</a> 
                    </div>
                </div>                
            </div>
            <div class="clearfix"></div>
            @if($data)
            <div class="item-listing list">
            @foreach($data as $row)
                <?php $category = DB::table('category')->where('id',$row->category_id)->first(); ?>
                <?php $user = DB::table('users')->where('id',$row->user_id)->first(); ?>
                <div class="item">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="item-image">
                            @if (!empty($row->photo))
                                <img src="{{ asset('upload/Product/'.$row->photo) }}" class="img-fluid">
                            @endif  
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="item-info">
                                <h3 class="item-title"><a href="property_single.html">{{ $row->title }}</a></h3>
                                <div class="item-description">{{ $row->description }}</div> 
                                <div class="item-details">
                                  <ul>
                                    <li>Sq Ft <span>{{ $row->price }} {{ $row->currency }}</span></li>
                                    @if (!empty($category->title))
                                    <li>Type <span>{{ $category->title }}</span></li>
                                    @else
                                        {{  NULL }}
                                    @endif
                                  </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="added-on">Listed on 19th Feb 2017 </div>
                                </div>
                            <div class="col-md-6">
                                <a href="#" class="added-by">by John Doe</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <a href="#" >Edit</a> <a href="#">sửa nhanh</a> <a href="#">Xóa</a> <a href="#">View</a> 
                    </div>
                </div>
            </div>
            <div class="function">
                <form method="post">
                    @csrf
                    <div class="row">
    <!--Chuyên mục-->
    <div class="col-lg-6">
         
                <div class="form-group">
                    <label class="control-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title',isset($row->title) ? $row->title : '') }}">
                </div>
          <div class="form-group">
            <label class="control-label">Slug</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug',isset($row->slug) ? $row->slug : '') }}">
          </div> 
          <div class="form-group">
                  <label class="control-label">Loại tiền</label>
                  <input type="text" class="form-control" name="currency" value="{{ old('currency') ?? $row->currency ?? 'USD' }}">
              </div>

          
    </div> <!-- end col -->

    <div class="col-lg-6">
       
                <div class="form-group">
                    <label class="control-label">Chuyên mục</label>
                     
                </div> 
                <div class="form-group">
                  <label class="control-label">Giá</label>
                  <input type="text" class="form-control" name="price" value="{{ old('price') ?? $row->price ?? '' }}">
              </div>
              
              
              <div class="form-group">
                  <label class="control-label">Sale Off ( % )</label>
                  <input type="text" class="form-control" name="saleoff" value="{{ old('saleoff') ?? $row->saleoff ?? '' }}">
              </div>

            

    </div> <!-- end col -->

</div> <!-- end row -->

<div class="row">
  <div class="col-lg-12"> 
    <div class="form-group">
          <label class="control-label">TÙ KHÓA TÌM KIẾM</label>
          <input type="text" class="form-control" name="keyword" value="{{ old('keyword') ?? $row->keyword ?? '' }}">
        </div> 

  <div class="form-group">
      <label class="control-label">THÔNG TIN TÓM TẮT</label>
      <input type="text" class="form-control" name="description" id="description" value="{{ old('description') ?? $row->description ?? '' }}">
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
            </div>


            @endforeach
            
              
            
            </div>
            <nav aria-label="Page navigation">
                <div class="pagination">{{ $data->links() }}</div>
            </nav>
             @endif
        </div>



       
        <p class="text-muted">
            @if (Session::has('messenge'))
		    <div class="alert alert-success" role="alert">
		        <strong> {{ Session::get('messenge') }}</strong>.
		    </div>
		    @endif
        </p>
        
    
    	 
    </div> <!-- end col -->
</div> <!-- end row -->
 
@endsection()