@extends('layouts.app', ['title' => 'Users'])
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @can('user-create')
                        <a class="btn btn-primary btn-xs mb-3" href="{{ url('users/create') }}">Add New</a>
                    @endcan
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if (!empty($item->getRoleNames()))
                                                @foreach ($item->getRoleNames() as $v)
                                                    <label class="badge rounded-pill bg-primary">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ app_date($item->created_at) }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="bg-primary mr-1"
                                                    style="border-radius:50%;width: 8px;height: 8px; display: inline-block;"></span>
                                                Active
                                            @else
                                                <span class="bg-danger mr-1"
                                                    style="border-radius:50%;width: 8px;height: 8px; display: inline-block;"></span>
                                                Deactive
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @can('user-edit')
                                                <a href="{{ url('users/' . $item->id . '/edit') }}">
                                                    <i class="me-5 icon-md" data-feather="edit"></i>
                                                </a>
                                            @endcan
                                            @can('user-delete')
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

