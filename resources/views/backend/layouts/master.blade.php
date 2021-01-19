@include('backend.layouts.header') 

@include('backend.layouts.navi')

@include('backend.layouts.left')

<div class="content-page">

    <div class="content">

        <div class="container-fluid">

            @yield('content')

		</div>

    </div>

</div>

@include('backend.layouts.footer')