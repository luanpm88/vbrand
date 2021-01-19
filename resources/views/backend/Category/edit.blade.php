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
                    <i class="fas fa-save"></i> Save
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
                    <label class="control-label">Parent</label>                    
					<select name="category" class="form-control">
						@foreach( $parent as $item)
						@if($data->cid == $item->id)
						<option value="{{ $item->id }}" selected>{{ $item->title }}</option>
						@else
						<option value="{{ $item->id }}" >{{ $item->title }}</option>
						@endif
						@endforeach
					</select>
                </div>
                <div class="form-group">
                    <label class="control-label">Tên Category</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title',isset($data->title) ? $data->title : '') }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ old('slug',isset($data->slug) ? $data->slug : '') }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Keyword</label>
                    <input type="text" class="form-control" name="keyword" value="{{ old('title',isset($data->keyword) ? $data->keyword : '') }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Description</label>
                    <input type="text" class="form-control" name="description"value="{{ old('title',isset($data->description) ? $data->description : '') }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Content</label>
                    <textarea name="content" class="form-control" maxlength="225" rows="10">{{ old('title',isset($data->content) ? $data->content : '') }}</textarea>
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
            	<button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i> Save
                </button>    
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
</form>
@endsection