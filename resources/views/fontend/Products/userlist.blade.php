@extends('fontend.layouts.guest')
@section('content')
<section class="breadcrumb-section mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('myproducts') }}">Quản trị sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                  </ol>
                </nav>                     
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container"> 
        <div class="page-title-box mb-4">
            <div class="row align-items-center">    
                <div class="col-sm-12">
                    <h4 class="page-title">SẢN PHẨM CỦA BẠN</h4> 
                </div> 
            </div>
        </div>
        <!-- end row -->
        <div class="row mb-4">
            <div class="col-lg-12">        
                 <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <h4>DANH SÁCH SẢN PHẨM</h4>
                        </div>
                        <div class="pull-right"> 
                            <a href="{{ url('myproducts/add') }}"  class="btn btn-outline-success btn-sm"> 
                                <i class="fa fa-plus"></i> THÊM MỚI SẢN PHẨM
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            @if (Session::has('messenge_sm'))
                		    <div class="alert alert-success" role="alert">
                		        <strong> {{ Session::get('messenge_sm') }}</strong>.
                		    </div>
                		    @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>HÌNH ẢNH</th>
                                        <th>TÊN SẢN PHẨM</th>
                                        <th>GIÁ BÁN</th>
                                        <th>CHUYÊN MỤC</th>
                                        <th>CHỨC NĂNG</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($data as $row)
                                	<?php $category = DB::table('category')->where('id',$row->category_id)->first(); ?>
                                	<tr>
                                        <th scope="row">{{ $row->id }}</th>
                                        <td>
                                        	@if (!empty($row->photo))
                				        	<img style="width: 100px" src="{{ asset('upload/Product/'.$row->photo) }}">
                				        	@endif
                                        </td>
                                        <td>{{ $row->title }}</td>
                                        <td>
                                            {{ $row->price }} {{ $row->currency }} 
                                        </td>
                                        <td>
                                        	@if (!empty($category->title))
                					            {{ $category->title }}
                					        @else
                					            {{  NULL }}
                					        @endif 
                                        </td>

                                        <td>
                                            <a href="{{ url('myproducts/edit',$row->id) }}" class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-edit"></i> sửa
                                            </a>
                                            <a href="{{ url('myproducts/del',$row->id) }}" onclick="javascript:pront('Xóa danh mục này ?')" class="btn btn-outline-danger btn-sm btnremove">
                                                <i class="fa fa-remove"></i> Xóa
                                            </a>                                         
                                        	<a href="{{ url('products',$row->slug) }}" target="_blank" class="btn btn-outline-success btn-sm">XEM TRÊN WEBSITE</a>
                                        </td>
                                    </tr>
                					@endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-left">
                            Ngày: 
                        </div>
                        <div class="pull-right">
                            {{ $data->links() }}   
                        </div>                	 
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row --> 
    </div>
</section>
@endsection()