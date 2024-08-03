@extends('layout.master')

@section('main')
    <div class="container mt-5">
        <h1 class="mb-4">Show Provider</h1>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <strong>Name:</strong>
                    <p class="form-control-plaintext">{{ $provider->name }}</p>
                </div>
                <div class="mb-3">
                    <strong>Address:</strong>
                    <p class="form-control-plaintext">{{ $provider->address }}</p>
                </div>
                <div class="mb-3">
                    <strong>Phone:</strong>
                    <p class="form-control-plaintext">{{ $provider->phone }}</p>
                </div>
                <a href="{{ route('provider.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection

