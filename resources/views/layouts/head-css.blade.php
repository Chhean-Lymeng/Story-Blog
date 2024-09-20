
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/dropzone/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/colorpicker/colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css')}}">

<link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}" id="light-theme"
    @if (optional(auth()->user())->setting ? optional(auth()->user())->setting->theme == 1 : false) disabled @endif>
<link rel="stylesheet" href="{{ asset('assets/css/demo2/style.css') }}" id="dark-theme"
    @if (optional(auth()->user())->setting ? optional(auth()->user())->setting->theme == 0 : true) disabled @endif>
@yield('css')

