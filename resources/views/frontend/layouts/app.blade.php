<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('frontend.layouts.head-css')
</head>

<body>
    <div id="wrapper">
        @include('frontend.layouts.topbar')
        <div class="page-wrapper">
			<div class="all-page-content">
				@yield('content')
            </div>
            @include('frontend.layouts.footer')
        </div>
    </div>
    @include('frontend.layouts.footer-script')
</body>

</html>
