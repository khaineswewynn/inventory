@extends('layout.master')

@section('main')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Provider</h1>
        <form action="{{ route('provider.update', $provider->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $provider->name }}" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" class="form-control" rows="3" required>{{ $provider->address }}</textarea>
            </div>
            <div class="form-group">
                <label for="name">Phone:</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ $provider->phone }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
