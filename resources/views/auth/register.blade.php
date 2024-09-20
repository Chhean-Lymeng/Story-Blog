<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.title-meta', ['title' => 'Register'])
    @include('layouts.head-css')
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}">
</head>
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">
            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row justify-content-center">
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">{{ env('APP_NAME') }}</a>
                                    <h5 class="text-muted fw-normal mb-4">Create a free account.</h5>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email address</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="Password">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('layouts.footer-script')
</body>

</html>
