@extends('layout.master')
@section('main')
    <section class="mt-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center"
                    role="alert">
                    <div>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex justify-content-between mb-4">
                <h4>Category Information</h4>
                <a href="{{ route('category.create') }}" class="btn btn-info">Add New Category</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a href="{{ route('category.show', $category->id) }}"
                                        class="btn btn-primary btn-sm">Show</a>
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure to delete this category?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
