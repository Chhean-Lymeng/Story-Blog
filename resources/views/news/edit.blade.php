@extends('layouts.app', ['title' => 'Edit News'])

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit News</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Hidden user_id -->
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />

                            <!-- Category -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="categories_id" class="form-control @error('categories_id') is-invalid @enderror">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == old('categories_id', $news->categories_id) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categories_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Published Date -->
                                <div class="col-md-4">
                                <div class="mb-3">
                                        <label class="form-label">Date <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group flatpickr" id="flatpickr-date">
                                            <input type="text" data-inputmask-inputformat="dd-mm-yyyy"
                                                name="published_at" class="form-control flatpickr-input"
                                                placeholder="Select Date" data-input readonly
                                                value="{{ $news->published_at }}">
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
                                                </svg></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order By -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Order By <span class="text-success">current: {{ $news->orderby }}</span></label>
                                        <input type="number" class="form-control @error('orderby') is-invalid @enderror" name="orderby"
                                            value="{{ old('orderby', $news->orderby) }}" required>
                                        @error('orderby')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title', $news->title) }}" placeholder="Enter news title">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Thumbnail -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail <span class="text-danger">*</span></label>
                                        <input type="file" id="myDropify" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"
                                            data-default-file="{{ asset('storage/news/thumbnail/' . $news->thumbnail) }}" data-height="131">
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Short Description -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                            rows="6" placeholder="Enter news short description">{{ old('short_description', $news->short_description) }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control description @error('content') is-invalid @enderror" name="content">{{ $news->content }}</textarea>
                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('content') }}
                                        </span>
                                    @endif
                                </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="status" {{ old('status', $news->status) ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <button type="submit" class="btn btn-primary btn-xs me-2">Update</button>
                            <a class="btn btn-secondary btn-xs me-2" href="{{ route('news.index') }}">Cancel</a>
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
                selector: 'textarea.description',
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
    </script>
@endsection
