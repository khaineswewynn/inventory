@extends('layout.master')

@section('main')
    <section class="mt-5">
        <div class="container">
            <h3 class="mb-4">Create New Location</h3>
            <form action="{{ route('location.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Location Name:</label>
                    <input type="text" name="name" id="name"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}"
                        placeholder="Enter location name">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" name="address" id="address"
                        class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ old('address') }}"
                        placeholder="Enter address">
                    @if ($errors->has('address'))
                        <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                    @endif
                </div>

                <div class="form-group mt-4 d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit" id="create">Create</button>
                    <a onclick="history.back()" class="btn btn-secondary text-white">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection