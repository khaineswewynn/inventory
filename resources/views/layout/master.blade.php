@include('layout.nav')

@include('layout.sidebar')
		
<div class="container">
    <div class="content">
        @yield('main')
    </div>
    @include('layout.footer')
</div>