@extends('backend.layouts.master')

@section('content')
<script type="text/javascript">    
     bkLib.onDomLoaded(function() {
          var myNicEditor = new nicEditor();     
          myNicEditor.panelInstance('content');
     });
</script>
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

                <div class="dropdown">

                    <button class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <i class="mdi mdi-settings mr-2"></i> Settings

                    </button>

                    <div class="dropdown-menu dropdown-menu-right">

                        <a class="dropdown-item" href="#">Action</a>

                        <a class="dropdown-item" href="#">Another action</a>

                        <a class="dropdown-item" href="#">Something else here</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#">Separated link</a>

                    </div>

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



<form method="post" enctype="multipart/form-data" action="{{ url('admin/upload') }}">

@csrf
 

<div class="row">

  <div class="col-lg-12">

    <div class="card">

          <div class="card-body"> 
              <h4 class="mt-0 header-title">hình ảnh đại diện</h4>  

              <div class="form-group">

                  <label>Default file input</label>

                  <input type="file" name="image" class="filestyle" value="{!! old('photo') !!}"> 

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