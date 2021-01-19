@extends('backend.layouts.master')

@section('content')
<form method="post" enctype="multipart/form-data">
@csrf
<div class="page-title-box">
    <div class="row align-items-center"> 
        <div class="col-sm-6">
            <h4 class="page-title">Category</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/category') }}">Category</a></li>
                <li class="breadcrumb-item active">Add News Category</li>
            </ol>
        </div>
        <div class="col-sm-6">        
            <div class="float-right d-none d-md-block">                 
                <button class="btn btn-primary" type="submit">
                    <i class="mdi mdi-settings mr-2"></i> Save
                </button>                 
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (Session::has('messenge'))
                <div class="alert alert-success" role="alert">
                    <strong> {{ Session::get('messenge') }}</strong>.
                </div>
                @endif     	
                <div class="form-group">
                    <label class="control-label">Tên Category</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') ?? $category->title ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ old('slug') ?? $category->slug ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Keyword</label>
                    <input type="text" class="form-control" name="keyword" value="{{ old('keyword') ?? $category->keyword ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Description</label>
                    <input type="text" class="form-control" name="description"value="{{ old('description') ?? $category->description ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Content</label>
                    <textarea name="content" class="form-control" maxlength="225" rows="10">{{ old('content') ?? $category->content ?? '' }}</textarea>
                </div> 
				
                <p class="text-muted m-b-30">
                    Bootstrap-wysihtml5 is a javascript
                    plugin that makes it easy to create simple, beautiful wysiwyg editors
                    with the help of wysihtml5 and Twitter Bootstrap.
                </p>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <input type="submit" name=" save " class="btn btn-success waves-effect waves-light">
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
</form>
@endsection