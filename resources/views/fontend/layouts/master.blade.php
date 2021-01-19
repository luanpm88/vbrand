@include('fontend.layouts.header') 
@include('fontend.layouts.navi')
<main>
	@yield('content')
</main>	
@include('fontend.layouts.footer')
@yield('scripts')