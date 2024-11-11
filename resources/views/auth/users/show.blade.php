@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h4> User </h4>
    </section>
    <section class="content">
        <div class="box box-success">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="/storage/img/profile/{{ $user->profiles }}" alt="Profiles">
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            Users:   <label class="badge bg-green"> {{ $v }}</label>
                        @endforeach
                    @endif
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Your Information</h3>
                    </div>
                    <form action="{{ url('users/' .$user->id) }}" method="POST", enctype="multipart/form-data">
                        @csrf @method('PATCH')
                        <div class="box-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="name">Username</label>                                        
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="roles">Select Roles</label>
                                <select name="roles", id="roles" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $role->id == $user->roles_id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>                                        
                                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>                                        
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>                                        
                                <input type="password" class="form-control" name="confirm-password" id="confirm-password">
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 mb-2">
                                    <img src="/storage/img/profile/{{ $user->profiles }}" 
                                        class="image_preview_container profile-user-img  img-circle" alt="Profile">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="profile" placeholder="Choose image" id="profile" class="profile" style="padding-top: 15px;">
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="status" name="status" {{ $user->status == 1 ? 'checked' : ''}}> Status
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-xs">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection