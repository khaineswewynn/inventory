@extends('layout.master')

@section('main')
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center"
                role="alert">
                <div>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="mb-4">Providers</h1>
        <a href="{{ route('provider.create') }}" class="btn btn-primary mb-3">Create Provider</a>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($providers as $provider)
                    <tr>
                        <td>{{ $provider->id }}</td>
                        <td>{{ $provider->name }}</td>
                        <td>{{ $provider->address }}</td>
                        <td>{{ $provider->phone }}</td>
                        <td>
                            <a href="{{ route('provider.show', $provider->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('provider.edit', $provider->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('provider.destroy', $provider->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure to delete this provider?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
