@extends('layouts.app', ['title' => 'Update Roles'])
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Role</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body"> 
                        <form method="POST" action="{{ route('roles.update', $role->id) }}" enctype="multipart/form-data">
                            @csrf @method('PATCH')
                            <div class="mb-3">
                                <label class="form-label">Permission</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" title="@if ($errors->has('name')) {{ $errors->first('name') }} @endif"
                                    name="name" value="{{ $role->name }}">
                            </div>
                            <div class="mb-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><input class="form-check-input" style="margin-right: 10px;" type="checkbox" id="checkAll">Check All</th>
                                            <th>Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permission as $value)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="form-check-input permission" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $value->name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-success btn-xs me-2">Update</button>
                            <a class="btn btn-secondary btn-xs me-2" href="{{ url('roles') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    document.getElementById('checkAll').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('input[name="permission[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('checkAll').checked;
        });
    });
</script>
@endsection