@extends('layouts.app', ['title' => 'Create Users'])
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Users</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data"
                            class="forms-sample">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">User Role</label>
                                        <select class="js-example-basic-multiple form-select" name="roles[]" multiple="multiple" data-width="100%">
                                            @foreach ($roles as $role)
                                                <option value={{ $role }}>{{ $role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Username</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="@if ($errors->has('name')) {{ $errors->first('name') }} @endif"
                                            name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="@if ($errors->has('email')) {{ $errors->first('email') }} @endif"
                                            name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="@if ($errors->has('password')) {{ $errors->first('password') }} @endif"
                                            name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                                <label class="form-check-label" for="status">Status</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-xs me-2">Submit</button>
                            <a class="btn btn-secondary btn-xs me-2" href="{{ url('users') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
