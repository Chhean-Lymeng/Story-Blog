@extends('layouts.app', ['title' => 'Create News'])

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create News</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Title -->
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="categories_id"
                                            class="form-control @error('categories_id') is-invalid @enderror">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('categories_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">Date <span class="text-danger">*</span></label>
                                            <div class="input-group flatpickr" id="flatpickr-date">
                                                <input type="text" data-inputmask-inputformat="dd-mm-yyyy"
                                                    name="published_at" class="form-control flatpickr-input"
                                                    placeholder="Date" data-input readonly data-date-format="d-m-Y"
                                                    value="{{ old('published_at') }}">
                                                <span class="input-group-text input-group-addon" data-toggle=""><svg
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-calendar">
                                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                                            ry="2"></rect>
                                                        <line x1="16" y1="2" x2="16" y2="6">
                                                        </line>
                                                        <line x1="8" y1="2" x2="8" y2="6">
                                                        </line>
                                                        <line x1="3" y1="10" x2="21" y2="10">
                                                        </line>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Order By <span class="text-success">current:
                                                {{ $count_order }}</span></label>
                                        <input type="number" class="form-control @error('orderby') is-invalid @enderror"
                                            name="orderby" value="{{ $count_order + 1 }}" required>
                                        @error('orderby')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title') }}" placeholder="Enter news title">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail <span class="text-danger">*</span></label>
                                        <input type="file" id="myDropify"
                                            class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"
                                            data-height="131">
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                            rows="6" placeholder="Enter news short description">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control content" name="content">{{ old('content') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('public.photo_album')</label>
                                <div action="{{ route('news.isUploaded') }}" class="dropzone"
                                    id="exampleDropzone"></div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="status" checked>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-xs me-2">Submit</button>
                            <a class="btn btn-secondary btn-xs me-2" href="{{ url('system/news') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script>

        $(function() {
            tinymce.init({
                selector: 'textarea.content',
                height: 400,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px; }'
            });
        });

        Dropzone.autoDiscover = false;
        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var myDropzone = new Dropzone('#exampleDropzone', {
                url: '{{ route('news.isUploaded') }}',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                autoProcessQueue: true,
                addRemoveLinks: true,
                acceptedFiles: 'image/*,.jpg,.png,.jpeg',
                dictDefaultMessage: 'Drop photos here or click to upload.',
                success: function(file, response) {
                    $(file.previewElement).append('<input type="hidden" name="pictures[]" value="' +
                        response.filePath + '" />');
                    $(file.previewElement).append(
                        '<div style="text-align: center;">' +
                        '<label class="radio-inline text-center primaryImage" style="display: inline-block;">' +
                        '<input type="radio" name="primary" value="' + response.filePath + '">' +
                        '&nbsp;Primary</label>' +
                        '</div>'
                    );
                    $('.dz-preview').eq(0).find('.primaryImage input').prop('checked', true);
                },
                init: function() {
                    this.on('removedfile', function(file) {
                        var imageName = $(file.previewElement).find('input[name="pictures[]"]');
                        var name = imageName.val();
                        if (name) {
                            $.ajax({
                                url: '{{ route('news.isRemoved') }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                data: {
                                    name: name
                                }
                            });
                        }
                    });
                    const albumList = document.getElementById('exampleDropzone');
                    new Sortable(albumList, {
                        animation: 150,
                        onEnd: function(evt) {
                            saveOrder();
                        }
                    });
                }
            });
        });

        function saveOrder() {
            const order = Array.from(document.querySelectorAll('.dz-preview')).map((item, index) => ({
                id: item.dataset.id,
                order: index
            }));
            fetch('{{ route('albums.updateOrder') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        albums: order
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
