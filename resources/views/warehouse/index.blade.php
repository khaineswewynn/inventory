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
                <h4>Warehouse Information</h4>
                <a href="{{ route('warehouse.create') }}" class="btn btn-info">Create New Warehouse</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Is Refrigerated</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warehouses as $warehouse)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->isRefrigerated }}</td>
                                <td>{{ $warehouse->location->name }}</td>
                                <td>
                                    <a href="{{ route('warehouse.show', $warehouse->id) }}"
                                        class="btn btn-primary btn-sm mb-1">Show</a>
                                    <a href="{{ route('warehouse.edit', $warehouse->id) }}"
                                        class="btn btn-success btn-sm mb-1">Edit</a>
                                    <form action="{{ route('warehouse.destroy', $warehouse->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
