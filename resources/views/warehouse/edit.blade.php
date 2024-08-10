@extends('layout.master')

@section('main')
    <section class="mt-5">
        <div class="container">
            <h3 class="mb-4">Edit Warehouse Information</h3>
            <form action="{{ route('warehouse.update', $warehouses->id) }}" method="POST"
                class="bg-light p-4 rounded shadow-sm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="required" for="name">Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        value="{{ old('name', $warehouses->name) }}">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="isRefrigerated">Is Refrigerated</label>
                    <input type="text" name="isRefrigerated" id="isRefrigerated"
                        class="form-control {{ $errors->has('isRefrigerated') ? 'is-invalid' : '' }}"
                        value="{{ old('isRefrigerated', $warehouses->isRefrigerated) }}">
                    @if ($errors->has('isRefrigerated'))
                        <div class="invalid-feedback">{{ $errors->first('isRefrigerated') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="location_id" class="required">Location</label>
                    <select name="location_id" id="location_id"
                        class="form-select {{ $errors->has('location_id') ? 'is-invalid' : '' }}"
                        style="background-color: #f0f0f0; border: 1px solid #ced4da;">
                        <option value="">-- Select Location --</option>
                        @foreach ($locations as $id => $name)
                            <option
                                value="{{ $id }}"{{ $id == old('location_id', $warehouses->location_id) ? ' selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('location_id'))
                        <div class="invalid-feedback">{{ $errors->first('location_id') }}</div>
                    @endif
                </div>

                <div class="form-group mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-3">Update</button>
                    <a href="{{ route('warehouse.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection