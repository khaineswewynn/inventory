@extends('layout.master')

@section('main')
    <section class="mt-5">
        <div class="container">
            <h3 class="mb-4">Location Information</h3>
            <div class="bg-light p-4 rounded shadow-sm">
                <h4>Id: <span class="text-muted">{{ $locations->id }}</span></h4>
                <h4>Name: <span class="text-muted">{{ $locations->name }}</span></h4>
                <h4>Address: <span class="text-muted">{{ $locations->address }}</span></h4>

                <a href="{{ route('location.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </section>
@endsection