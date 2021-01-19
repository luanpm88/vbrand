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

<form method="post" >
@csrf  
<div class="row">
	<div class="col-lg-12">
    	 <div class="card">
            <div class="card-body">
            	<div class="button-items">
                    <button type="submit" class="btn btn-success waves-effect waves-light" > Build XML Againt </button>
                </div> 
            </div>
        </div>
    </div>
</div>
</form>

@endsection