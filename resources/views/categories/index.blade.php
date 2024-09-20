<!-- resources/views/categories/index.blade.php -->

@extends('layouts.app', ['title' => 'Categories'])

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        @if($category->image)
                                            <img src="{{ Storage::url($category->image) }}" alt="Image" style="max-width: 100px;">
                                        @endif
                                    </td>
                                    <td>
                                    @can('category-edit')
                                                <a href="{{ route('categories.edit', $category->id) }}">
                                                    <i class="me-5 icon-md" data-feather="edit"></i>
                                                </a>
                                            @endcan
                                        @can('category-delete')
                                            <a href="#" onclick="return onDelete({{ $category->id }});" data-bs-toggle="modal" style="color: red;">
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
@endsection
