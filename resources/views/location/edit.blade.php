@extends('layout.master')

@section('main')
    <section class="mt-5">
        <div class="container">
            <h3 class="mb-4">Edit Location Information</h3>
            <form action="{{ route('location.update', $locations->id) }}" method="POST"
                class="bg-light p-4 rounded shadow-sm">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="required" for="name">Name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $locations->name) }}" placeholder="Enter location name">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="address">Address</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                        name="address" id="address" value="{{ old('address', $locations->address) }}"
                        placeholder="Enter address">
                    @if ($errors->has('address'))
                        <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                    @endif
                </div>

                <div class="form-group mt-4 d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit" id="save">Update</button>
                    <a onclick="history.back()" class="btn btn-secondary text-white">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection