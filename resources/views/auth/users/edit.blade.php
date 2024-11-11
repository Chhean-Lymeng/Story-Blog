@extends('layouts.app', ['title' => 'Update Users'])
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Users</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('users/' . $user->id) }}" method="post" enctype="multipart/form-data" class="forms-sample">
                            @csrf @method('PATCH')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="roles" class="form-label">User Role</label>
                                        <select name="roles[]" class="js-example-basic-multiple form-select" multiple data-width="100%">
                                            @foreach($roles as $role => $label)
                                                <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
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
                                            name="name" value="{{ $user->name }}">
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
                                            name="email" value="{{ $user->email }}">
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
                                <label class="form-check-label" for="status">Status</label>
                                <input type="checkbox" class="form-check-input" id="status" name="status" {{ $user->status == 1 ? 'checked' : ''}}>
                            </div>
                            <button type="submit" class="btn btn-success btn-xs me-2">Update</button>
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
