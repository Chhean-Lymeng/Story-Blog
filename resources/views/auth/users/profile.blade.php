@extends('layouts.app', ['title' => 'Update Users'])

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
@endsection

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Update Users</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-xl-3"></div>
            <div class="col-12 col-xl-6 stretch-card">
                <div class="row flex-grow-1 stretch-card grid-margin grid-margin-md-0">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('update-profile/' . $user->id) }}" method="post" enctype="multipart/form-data" class="forms-sample">
                                @csrf 
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="@if ($errors->has('name')) {{ $errors->first('name') }} @endif"
                                        name="name" value="{{ $user->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="@if ($errors->has('email')) {{ $errors->first('email') }} @endif"
                                        name="email" value="{{ $user->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <button type="submit" class="btn btn-success btn-xs me-2">Update</button>
                                <a class="btn btn-secondary btn-xs me-2" href="{{ url('home') }}">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-xl-3"></div>
    </div>
@endsection
