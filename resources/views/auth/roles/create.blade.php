@extends('layouts.app', ['title' => 'Create Roles'])
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Role</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" title="@if ($errors->has('name')) {{ $errors->first('name') }} @endif"
                                    name="name" value="{{ old('name') }}">
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
                                        @foreach ($permission as $value)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input @error('permission') is-invalid @enderror" name="permission[]" value="{{ $value->id }}">
                                                </td>
                                                <td>{{ $value->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary btn-xs me-2">Submit</button>
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
