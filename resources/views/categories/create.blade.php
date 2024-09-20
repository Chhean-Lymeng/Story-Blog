@extends('layouts.app', ['title' => 'Create Category'])

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Category</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" data-bs-toggle="tooltip" 
                                            data-bs-placement="top" title="@if ($errors->has('name')) {{ $errors->first('name') }} @endif"
                                            name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Order By 
                                            @if ($count_order == null)
                                            <span class="text-success"> current: 0</span>
                                            @else
                                            <span class="text-success"> current: {{ $count_order }}</span>
                                            @endif
                                        </label>
                                        <input type="number" class="form-control" name="orderby" value="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image <span class="text-danger">*</span></label>
                                <input type="file" id="myDropify" class="form-control @error('image') is-invalid @enderror" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="@if ($errors->has('image')) {{ $errors->first('image') }} @endif"
                                name="image">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch mb-3">
                                    <input type="checkbox" class="form-check-input" name="status" checked>
                                    <label class="form-check-label">Status</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-xs me-2">Submit</button>
                            <a class="btn btn-secondary btn-xs me-2" href="{{ url('categories') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
