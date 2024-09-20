@extends('layouts.app', ['title' => 'News'])

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">News</li>
    </ol>
</nav>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">News by Category</h4>
                @foreach($categories as $category)
                <h5 class="mt-4">{{ $category->name }}</h5>
                <div class="table-responsive">
                    <table class="table" id="dataTableExample">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Published At</th>
                                <th>Views</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->news as $news)
                            <tr>
                                <td>{{ $news->id }}</td>
                                <td>{{ $news->title }}</td>
                                <td>{{ $news->published_at }}</td>
                                <td>{{ $news->views_count }}</td>
                                <td>
                                    @can('news-edit')
                                    <a href="{{ route('news.edit', $news->id) }}">
                                        <i class="me-2 icon-md" data-feather="edit"></i>
                                    </a>
                                    @endcan
                                    @can('news-delete')
                                    <a href="#" onclick="return onDelete({{ $news->id }});" data-bs-toggle="modal"
                                        style="color: red;">
                                        <i class="icon-md" data-feather="trash"></i>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
function onSend(id, active) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger me-2'
        },
        buttonsStyling: false,
    });

    if (!active) {
        swalWithBootstrapButtons.fire({
            title: 'Failed',
            text: 'News is deactive please update...! ☹️',
            icon: 'error'
        });
    } else {
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "Do you want to send this notification to users? This process cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, send it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'me-2',
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '{{ route('
                    notification.pushed ') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        _token: {
                            !!json_encode(csrf_token()) !!
                        },
                        id: id,
                    },
                    success: function(response) {
                        const res = response.data;
                        if (response.code == 200) {
                            $.ajax({
                                url: '{{ route('
                                news.pushed ') }}',
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    _token: {
                                        !!json_encode(csrf_token()) !!
                                    },
                                    id: res.id,
                                },
                                success: function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            });
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Notification not send...! 🙂',
                    'error'
                );
            }
        });
    }
}
</script>
@endsection