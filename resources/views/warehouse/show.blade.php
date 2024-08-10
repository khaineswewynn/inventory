@extends('layout.master')

@section('main')
    <section class="mt-5">
        <div class="container">
            <h3 class="mb-4">Warehouse Information</h3>
            <div class="bg-light p-4 rounded shadow-sm">
                <h4>ID: <span class="text-muted">{{ $warehouses->id }}</span></h4>
                <h4>Name: <span class="text-muted">{{ $warehouses->name }}</span></h4>
                <h4>Is Refrigerated: <span class="text-muted">{{ $warehouses->isRefrigerated }}</span></h4>
                <h4>Location: <span class="text-muted">{{ $warehouses->location->name }}</span></h4>

                <a href="{{ route('warehouse.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </section>
@endsection