@extends('layouts.app', ['title' => 'Permissions'])
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permission</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @can('permission-create')
                        <button href="{{ route('permissions.create') }}" class="btn btn-primary btn-xs mb-3"
                            data-bs-toggle="modal" data-bs-target="#modal-create">
                            Add New
                        </button>
                    @endcan
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="text-center" style="width: 250px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $index => $permission)
                                    <tr>
                                        <td>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td class="text-center">
                                            @can('permission-edit')
                                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#modal-edit{{ $permission->id }}">
                                                    <i class="me-5 icon-md" data-feather="edit"></i>
                                                </a>
                                            @endcan
                                            @can('permission-delete')
                                                <a href="#" onclick="return onDelete({{ $permission->id }});" data-bs-toggle="modal" style="color: red;">
                                                    <i class="icon-md" data-feather="trash"></i>
                                                </a>
                                            @endcan
                                        </td>
                                        @include('auth.permissions.edit')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('auth.permissions.create')
@endsection
