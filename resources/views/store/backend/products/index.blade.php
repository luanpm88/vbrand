@extends('backend.layouts.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">    
        <div class="col-sm-6">
            <h4 class="page-title">Quản trị Sản phẩm</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Danh sách Sản phẩm</li>
            </ol>
        </div>
        <div class="col-sm-6">
            <div class="float-right d-none d-md-block"> 
                <a href="{{ url('admin/products/add') }}" class="btn btn-primary arrow-none waves-effect waves-light"> <i class="mdi mdi-settings mr-2"></i> Thêm mới sản phẩm </a> 
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-lg-12">        
        <h4>Danh sách sản phẩm</h4>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection()