@extends('layout.master')

@section('main')
    <div class="container">
        <h3 class="mb-4">Create New Warehouse</h3>
        <form action="{{ route('warehouse.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Warehouse Name:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="isRefrigerated" class="form-label">Is Refrigerated:</label>
                <input type="text" name="isRefrigerated" id="isRefrigerated" class="form-control">
            </div>
            <div class="mb-3">
                <label for="location_id" class="form-label">Location:</label>
                <select name="location_id" class="form-select" style="background-color:white">
                    <option value="">-- Select Location --</option>
                    @foreach ($locations as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary me-md-2" type="submit" id="create">Create</button>
                <a onclick="history.back()" class="btn btn-secondary text-white">Cancel</a>
            </div>
        </form>
    </div>
@endsection