@include('fontend.Member.header') 
@include('fontend.Member.navi')
<div class="clearfix"></div>
<div id="content">
  <div class="container">
    <div class="row justify-content-md-center">
		<div class="col col-lg-12 col-xl-12">
        	<div class="row has-sidebar">
	          <div class="col-md-3 col-lg-3 col-xl-3 col-sidebar"> 
				@include('fontend.Member.left')
			</div>
        	<div class="col-md-9 col-lg-9 col-xl-9">
			@yield('content')
		</div>
	</div>
</div>
</div>
@include('fontend.Member.footer')
@yield('scripts')