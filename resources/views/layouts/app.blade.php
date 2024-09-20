<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.title-meta', ['title' => $title])
    @include('layouts.head-css')
</head>
<body>
    <div class="main-wrapper">
		@include('layouts.left-sidebar')
		<div class="page-wrapper">
            @include('layouts.topbar')
				<div class="page-content">
					@yield('content')
				</div>
            @include('layouts.footer')
        </div>
	</div>
	@include('layouts.footer-script')
	@yield('script')
</body>
</html>