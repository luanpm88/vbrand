@include('fontend.layouts.header') 
@include('fontend.layouts.navind')
<main>
	@yield('content')
</main>		
@include('fontend.layouts.footer')
@yield('scripts')
