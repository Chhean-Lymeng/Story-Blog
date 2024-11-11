@extends('layouts.app', ['title' => 'User Roles'])
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Role</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="box-header with-border">
                    @can('role-create')
                        <a class="btn btn-primary btn-xs mb-3" href="{{ url('roles/create') }}">Add New</a>
                    @endcan
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $item)
                                    <tr>
                                        <td>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">
                                            @can('role-edit')
                                                <a href="{{ route('roles.edit', $item->id) }}">
                                                    <i class="me-5 icon-md" data-feather="edit"></i>
                                                </a>
                                            @endcan
                                            @can('role-delete')
                                                <a href="#" onclick="return onDelete({{ $item->id }});" data-bs-toggle="modal" style="color: red;">
                                                    <i class="icon-md" data-feather="trash"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection