<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
<script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>

<script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
<script src="{{ asset('assets/vendors/colorpicker/colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendors/sortablejs/Sortable.min.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/vendors/select2/select2.min.js')}}"></script>
<script src="{{ asset('assets/js/select2.js')}}"></script>
<script src="{{ asset('assets/js/flatpickr.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/dashboard-dark.js') }}"></script>
<script src="{{ asset('assets/js/dropify.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('assets/js/sortablejs-light.js') }}"></script>

@if (session()->has('message'))
<script>
    var notifications = {!! json_encode(session()->get('message')) !!};
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    });
    Toast.fire({
        icon: 'success',
        title: notifications
    });
</script>
@endif

@if (session()->has('error'))
<script>
    var notifications = {!! json_encode(session()->get('error')) !!};
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    });
    Toast.fire({
        icon: 'error',
        title: notifications
    });
</script>
@endif

<script>
    var currentUrl = window.location.href;
    var urlParts = currentUrl.split('/');
    var resource = urlParts[urlParts.length - 1];
    function onDelete(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger me-2'
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons.fire({
            title: 'Are you sure you want to delete this?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'me-2',
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '{{ url('/system') }}/' + resource + '/destroy',
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: {
                        _token: {!! json_encode(csrf_token()) !!},
                        id: id,
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'error'
                );
            }
        });
    }

    function toggleTheme(userId, theme) {
        $.ajax({
            url: '{{ route('setting.toggleTheme') }}',
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId,
                theme: theme,
            }, 
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: '',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    location.reload();
                });
            }, 
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function toggleLang(userId, language) {
        $.ajax({
            url: '{{ route('setting.toggleLang') }}',
            type: 'POST',
            data: {
                user_id: userId,
                language: language,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: '',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    location.reload();
                });
            }
        });
    }

    $(document).ready(function() {
        $(".colorpicker").colorpicker();
    });
</script>
@yield('script')
